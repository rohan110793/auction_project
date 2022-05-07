<html>
    <head>
        <title>Delete Item</title>
    </head>
    <body>
        
        <?php

            if (!empty($_POST["item_name"])) {

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

                $item_name = $_POST["item_name"];

                $statement = 'SELECT * FROM item WHERE item_name=?';
                $stmt = $conn->prepare($statement);
                $stmt->bind_param("s", $item_name);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows<=0) {
                    $value = "no_item";
                    header("Location:delete_item.php?item=$value");
                } else {
                    $statement = 'DELETE FROM item WHERE item_name=?';
                    $stmt = $conn->prepare($statement);
                    $stmt->bind_param("s", $item_name);
                    $stmt->execute();

                    $value = 'successful';
                    header("Location:delete_item.php?item=$value");
                }
                
                $conn->close();

            } else {

                header("Location:delete_item.php");

            }
 
        ?>
    
    </body>
</html>