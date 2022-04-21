<section class="item-card_section">

    <div class="container mt-4 mb-5">
        <div class="row my-2">

            <?php

                session_start();

                if (!isset($_GET["item_id"]) || !isset($_SESSION["username"])) {

                    header("Location:display_items.php");

                } else {

                    $username =	$_SESSION["username"];
                    $DBHOST = "localhost";
                    $DBUSER = "root";
                    $DBPWD = "";
                    $DBNAME = "auction_man";
                    $conn = new mysqli($DBHOST, $DBUSER, $DBPWD, $DBNAME);	

                    if ($conn->connect_error) {
                        die("Connection failed!".$conn->connect_error);
                    }

                    $statement = "SELECT * FROM item WHERE item_id=?";
                    $iid = $_GET["item_id"];

                    $stmt = $conn->prepare($statement);
                    $stmt->bind_param("s", $iid);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $row = $result->fetch_assoc(); /*select the data of the specific item from the ITEM table*/


                    $iid = $row["item_id"];
                    $iname= $row["item_name"];
                    $i_desc = $row["item_desc"];
                    $iiprice = $row["init_bid"];
                    $end = $row["endtime"];
                    $bid_num = $row["bid_num"];
                    $icprice = $row["current_bid"];
                    $iimg = "item/";
                    $iimg = $iimg.$row["item_pic"];

                    echo "<div class='col-lg-6 col-md-6 p-0 py-md-5 my-xs-0 my-lg-4 my-md-5'>";
                    echo "<div class='image py-2 my-lg-0 my-md-5'>";
                    echo "<img src='$iimg' class='img-fluid' alt='image'>";
                    echo "</div>";
                    echo "</div>";
                    echo "<div class='col-lg-6 col-md-6 shadow content p-5'>";
                    echo "<div class='row my-3'>";
                    echo "<div class='d-flex justify-content-between'>";
                    echo "<div class='numOfBids'>Number of Bids: <span>$bid_num</span></div>";
                    echo "<div class='price'>Current Bid: $<span>$icprice</span></div>";
                    echo "</div>";
                    echo "</div>";
                    echo "<div class='row my-lg-5 my-md-4'>";
                    echo "<h1>$iname</h1>";
                    echo "<p>$i_desc</p>";
                    echo "</div>";
                    echo "<div class='row my-5'>";
                    echo "<p>Enter Bid</p>";
                    echo "<form action='bid.php' method='POST' role='form' class='form-inline'>";
                    echo "<input type='hidden' value='$iid' name='item_id'/>";	
                    echo "<input type='hidden' value='$username' name='username'>";
                    echo "<div class='row'>";
                    echo "<div class='col-md-6'>";
                    echo "<div class='input-group'>";
                    echo "<select name='bid' class='custom-select' id='inputGroupSelect04'>";
                    echo "<option selected>Choose...</option>";
                    for ($i=0; $i < 10; $i++) {
                        $j = $i*10;
                        echo "<option value='$j'>$$j</option>";
                    }
                    echo "</select>";
                    echo "<div class='input-group-append'>";
                    echo "<button class='btn btn-primary' type='submit' value='Bid'>Submit</button>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                    echo "</form>";
                    echo "</div>";
                    echo "<div class='row my-3'>";
                    echo "<h5>End Time: $end</h5>";
                    echo "</div>";
                    echo "</div>";

                    $conn->close();

                }

                
            ?>

        </div>
    </div>

</section>