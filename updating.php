<?php

    require_once "./DBBlackbox.php";
    // var_dump($_POST);
    $id = $_POST['id'];
    // update($id, );
    $data = [];
    foreach($_POST as $key=>$value){
        switch($key){
            case "name":
            case "email":
            case "phone":
                $data += [$key=>$value];
                break;    
        }
        
    }

    update($id, $data);
    


    var_dump(find($id));

    header( "Location: afterUpdate.php?id=".$id);
?>