<section class='user_listings_section'>

    <div class="container mt-4 d-flex mb-5">
        <div class="row">

            <h2>Your Listings</h2>

            <?php

                session_start();

                if (!isset($_SESSION['username'])) {

                    header('Location:login.php');
                    
                } else {

                    $currentUser = $_SESSION['username'];

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

                    $statement = "SELECT * FROM item WHERE posted_by=?";
                    $stmt = $conn->prepare($statement);
                    $stmt->bind_param("s", $currentUser);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows<=0) {
                        echo "<h4>You have not listed any items for sale</h4>";
                    }

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
                        echo "<p class='card-text mr-4 text-success'>$$icurrent</p>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                    }

                }
                
            ?>
    
        </div>
    </div>

</section>