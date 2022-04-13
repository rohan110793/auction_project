<html>
    <head>
        <title>signup</title>
    </head>
    <body>
        
        <?php


            if( !empty($_POST["username"]) && !empty($_POST["password"]) ){
            


            //connection variables
            $DBHOST = "localhost";
            $DBUSER = "root";
            $DBPASS = "";
            $DBNAME = "auction_man";

            //connection to db
            $conn = new mysqli($DBHOST, $DBUSER, $DBPASS, $DBNAME);

            //echo "this is our db conn page";

            //error handling for connection
            if(!$conn){
                die("connection error:" . mysqli_connect_error());
            }   
            else{
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

            if($result->num_rows>=1){
                $value = "duplicate";
                header("Location:add_user.php?user=$value");
            }
            else{
                
                $statement = "INSERT INTO user(firstname,lastname,username,password)  VALUES(?,?,?,?)";
                $stmt = $conn->prepare($statement);
                $stmt->bind_param("ssss", $firstname, $lastname, $username, $hashed);
                $stmt->execute();

                $value = "successful";
                header("Location:add_user.php?user=$value");


                $conn->close();
            }

            }
            
            
            else{
                header("Location:add_user.php");
            }

        ?>
    
    </body>
</html>