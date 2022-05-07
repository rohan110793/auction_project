<?php require('components/htmlhead.inc.php'); ?>
<?php include('components/navbar.inc.php'); ?>
<?php include('components/header.inc.php'); ?>
<?php include('components/allusers.inc.php'); ?>
<?php include('components/admin-listings.inc.php'); ?>
<?php 

    if (isset($_GET['delete'])) {

        $DBHOST = "localhost";
        $DBUSER = "root";
        $DBPWD = "";
        $DBNAME = "auction_man";
        $conn = new mysqli($DBHOST, $DBUSER, $DBPWD, $DBNAME);


        if($conn->connect_error) {
            die("Connection failed!".$conn->connect_error);
        }

        $username = $_GET["delete"];

        $statement = "DELETE FROM user WHERE username=?";
        $stmt = $conn->prepare($statement);
        $stmt->bind_param("s", $username);
        $stmt->execute();

        $conn->close();

        if (headers_sent()) {
            echo "<script type='text/javascript'>window.location.href='admin_homepage.php';</script>";
        }

        

    } else if (isset($_GET['delete_item'])) {

        $DBHOST = "localhost";
        $DBUSER = "root";
        $DBPWD = "";
        $DBNAME = "auction_man";
        $conn = new mysqli($DBHOST, $DBUSER, $DBPWD, $DBNAME);


        if($conn->connect_error) {
            die("Connection failed!".$conn->connect_error);
        }

        $item_name = $_GET["delete_item"];
 
        $statement = 'DELETE FROM item WHERE item_name=?';
        $stmt = $conn->prepare($statement);
        $stmt->bind_param("s", $item_name);
        $stmt->execute();
        
        $conn->close();

        if (headers_sent()) {
            echo "<script type='text/javascript'>window.location.href='admin_homepage.php';</script>";
        }

    }

?>

        <div class="modal" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">
                
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Modal Heading</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    
                    <!-- Modal body -->
                    <div class="modal-body">
                        Are you sure you want to delete this user?
                    </div>
                    
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <a type='button' href='javascript:void(0)' class='confirm_delete btn btn-danger btn-sm'>Confirm</a>
                        <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                    </div>
                    
                </div>
            </div>
        </div>



        <!-- Delete Item Modal -->

        <div class="modal" id="myItemModal">
            <div class="modal-dialog">
                <div class="modal-content">
                
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Modal Heading</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    
                    <!-- Modal body -->
                    <div class="modal-body">
                        Are you sure you want to delete this item?
                    </div>
                    
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <a type='button' href='javascript:void(0)' class='confirm_delete btn btn-danger btn-sm'>Confirm</a>
                        <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                    </div>
                    
                </div>
            </div>
        </div>




        <script>

            $(document).ready(function() {

                $(".delete_btn").on("click", function() {
                    let user = $(this).attr('rel')
                    let deleteUrl = "admin_homepage.php?delete=" + user

                    let myModal= $('#myModal')
                    myModal.find('.modal-title').text('Delete ' + user)

                    $('.confirm_delete').attr('href', deleteUrl)
                    myModal.modal('show')
                })

                $(".delete_item_btn").on("click", function() {
                    let item = $(this).attr('rel')
                    let deleteUrl = "admin_homepage.php?delete_item=" + item

                    let myItemModal = $("#myItemModal")
                    myItemModal.find('.modal-title').text('Delete ' + item)

                    $('.confirm_delete').attr('href', deleteUrl)
                    myItemModal.modal('show')
                })

            })

        </script>

    </body>

</html>