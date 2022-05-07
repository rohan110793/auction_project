<html>
    <head>
        <title>signup</title>
    </head>
    <body>
        
        <?php


            if( !empty($_POST["username"]) && !empty($_POST["password"]) ){
            


                //connection variables
                $cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
                $cleardb_server = $cleardb_url["host"];
                $cleardb_username = $cleardb_url["user"];
                $cleardb_password = $cleardb_url["pass"];
                $cleardb_db = substr($cleardb_url["path"],1);
                $active_group = 'default';
                $query_builder = TRUE;
                // Connect to DB
                $conn = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);

                //echo "this is our db conn page";

                //error handling for connection
                if(!$conn){
                    die("connection error:" . mysqli_connect_error());
                } else{
                    echo "connection successful!";
                }    


                //input posted variables
                $firstname = $_POST["firstname"];
                $lastname = $_POST["lastname"];
                $username = $_POST["username"];
                $password = $_POST["password"];

                //hash the password
                $hashed = password_hash($password, PASSWORD_DEFAULT);

                //check username duplication
                $statement = "SELECT * FROM user WHERE username=?";

                $stmt = $conn->prepare($statement);
                $stmt->bind_param("s", $username);
                $stmt->execute();

                $result = $stmt->get_result();

                if($result->num_rows>=1){ // We need to change this handler to display an error message on signup form
                    $value = "duplicate";
                    header("Location:add_user.php?user=$value");

                    $conn->close();
                } else {
                    
                    $statement = "INSERT INTO user(firstname,lastname,username,password)  VALUES(?,?,?,?)";
                    $stmt = $conn->prepare($statement);
                    $stmt->bind_param("ssss", $firstname, $lastname, $username, $hashed);
                    $stmt->execute();

                    session_start();
		            $_SESSION["username"] = $username;
                    $conn->close();
		            header("Location: display_items.php");
                }

            } else {
                header("Location:add_user.php");
            }

        ?>
    
    </body>
</html>