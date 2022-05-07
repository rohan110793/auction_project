<?php require('components/htmlhead.inc.php'); ?>
<?php include('components/navbar.inc.php'); ?>
<?php include('components/header.inc.php'); ?>
<?php include('components/postitemform.inc.php'); ?>
<script>
    var tomorrow = new Date();
    var dd = tomorrow.getDate()+1;
    var mm = tomorrow.getMonth()+1; //January is 0 so need to add 1 to make it 1!
    var yyyy = tomorrow.getFullYear();
    if(dd<10){
    dd='0'+dd
    } 
    if(mm<10){
    mm='0'+mm
    } 

    tomorrow = yyyy+'-'+mm+'-'+dd;
    document.getElementById("datefield").setAttribute("min", tomorrow);
</script>
<?php require('components/htmlfoot.inc.php'); ?>