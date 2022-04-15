<html>
    <head><title></title>

    <link rel="stylesheet" type="text/css" href="style.css">

    </head>
    <body>

        <?php

            echo "<h1>Home</h1>";
            echo "<a href='logout.php' class='logout button'>Logout</a>";
            echo "<br>";
            echo "<br>";
            echo "<br>";

            $DBHOST = "localhost";
            $DBUSER = "root";
            $DBPWD = "";
            $DBNAME = "auction_man";

            $conn = new mysqli($DBHOST, $DBUSER, $DBPWD, $DBNAME);	

            if ($conn->connect_error) {
                die("Connection failed!".$conn->connect_error);
            }

            
            if (!isset($_POST["item_id"])) {
                header("Location: display_items.php");
            } else {
                $item_id = $_POST["item_id"];
                session_start();

                $statement = "SELECT * FROM bid WHERE item_id=?";
                $stmt = $conn->prepare($statement);
                $stmt->bind_param("s", $item_id);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();

                if ($_SESSION["username"] == $row["username"]) {
                    echo "You are already the highest bidder";
                } else {
                    $statement = "SELECT * FROM item WHERE item_id=?";
                    $stmt = $conn->prepare($statement);
                    $stmt->bind_param("s", $item_id);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $row = $result->fetch_assoc();
                    $bid = $_POST["bid"];
                    $username = $_SESSION["username"];
                    /*determine if user bid properly*/

                    if ($bid>$row["current_bid"]) {
                        
                        $statement= "UPDATE item SET current_bid=? WHERE item_id=?";
                        $stmt = $conn->prepare($statement); 
                        $stmt->bind_param("dd", $bid, $item_id);
                        $stmt->execute();
                        /*updates the bid value*/

                        $statement= "UPDATE item SET bid_num=bid_num+1 WHERE item_id=?";
                        $stmt = $conn->prepare($statement);
                        $stmt->bind_param("d", $item_id);
                        $stmt->execute();  
                        /*updates the number of bids*/ 
                        
                        $statement = "INSERT INTO bid(username, item_id, bid_price) VALUES(?, ?, ?)";
                        $stmt = $conn->prepare($statement);

                        $stmt->bind_param("sid", $username, $item_id, $bid);
                        $stmt->execute();

                        $statement = "DELETE FROM bid WHERE bid_price<? AND item_id=?";
                        $stmt = $conn->prepare($statement);
                        $stmt->bind_param("dd", $bid, $item_id);
                        $stmt->execute();

                        echo "Congratulations, the current bid value is $".$bid;
                        $stmt->close();

                    } else {
                        echo "Your bid must be greater than the current bid price.";
                    } /* check to see if you bid greater than current bid */
                } /* check to see if you are already the greatest bidder */

                $conn->close();

            } /* prevent direct access by user */

        ?>
    </body>
</html>