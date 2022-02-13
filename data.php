<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel=stylesheet href="./data.css">
    </head>
    <body>
        <div class="forms">
            <form class="forms__edit" action="./choosingEditRoute.php" method="GET">

                <input type="submit" name="submitButton" value="Edit an existing item">
            </form>
            <form class="forms__create" action="./addRoute.php" method="GET">

                <input type="submit" name="submitButton" value="Create a new item">
            </form>
        </div>
    </body>
</html>