
<?php require('components/htmlhead.inc.php'); ?>
<?php include('components/navbar.inc.php'); ?>
<?php include('components/header.inc.php'); ?>
<?php

    session_start();

    if (!isset($_SESSION['username'])) {

        header('Location:login.php');

    } else {

        $DBHOST = 'localhost';
        $DBUSER = 'root';
        $DBPWD = '';
        $DBNAME = 'auction_man';

        $conn = new mysqli($DBHOST, $DBUSER, $DBPWD, $DBNAME);

        if ($conn->connect_error) {
            die('Connection failed!'.$conn->connect_error);
        }

        // echo "<h1>Home</h1>";
        // echo "<a href='logout.php' class='logout button'>Logout</a>";
        // echo "<br>";
        // echo "<br>";
        // echo "<br>";
        

        $statement = "SELECT * FROM item";
        $result = $conn->query($statement);

        while ($row = $result->fetch_assoc()) {
            $iid = $row["item_id"];
            $iname = $row["item_name"];
            $ipic = $row["item_pic"];
            $icurrent = $row["current_bid"];
            $iimg = "item/";
            $iimg = $iimg.$row["item_pic"];
            $link = "item_details.php?item_id=";
            $item_details = $link.$iid;

            echo "<div class='item'>";
            echo "<div class='item_row'>Item Id: $iid</div>";
            echo "<div class='item_row'>Item Name: $iname</div>";
            echo "<img src='item_img' src='$iimg' alt='image'>";
            echo "<div class='item_row'>Current Bid: $$icurrent</div>";
            echo "<div class='item_row'><a class='link' href='$item_details'>Item Details</a></div>";
            echo "</div>";
        }

        $conn->close();

    }

?>
<?php require('components/htmlfoot.inc.php'); ?>
        