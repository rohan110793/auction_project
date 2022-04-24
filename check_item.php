<html>
    <head>
        <title>Add Item</title>
    </head>
    <body>
        
        <?php

            if (!empty($_POST["item_name"]) && !empty($_POST["item_description"]) && !empty($_POST["end_date"]) && !empty($_POST["end_time"]) && !empty($_FILES["item_pic"]["name"])) {

                $DBHOST = 'localhost';
                $DBUSER = 'root';
                $DBPWD = '';
                $DBNAME = 'auction_man';

                $conn = new mysqli($DBHOST, $DBUSER, $DBPWD, $DBNAME);

                if ($conn->connect_error) {
                    die('Connection failed!'.$conn->connect_error);
                }


                $poster = $_POST["username"];
                $iname = $_POST["item_name"];
                $idesc = $_POST["item_description"];
                $iipic = $_FILES["item_pic"]["name"];
                $end_date = $_POST["end_date"];
                $end_time = explode(":", $_POST["end_time"]);
                $hours = $end_time[0];
                $minutes = $end_time[1];
                $seconds = '00';

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
                    $statement = 'INSERT INTO item (item_name, item_desc, item_pic, posted_by, date, hours, minutes, seconds) VALUES(?, ?, ?, ?, ?, ?, ?, ?)';

                    $stmt = $conn->prepare($statement);
                    $stmt->bind_param("ssssssss", $iname, $idesc, $iipic, $poster, $end_date, $hours, $minutes, $seconds);
                    $stmt->execute();

                    $value = 'successful';
                    $conn->close();
                    header("Location:add_item.php?item=$value");
                }

            } else {

                header("Location:add_item.php");

            }
 
        ?>
    
    </body>
</html>