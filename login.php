<?php
    session_start();
    include_once 'database.php';
    include_once 'functions.php';
    const EMAIL_REQUIRED = 'Vul je email in';
    const PASSWORD_REQUIRED = 'Vul je wachtwoord in';

    const CREDENTIALS_NOT_VALID = 'De ingevulde gebruikersnaam/wachtwoord combinatie is niet correct.';

    $errors = [];
    $inputs = [];

    if(isset($_POST['send'])){

        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = trim($email);
        if(empty($email)){
            $errors['email'] = EMAIL_REQUIRED;
        } else{
            $inputs['email'] = $email;
        }

        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
        $password = trim($password);
        if(empty($password)){
            $errors['password'] = PASSWORD_REQUIRED;
        } else{
            $inputs['password'] = $password;
        }

        if(count($errors) === 0){

            $result = checkLogin($inputs);

            switch($result){
                case 'admin':
                    header('Location: admin.php');
                    break;
                case 'member':
                    header('Location: home.php');
                    break;
                case 'FAILURE':
                    $errors['credentials'] = CREDENTIALS_NOT_VALID;

                    break;
            }

        }




    }



?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    <title>Inloggen</title>
</head>
<body>

    <h1>Inloggen</h1>

    <?php if(!empty($errors['credentials'])): ?>

    <div class="alert alert-danger">
        <?=$errors['credentials']  ?>
    </div>

    <?php endif; ?>

    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">


                <form method="post" action="login.php">
                    <div class="mb-3">
                        <label for="inputEmail" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" id="inputEmail"
                               value="<?=$inputs['email'] ?? '' ?>">
                        <div class="form-text text-danger">
                            <?=$errors['email'] ?? '' ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="inputPassword" class="form-label">Wachtwoord</label>
                        <input type="password" name="password" class="form-control" id="inputPassword"
                               value="<?=$inputs['password'] ?? '' ?>">
                        <div class="form-text text-danger">
                            <?=$errors['password'] ?? '' ?>
                        </div>
                    </div>
                    <button type="submit" name="send" class="btn btn-primary">Verstuur</button>
                </form>



            </div>
            <div class="col-md-3"></div>
        </div>


    </div>


</body>
</html>