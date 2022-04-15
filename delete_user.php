<html>
    <head>
        <title>delete_user_page</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>

        <?php
            
            echo "<h1>This is delete user page page</h1>";
            echo "<br>";
            echo "<br>";
            echo "<br>";
            
            echo "<form class='delete_user_form' action='check_delete_user.php' method='POST'>";

            if(isset($_GET["user"])){

                if($_GET["user"]=="no_account"){
                    echo "<h4>Such user does not exit. Please enter existing account</h4>";
                    echo "<br>";
                    echo "<br>";
                }
                else if($_GET["user"]=="deleted"){
                    echo "<h4>User deleted</h4>";
                    echo "<br>";
                    echo "<br>";
                }
                else if($_GET["user"]=="wrong_password"){
                    echo "<h4>Wrong user password combination. Enter again</h4>";
                    echo "<br>";
                    echo "<br>";
                }

            }
            else{   
                echo "<h4>Delete User</h4>";
                echo "<br>";
                echo "<br>";
            }


            echo "<label class='label' for='username'>Username:</label>";
            echo "<input class='text' type='text' name='username' placeholder='username'>";
            echo "<br>";
            echo "<br>";

            echo "<label class='label' for='password'>Password:</label>";
            echo "<input class='password' type='text' name='password' placeholder='password'>";
            echo "<br>";
            echo "<br>";

            echo "<input class='submit' type='submit' value='Delete User'>";
            echo "<br>";
            echo "<br>";
            
            echo "</form>";
            
        ?>
    
    </body>
</html>