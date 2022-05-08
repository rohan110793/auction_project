<section class="post-item-section my-4 mx-5">

    <div class="container-sm">
        <h1>Post An Item</h1>
        <form class='row' action='check_item.php' method='POST' enctype='multipart/form-data'>

            <?php

                session_start();

                if (!isset($_SESSION['username'])) {

                    header('Location:login.php');
                    
                } else {

                    $currentUser = $_SESSION['username'];

                    if (isset($_GET["item"])) {

                        if ($_GET["item"] == "duplicate") {
                            echo "<h4 style='color:red'>Already entered this item</h4>";
                        } else if ($_GET["item"] == "successful") {
                            echo "<h4>Successfully Added an Item!</h4>";
                        }
            
                    }
            
                    echo "<input type='hidden' name='username' value='$currentUser' />";
                    echo "<br>";

                }
            
            ?>

            <div class="post-item-row mb-3">
                <div class="justify-content-center">
                    <label class='label' for='item_name'>Item Name:</label>
                    <input type='text' class='form-control' id='item_name' name='item_name' required>
                </div>
            </div>

            <div class="post-item-row mb-3">
                <div class="justify-content-center">
                    <label class='label' for='item_description'>Item Description:</label>
                    <textarea type='text' class='form-control' id='item_description' name='item_description' required></textarea>
                </div>
            </div>

            <div class="post-item-row mb-3">
                <div class="justify-content-center">
                    <label class='label' for='end_date'>Ending Date:</label>
                    <input type='date' class="form-control" id='datefield' name='end_date' required>
                </div>
            </div>

            <div class="post-item-row mb-3">
                <div class="justify-content-center">
                    <label class='label' for='end_time'>Ending Time:</label>
                    <input type='time' class="form-control" id='timefield' value='12:00' name='end_time'>
                </div>
            </div>

            <div class="post-item-row mb-3">
                <div class="justify-content-center">
                    <label class='label' for='item_pic'>Item Picture:</label>
                    <input class='text form-control' type='file' accept="image/*" value='item_pic' name='item_pic'>
                </div>
            </div>

            <div class="col-lg-7">
                <input type="submit" class="btn btn-primary mt-3 mb-5" value="Add Item"/>
            </div>

        </form>
    </div>

</section>