<nav class="navbar fixed-top navbar-expand-sm navbar-light bg-light">

    <div class="container">

        <a href="display_items.php" class="navbar-brand mb-0">
            <img 
                class="d-inline-block align-top logo_image"
                src="item/sa_logo_notext-removebg-resize.png"
                width="30"
                height="30"
            />
        </a>

        <button 
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarNav"
            aria-controls="navbarNav"
            aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div 
            class="collapse navbar-collapse" 
            id="navbarNav">
            <ul class="navbar-nav ms-auto text-center">

                <?php

                    $curPageName = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);

                    if ((!isset($_SESSION['username'])) and $curPageName == 'login.php') {
                        echo "<li class='nav-item'>";
                        echo "<a href='add_user.php' class='nav-link'>Sign Up</a>";
                        echo "</li>";
                    } else if ((!isset($_SESSION['username'])) and $curPageName == 'add_user.php') {
                        echo "<li class='nav-item'>";
                        echo "<a href='login.php' class='nav-link'>Login</a>";
                        echo "</li>";
                    } else if ((!isset($_SESSION['username'])) and $curPageName == 'relogin.php') {
                        echo "<li class='nav-item'>";
                        echo "<a href='add_user.php' class='nav-link'>Sign Up</a>";
                        echo "</li>";
                    } else {
                        echo "<li class='nav-item'>";
                        echo "<a href='#' class='nav-link'>Profile</a>";
                        echo "</li>";

                        echo "<li class='nav-item'>";
                        echo "<a href='#' class='nav-link'>Bids</a>";
                        echo "</li>";

                        echo "<li class='nav-item'>";
                        echo "<a href='logout.php' class='nav-link'>Logout</a>";
                        echo "</li>";
                    }

                ?>

            </ul>
        </div>

    </div>

</nav>