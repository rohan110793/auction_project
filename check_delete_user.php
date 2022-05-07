<html>
    <head><title></title>

        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head> 
    <body>
        <?php

            // function write_to_console($data) {
            //     $console = $data;
            //     if (is_array($console))
            //     $console = implode(',', $console);
            
            //     echo "<script>console.log('Console: " . $console . "' );</script>";
            // }



            if(!empty($_POST["user_id"]) && !empty($_POST["username"])) {

                $cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
                $cleardb_server = $cleardb_url["host"];
                $cleardb_username = $cleardb_url["user"];
                $cleardb_password = $cleardb_url["pass"];
                $cleardb_db = substr($cleardb_url["path"],1);
                $active_group = 'default';
                $query_builder = TRUE;
                // Connect to DB
                $conn = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);


                if($conn->connect_error) {
                    die("Connection failed!".$conn->connect_error);
                }
                
                $username = $_POST["username"];
                // $password = $_POST["password"];
                $statement = "SELECT * FROM user WHERE username=?";
                $stmt = $conn->prepare($statement);
                $stmt->bind_param("s", $username);
                $stmt->execute();
                $result = $stmt->get_result();

                if($result->num_rows<=0) {

                    $value= "no_account";
                    header("Location:admin_homepage.php?user=$value");

                } else {

                    $row = $result->fetch_assoc();

                    $statement = "DELETE FROM user WHERE username=?";
                    $stmt = $conn->prepare($statement);
                    $stmt->bind_param("s", $username);
                    $stmt->execute();
                    $value= "deleted";
                    header("Location:admin_homepage.php?user=$value");
                    
                    // write_to_console($row["password"]);
                    
                    // if(password_verify($password, $row["password"])) {
                    //     $statement = "DELETE FROM user WHERE username=?";
                    //     $stmt = $conn->prepare($statement);
                    //     $stmt->bind_param("s", $username);
                    //     $stmt->execute();
                    //     $value= "deleted";
                    //     header("Location:delete_user.php?user=$value");
                    // } else {
                    //     $value= "wrong_password";
                    //     header("Location:delete_user.php?user=$value");
                    // }/*verify password after buyer exists, is the password correct */

                } 

                $conn->close();

            } else {

                header("Location:admin_homepage.php");

            } 


        ?>
    </body>
</html>

