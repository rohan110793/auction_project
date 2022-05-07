<section class="all_users-section">

    <div class="container mt-4 d-flex mb-5">
        <div class="row">

            <h2>All Users</h2>

            <?php

                session_start();

                if (!isset($_SESSION['username'])) {

                    header("Location:admin_login.php");

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

                    $statement = "SELECT * FROM user";
                    $result = $conn->query($statement);

                    while ($row = $result->fetch_assoc()) {
                        $uid = $row['user_id'];
                        $uname = $row['username'];
                        $ufirst = $row['firstname'];
                        $ulast = $row['lastname'];

                        echo "<div class='col-md-4 mt-5'>";
                        echo "<div class='card h-100'>";
                        echo "<div class='card-body'>";
                        echo "<h2 class='card-title'>$uname</h2>";
                        echo "<div class='d-flex justify-content-between'>";
                        echo "<p class='card-text'>First Name: $ufirst</p>";
                        echo "<p class='card-text'>Last Name: $ulast</p>";
                        echo "<p class='card-text mr-4'>User ID: $uid</p>";
                        echo "</div>";
                        echo "<a type='button' rel='$uname' class='delete_btn btn btn-danger btn-sm'>Delete User</a>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                    }

                    $conn->close();

                }

            ?>

        </div>
    </div>

</section>