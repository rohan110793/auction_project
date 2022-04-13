<html>
    <head>
        <title>signup_page</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>

        <?php
            
            echo "<h1>This is signup page</h1>";
            echo "<br>";
            echo "<br>";
            echo "<br>";
            
            echo "<form class='add_user_form' action='check_user.php' method='POST'>";

            if(isset($_GET["user"])){

                if($_GET["user"]=="successful"){
                    echo "<h4>Successfully added user!</h4>";
                    echo "<br>";
                    echo "<br>";
                }
                else if($_GET["user"]=="duplicate"){
                    echo "<h4>User already exists</h4>";
                    echo "<br>";
                    echo "<br>";
                }

            }
            else{   
                echo "<h4>Please signup</h4>";
                echo "<br>";
                echo "<br>";
            }


            echo "<label class='label' for='firstname'>First Name:</label>";
            echo "<input class='text' type='text' name='firstname' placeholder='firstname'>";
            echo "<br>";
            echo "<br>";

            echo "<label class='label' for='lastname'>Last Name:</label>";
            echo "<input class='text' type='text' name='lastname' placeholder='lastname'>";
            echo "<br>";
            echo "<br>";

            echo "<label class='label' for='username'>Username:</label>";
            echo "<input class='text' type='text' name='username' placeholder='username'>";
            echo "<br>";
            echo "<br>";

            echo "<label class='label' for='password'>Password:</label>";
            echo "<input class='password' type='text' name='password' placeholder='password'>";
            echo "<br>";
            echo "<br>";

            echo "<input class='submit' type='submit' value='Add User'>";
            echo "<br>";
            echo "<br>";
            
            echo "</form>";
            
        ?>
    
    </body>
</html>