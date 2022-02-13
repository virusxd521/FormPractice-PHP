<?php
    require_once "./DBBlackbox.php";

        // $id = insert();

        if (!empty($_POST)){
            if(!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['phone'])){
                $id = insert($_POST);
                $check =  '<script>alert("Your item has been added to Black box")</script>';
                echo $check;
            }
        };

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel=stylesheet href="./add.css">
</head>
<body>
    <form class="forms" action="./add.php" method="POST">
        <div class="most-inputs">
            <label for="name">Please enter your name</label>
            <input name="name" id="name" type="text">
            
            <label for="email">Please enter your email address</label>
            <input type="email" name="email" id="email">
            
            
            <label for="phone">Please enter your phone number</label>
            <input type="number" name="phone" id="phone">
        </div>
        <input type="submit" name="submitButton" placeholder="submit">
    </form>

    <footer class="footer">
        <form class="footer__form" method="GET" action="./data.php">
            <input type="submit" name="submition" value="Go back to the home page">
        </form>
    </footer>
</body>
</html>