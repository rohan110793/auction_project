<html>
    <head><title>logout</title> 
        <link href="style.css" rel="stylesheet" type="css/text/css">
        
    </head> 
    <body>
        

        <?php
            session_start();
            if(isset($_SESSION["username"])) {
    
                $_SESSION = array();

                session_destroy();
            
                echo "<h1 id='exit_title'>Thanks For Coming! Bye Now!</h1>";
                header("Location:login.php");

            } else {

                header("Location:login.php");
                
            }
        ?>


    </body>
</html>