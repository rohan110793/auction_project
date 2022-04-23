<!-- <?php require('components/htmlhead.inc.php'); ?>



<?php

    if(isset($_POST["user_id"]) && $_POST["username"]) {

      $user_id = $_POST["user_id"];
      $username = $_POST["username"];

      echo "<div class='modal' id='myModal'>";
      echo "<div class='modal-dialog'>";
      echo "<div class='modal-content'>";
      echo "<div class='modal-header'>";
      echo "<h4 class='modal-title'>Delete $username?</h4>";
      echo "<button type='button' class='close' data-dismiss='modal'>&times;</button>";
      echo "</div>";
      echo "<div class='modal-body'>Are you sure you want to delete this user?</div>";
      echo "<div class='modal-footer'>";
      echo "<form action='check_delete_user.php' method='POST' role='form' class='form-inline'>";
      echo "<input type='hidden' value='$user_id' name='user_id'>";
      echo "<input type='hidden' value='$username' name='username'>";
      echo "<button type='submit' class='btn btn-danger' value='Delete User'>Confirm</button>";
      echo "</form>";
      echo "<button type='button' class='btn btn-light' data-dismiss='modal'>Cancel</button>";
      echo "</div>";
      echo "</div>";
      echo "</div>";
      echo "</div>";

    }

?>




<?php require('components/htmlfoot.inc.php'); ?> -->

<!-- The Modal
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      Modal Header
      <div class="modal-header">
        <h4 class="modal-title">Modal Heading</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      Modal body
      <div class="modal-body">
        Modal body..
      </div>

      Modal footer
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div> -->
