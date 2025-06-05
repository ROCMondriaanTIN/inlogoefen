<?php
session_start();

include_once 'functions.php';

if(!isLoggedIn()){
    header('Location: login.php');
}
if(!hasRole('admin')){
    header('Location: 403.php');
}

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php
    include_once 'bootstrap.php';
    ?>
    <title>Admin</title>
</head>
<body>


<header>
    <?php
    include_once 'nav.php';
    ?>
</header>

<main>
    <h1>Admin</h1>



    <p>
    <?php
        echo $_SESSION['email'];
    ?>
    </p>

</main>

<footer>

</footer>
</body>
</html>
