<?php
session_start();

include_once 'functions.php';

if(!isLoggedIn()){
    header('Location: login.php');
}

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
</head>
<body>
    <h1>Admin</h1>



    <p>
    <?php
        echo $_SESSION['email'];
    ?>
    </p>
</body>
</html>
