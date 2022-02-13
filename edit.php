<?php
    require_once "./DBBlackbox.php";
    $real_id = (int) $_POST['id'];
    $new_data = find($real_id);
    $new_data["email"] = "virusxd521@gmail.com"; 
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./edit.css">
</head>
<body>
    <?php
        $name_input = "s";
        $email_input = "sMail";
        $number_input = 0;
        $id_input = 100;

        foreach($new_data as $key=> $value){
            
            switch($key){
                case "name":
                    $name_input = $value;
                    break;
                case "email":
                    $email_input = $value;
                    break;
                case "phone":
                    $number_input = $value;
                    break;
                case "id":
                    $id_input = $value;
            };
        };
    ?>
    <h1>You can edit any part of the DB record</h1>
    <form class="main__form" action="./updating.php" method="POST">
        <div class="most-inputs">
            <label for="name">Name</label>
            <input type="name" name="name" id="name" value=<?= $name_input ?>>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value=<?= $email_input ?>>
            <label for="number">phone number</label>
            <input type="number" name="number" id="number" value=<?= $number_input?>>
            <label for="number">id</label>
            <input type="number" name="id" id="id" value=<?= $id_input?>>
        </div>
        <input type="submit" name="submit" value="Change">
    </form>


</body>
</html>

