<html>
    <head>
        <title>Add Item</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>

        <?php

            session_start();

            if (!isset($_SESSION['username'])) {

                header('Location:login.php');
                
            } else {

                $currentUser = $_SESSION['username'];

                
                echo "<h1>Add Items Page</h1>";
                echo "<br>";
                echo "<br>";
                echo "<br>";

                echo "<form class='add_item_form' action='check_item.php' method='POST' enctype='multipart/form-data'>";
                
                if (isset($_GET["item"])) {

                    if ($_GET["item"] == "duplicate") {
                        echo "<h4>Already entered this item</h4>";
                        echo "<br>";
                        echo "<h4>Please try again</h4>";
                    } else if ($_GET["item"] == "successful") {
                        echo "<h4>Successfully Added an Item!</h4>";
                    }

                } else {

                    echo "<h4>Please add an item</h4>";
                    
                }

                echo "<input type='hidden' name='username' value='$currentUser' />";
                echo "<br>";

                echo "<label class='label' for='item_name'>Item Name:</label>";
                echo "<input class='text' type='text' name='item_name'/>";
                echo "<br>";

                echo "<label class='label' for='item_description'>Item Description:</label>";
                echo "<input class='text' type='text' name='item_description'/>";
                echo "<br>";

                echo "<label class='label' for='end_date'>Choose Ending Date:</label>";
                echo "<input type='date' id='datefield' name='end_date'/>";
                echo "<br>";

                echo "<label class='label' for='end_time'>Choose Ending Time:</label>";
                echo "<input type='time' id='timefield' value='12:00' name='end_time' />";
                echo "<br>";

                echo "<label class='label' for='item_pic'>Item Picture:</label>";
                echo "<input class='text' type='file' value='item_pic' name='item_pic'/>";
                echo "<br>";

                echo "<input class='submit' type='submit' value='Add Item'/>";
                echo "</form>";

            }

        
        ?>

        <script>
            var tomorrow = new Date();
            var dd = tomorrow.getDate()+1;
            var mm = tomorrow.getMonth()+1; //January is 0 so need to add 1 to make it 1!
            var yyyy = tomorrow.getFullYear();
            if(dd<10){
            dd='0'+dd
            } 
            if(mm<10){
            mm='0'+mm
            } 

            tomorrow = yyyy+'-'+mm+'-'+dd;
            document.getElementById("datefield").setAttribute("min", tomorrow);
        </script>
        
    </body>
</html>