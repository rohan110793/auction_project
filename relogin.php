<?php require('components/htmlhead.inc.php'); ?>
<?php include('components/navbar.inc.php'); ?>
<?php
    
    echo "<h1>Re Login</h1>";
    echo "<br>";
    echo "<br>";
    echo "<br>";

    echo "<br>";
    echo "<form class='relogin_form' action='check_login.php' method='POST'>";
    echo "<h4>Please Login Again</h4>";
    echo "<label for='username' class='label'> Username:</label>";
    echo "<input class='text' type='text' name='username' placeholder='Username'>";
    echo "<br>";
    echo "<label for='password' class='label'>Password:</label>";
    echo "<input  class='password' type='password' name='password' placeholder='Password'>";
    echo "<br>";
    echo "<input class='submit' type='submit' value='Sign in'/>";	
    echo "</form>";
    
?>
<?php require('components/htmlfoot.inc.php'); ?>