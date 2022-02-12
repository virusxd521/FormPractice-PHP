<?php
    require_once "./DBBlackbox.php";

    $a_number = 0;

    function checkingParams(&$number_to_change ,$param){
        if(isset($_GET[$param])){
            $number_to_change = (int) $_GET[$param];
        } else {
            return 0;
        }
    }

    checkingParams($a_number,"phone");
    

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel=stylesheet href="./style.css">
</head>
<body>
    <form class="form" action="./edit.php" method="POST">
        <div class="form__div">
            <label for="name">What's your name?</label>
            <input id="name" name="name" type="text">
            <label for="email">What's your email address?</label>
            <input name="email" id="email" type="email">
            <label for="phone">What's your phone number?</label>
            <input value="<?php echo $a_number; ?>"  name="phone" id="phone" type="number">
         
        </div>
        <input type="submit" name="submitButton" placeholder="submit">
    </form>
</body>
</html>