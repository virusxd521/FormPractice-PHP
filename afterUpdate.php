<?php
    $check =  '<script>alert("Your item has been updated")</script>';
    echo $check;
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./afterUpdate.css">
</head>
<body>
    <h1>Now that you've successfully updated the DB you can go to the home page</h1>
    <form class="main__form" method="GET" action="./data.php">
        <input type="submit" name="submition" value="Go back to the home page">
    </form>

</body>
</html>