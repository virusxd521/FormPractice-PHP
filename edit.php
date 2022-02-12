<?php
    require "./DBBlackbox.php";
    require "./data.php";
    $id = $_POST;
    insert($id);
    header( "Location: submition.php?user_name=".$id['name'] );
   exit;
?>  