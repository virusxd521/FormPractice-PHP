<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
</head>
<body>
    <h1>Hello <?= $_GET['user_name']?></h1>
    <form action="./updating.php" method="GET">
        <p>If you wish to update the DB please give us the id number of the item</p>
        <input type="number" name="id" id="number" value="Please enter the id number" require>
        <input type="submit">
    </form>
</body>
</html>