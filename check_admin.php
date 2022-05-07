<?php require('components/htmlhead.inc.php'); ?>
<?php

    if(!empty($_POST["username"]) && !empty($_POST["password"])) {
        
        $DBHOST = "localhost";
        $DBUSER = "root";
        $DBPWD = "";
        $DBNAME = "auction_man";

        $conn = new mysqli($DBHOST, $DBUSER, $DBPWD, $DBNAME);
        if($conn->connect_error) {
            die("Connection failed!".$conn->connect_error);
        }
    
        $username = $_POST["username"];
        $statement = "SELECT * FROM auction_admin WHERE username=?";
        $stmt = $conn->prepare($statement);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $hash = $row["password"]; 

        if(password_verify($_POST["password"], $hash)) {
            echo "Successful login";
            session_start();
            $_SESSION["username"] = $_POST["username"];
            $conn->close();
            header("Location: admin_homepage.php");
        } else {
            $value = "unsuccessful";
            $conn->close();
            header("Location:admin_login.php?admin=$value");
        }/*verifies if user has entered correct password*/

    } else {
        $value = "empty";
        header("Location:admin_login.php?admin=$value");
    } /*verify user not directly accessing this page */

?>
<?php require('components/htmlfoot.inc.php'); ?>