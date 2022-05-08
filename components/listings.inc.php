<section class="items-section">

    <div class="container mt-4 d-flex mb-5">
        <div class="row">

        <h2>Featured Items</h2>

        <?php 
            if(isset($_GET["bid"])){

                if($_GET["bid"]=="unsuccessful"){
                    echo "<h4 style='color:red'>You are already the highest Bidder!</h4>";
                }

            }
        ?>

        <?php

            session_start();

            if (!isset($_SESSION['username'])) {

                header('Location:login.php');

            } else {

                $cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
                $cleardb_server = $cleardb_url["host"];
                $cleardb_username = $cleardb_url["user"];
                $cleardb_password = $cleardb_url["pass"];
                $cleardb_db = substr($cleardb_url["path"],1);
                $active_group = 'default';
                $query_builder = TRUE;
                // Connect to DB
                $conn = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);

                if ($conn->connect_error) {
                    die('Connection failed!'.$conn->connect_error);
                }

                $statement = "SELECT * FROM item";
                $result = $conn->query($statement);

                while ($row = $result->fetch_assoc()) {
                    $iid = $row["item_id"];
                    $iname = $row["item_name"];
                    $ipic_name = $row["img_name"];
                    $ipic_data = $row["img_data"];
                    $icurrent = $row["current_bid"];
                    $img_base = base64_encode($row["img_data"]);
                    // $iimg = "item/";
                    // $iimg = $iimg.$row["item_pic"];
                    $link = "item_details.php?item_id=";
                    $item_details = $link.$iid;
                    $i_desc = $row["item_desc"];

                    echo "<div class='col-md-4 mt-5'>";
                    echo "<div class='card h-100'>";
                    echo "<img src='data:image/jpg;charset=utf8;base64,$img_base' class='card-img-top w-100' />";
                    echo "<div class='card-body'>";
                    echo "<h2 class='card-title'>$iname</h2>";
                    echo "<div class='d-flex justify-content-between'>";
                    echo "<p class='card-text'>$i_desc</p>";
                    echo "<p class='card-text mr-4 text-success'>Highest Bid: $$icurrent</p>";
                    echo "</div>";
                    echo "<a href='$item_details' class='card-link text-decoration-none'>Bid on Item</a>";
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