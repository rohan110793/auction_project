<section class="all_items-section">

    <div class="container mt-4 d-flex mb-5">
        <div class="row">

            <h2>All Listings</h2>

            <?php

                if (!isset($_SESSION['username'])) {

                    header("Location:admin_login.php");

                } else {

                    $DBHOST = 'localhost';
                    $DBUSER = 'root';
                    $DBPWD = '';
                    $DBNAME = 'auction_man';

                    $conn = new mysqli($DBHOST, $DBUSER, $DBPWD, $DBNAME);

                    if ($conn->connect_error) {
                        die('Connection failed!'.$conn->connect_error);
                    }

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
                        $i_desc = $row["item_desc"];
    
                        echo "<div class='col-md-4 mt-5'>";
                        echo "<div class='card h-100'>";
                        echo "<img src='$iimg' class='card-img-top w-100' />";
                        echo "<div class='card-body'>";
                        echo "<h2 class='card-title'>$iname</h2>";
                        echo "<div class='d-flex justify-content-between'>";
                        echo "<p class='card-text'>$i_desc</p>";
                        echo "<p class='card-text mr-4 text-success'>$$icurrent</p>";
                        echo "</div>";
                        echo "<a type='button' rel='$iname' class='delete_item_btn btn btn-danger btn-sm'>Delete Item</a>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                    }

                }

            ?>

        </div>
    </div>

</section>