<?php


function checkLogin($inputs){
    global $pdo;

    $query = $pdo->prepare('SELECT * FROM user WHERE email = :email');
    $query->bindParam(':email', $inputs['email']);

    $query->execute();
    $users = $query->fetchAll(PDO::FETCH_ASSOC);

    echo $users;
}


