<?php
    require_once "./DBBlackbox.php";
    

    if($_SERVER['REQUEST_METHOD'] === 'GET'){
            echo $_GET['id'];
        $finding = find($_GET['id']);
        var_dump($finding); 
        $phone_number = $finding['phone'];
        header( "Location: data.php?phone=".$phone_number );
    }


?>
