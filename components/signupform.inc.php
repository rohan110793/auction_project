<section class="login-form my-4 mx-5">

    <div class="form-container">
        <div class="row">
            <div class="col-lg-5">
                <img src="item/sale.jpg"  class="img-fluid login-img" alt="" >
            </div>
            <div class="col-lg-7 px-5 pt-5">
                <img 
                    class="d-inline-block align-top logo_image my-3"
                    src="item/sa_logo_notext-removebg-resize.png"
                    width="60"
                    height="60"
                />
                <h4>Sign Into Your Account</h4>

                <?php

                    if(isset($_GET["user"])) {

                        if($_GET["user"]=="duplicate") {
                            echo "<p style='color:red;'>User already exists</p>";
                        }

                    }

                ?>

                <form action='check_user.php' method='post' role='form'>
                    <div class="form-row">
                        <div class="col-lg-7">
                            <input type="text" placeholder="First Name" class="form-control my-3" name="firstname">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-lg-7">
                            <input type="text" placeholder="Last Name" class="form-control my-3" name="lastname">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-lg-7">
                            <input type="text" placeholder="Username" class="form-control my-3" name="username">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-lg-7">
                            <input type="password" placeholder="Password" class="form-control my-3" name="password">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-lg-7">
                            <input type="submit" class="btn1 mt-3 mb-4" value="Register"/>
                        </div>
                    </div>
                    <a href="#">Admin Login</a>
                    <p>Already have an account? <a href="login.php">Login here</a></p>
                </form>
            </div>
        </div>
    </div>

</section>