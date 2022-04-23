<section class="all_users-section">

    <div class="container mt-4 d-flex mb-5">
        <div class="row">

            <h2>All Users</h2>

            <?php

                session_start();

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

                    $statement = "SELECT * FROM user";
                    $result = $conn->query($statement);

                    while ($row = $result->fetch_assoc()) {
                        $uid = $row['user_id'];
                        $uname = $row['username'];
                        $ufirst = $row['firstname'];
                        $ulast = $row['lastname'];

                        echo "<div class='col-md-4 mt-5'>";
                        echo "<div class='card'>";
                        echo "<div class='card-body'>";
                        echo "<h2 class='card-title'>$uname</h2>";
                        echo "<div class='d-flex justify-content-between'>";
                        echo "<p class='card-text'>First Name: $ufirst</p>";
                        echo "<p class='card-text'>Last Name: $ulast</p>";
                        echo "<p class='card-text mr-4'>User ID: $uid</p>";
                        echo "</div>";
                        // Try changing it to something involving the headers so it doesnt refresh page contents
                        // on form submit
                        // echo "<form action='admin_homepage.php' method='POST' role='form' class='form-inline'>";
                        // echo "<input type='hidden' value='$uid' name='user_id'/>";	
                        // echo "<input type='hidden' value='$uname' name='username'>";
                        echo "<a type='button' rel='$uname' class='delete_btn btn btn-danger btn-sm'>Delete User</a>";
                        // echo "</form>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                    }

                }

            ?>

        </div>
    </div>

</section>