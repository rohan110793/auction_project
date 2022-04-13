<html>
    <head>
        <title>Add Item</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>

        <?php

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


            echo "<label class='label' for='item_name'>Item Name:</label>";
            echo "<input class='text' type='text' name='item_name'/>";
            echo "<br>";

            echo "<label class='label' for='item_description'>Item Description:</label>";
            echo "<input class='text' type='text' name='item_description'/>";
            echo "<br>";

            echo "<label class='label' for='endtime'>Ending Bid Time:</label>";
            echo "<input class='text' type='text' name='endtime'/>";
            echo "<br>";

            echo "<label class='label' for='item_pic'>Itme Picture:</label>";
            echo "<input class='text' type='file' value='item_pic' name='item_pic'/>";
            echo "<br>";

            echo "<input class='submit' type='submit' value='Add Item'/>";
            echo "</form>";
        
        ?>
        
    </body>
</html>