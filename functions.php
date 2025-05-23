<?php


function checkLogin($inputs)
{
    global $pdo;

    $query = $pdo->prepare('SELECT * FROM user WHERE email = :email');
    $query->bindParam(':email', $inputs['email']);

    $query->execute();
    $users = $query->fetchAll(PDO::FETCH_ASSOC);

    if (count($users) === 0) {
        //bestaat niet, dus niet ingelogd
        return 'FAILURE';
    } else {
        //var_dump($users[0]);
        //bestaat wel, dan gaan we wachtwoord checken

        $user = $users[0];
        /*echo $user['email'];
        echo '<br>';
        echo $user['password'];
        echo '<br>';
        echo $inputs['password'];
        echo '<br>';*/

        if (password_verify($inputs['password'], $user['password'])) {
            //1. email klopt/bestaat
            //2. wachtwoord klopt
            $_SESSION['email'] = $user['email'];
            $_SESSION['user_id'] = $user['id'];

            return 'ADMIN';
        } else {
            return 'FAILURE';
        }

    }
}

function isLoggedIn(): bool
{


    if (isset($_SESSION['email']) && !empty($_SESSION['email'])) {
        //dan zijn we ingelogd
        return true;
    } else {
        //we zijn niet ingelogd
        return false;
    }


}


