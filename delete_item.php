<html>
    <head>
        <title>Delete Item</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>

        <?php

            echo "<h1>Delete Items Page</h1>";
            echo "<br>";
            echo "<br>";
            echo "<br>";

            echo "<form class='delete_item_form' action='check_delete_item.php' method='POST'>";

            if (isset($_GET["item"])) {

                if ($_GET["item"] == "no_item") {
                    echo "<h4>No such item exists</h4>";
                    echo "<br>";
                    echo "<h4>Please Try Again</h4>";
                } else if ($_GET["item"] == "successful") {
                    echo "<h4>Successfully Deleted The Item!</h4>";
                }

            } else {

                echo "<h4>To Delete An Item, Please Enter The Item Name</h4>";
                
            }

            echo "<label class='label' for='item_name'>Item Name:</label>";
            echo "<input class='text' type='text' name='item_name' placeholder='Item Name'>";
            echo "<input class='submit' type='submit' value='Delete Item'>";

            echo "</form>";
        
        ?>
        
    </body>
</html>