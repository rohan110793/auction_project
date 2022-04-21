<section class="items-section">

    <div class="container mt-4 d-flex mb-5">
        <div class="row">

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
                    echo "<div class='card'>";
                    echo "<img src='$iimg' class='card-img-top w-100' />";
                    echo "<div class='card-body'>";
                    echo "<h2 class='card-title'>$iname</h2>";
                    echo "<div class='d-flex justify-content-between'>";
                    echo "<p class='card-text'>$i_desc</p>";
                    echo "<p class='card-text mr-4 text-success'>$$icurrent</p>";
                    echo "</div>";
                    echo "<a href='$item_details' class='card-link text-decoration-none'>Item Details</a>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                }

            }

            // <div class="col-md-4 mt-5">
            //     <div class="card">
            //         <img src="item/item_4.jpeg" class="card-img-top w-100" />
            //         <div class="card-body">
            //             <h2 class="card-title">Yellow Shirt</h2>
            //             <div class="d-flex justify-content-between">
            //                 <p class="card-text">This shirt is yellow</p>
            //                 <p class="card-text mr-4 text-success">$4M</p>
            //             </div>
            //             <a href="#" class="card-link text-decoration-none">Item Details</a>
            //         </div>
            //     </div>
            // </div>

        ?>

        </div>
    </div>

</section>