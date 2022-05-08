<html>
    <head>
        <title>Add Item</title>
    </head>
    <body>
        
        <?php

            if (!empty($_POST["item_name"]) && !empty($_POST["item_description"]) && !empty($_POST["end_date"]) && !empty($_POST["end_time"]) && !empty($_FILES["item_pic"]["name"])) {

                $cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
                $cleardb_server = $cleardb_url["host"];
                $cleardb_username = $cleardb_url["user"];
                $cleardb_password = $cleardb_url["pass"];
                $cleardb_db = substr($cleardb_url["path"],1);
                $active_group = 'default';
                $query_builder = TRUE;
                // Connect to DB
                $conn = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);

                if ($conn->connect_error) {
                    die('Connection failed!'.$conn->connect_error);
                }


                $poster = $_POST["username"];
                $iname = $_POST["item_name"];
                $idesc = $_POST["item_description"];
                $iipic_name = $_FILES["item_pic"]["name"];
                $iipic_data = file_get_contents($_FILES['item_pic']['tmp_name']);
                $end_date = $_POST["end_date"];
                $end_time = explode(":", $_POST["end_time"]);
                $hours = $end_time[0];
                $minutes = $end_time[1];
                $seconds = '00';


                // $end_datetime = $_POST["end_datetime"]; // 2020-01-01T10:10:10
                // $separate = explode("T", $end_datetime); // [2020-01-01, 10:10:10]
                // $thedate = $separate[0]; // 2020-01-01
                // $thetime = $separate[1]; // 10:10:10
                // $insertformat = $thedate + " " + $thetime + "-08:00";


                $statement = 'SELECT * FROM item WHERE item_name=?';
                $stmt = $conn->prepare($statement);
                $stmt->bind_param("s", $iname);
                $stmt->execute();

                $result = $stmt->get_result();
                if ($result->num_rows>=1) {
                    $value = 'duplicate';
                    $conn->close();
                    header("Location:add_item.php?item=$value");
                } else {
                    $statement = 'INSERT INTO item (item_name, item_desc, img_name, img_data, posted_by, date, hours, minutes, seconds) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)';

                    $stmt = $conn->prepare($statement);
                    $stmt->bind_param("sssbsssss", $iname, $idesc, $iipic_name, $iipic_data, $poster, $end_date, $hours, $minutes, $seconds);
                    $stmt->execute();

                    $conn->close();
                    header("Location:display_items.php");
                }

            } else {

                header("Location:add_item.php");

            }
 
        ?>
    
    </body>
</html>