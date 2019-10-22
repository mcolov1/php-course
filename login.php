<?php
session_start([
    'cookie_httponly' => true,
]);
require_once 'functions.php';
require_once 'config/db.php';
require_once 'config/settings.php';



showArray($_POST);
if (isset($_POST['Login'])) {
    $errors = [];
    $email = '';
    if(isset($_POST['email'])) {
        $email = trim($_POST['email']);
    }
    $password = '';
    if(isset($_POST['password'])) {
        $password = trim($_POST['password']);
    }
    if (!mb_strlen($email)) {
        $errors['email'] = 'Моля въведете имейл адрес.';
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Въвели сте невалиден имейл адрес.';
    } else {
        $checkemail = " SELECT
        `id`,
        `country_id`,
        `first_name`,
        `email`,
        `last_name`,
        `username`,
        `age`,
        `password`,
        `created_at`,
        `updated_at`
        FROM `".TABLE_USERS."`
        WHERE `email` = '".mysqli_real_escape_string($conn,$email)."'
        ";
        $user = [];
        if($result = mysqli_query($conn,$checkemail)) {
            $user = mysqli_fetch_assoc($result);
        }
        if (empty($user)) {
            $errors['user'] = 'nqma takuv potrebitel';
        }
    }
    if (!mb_strlen($password)) {
        $errors['password'] = 'Моля въведете парола.';
    } else if (mb_strlen($password) < 8) {
        $errors['password'] = 'Паролата трябва да съдържа повече от 8 символа';
    }
    if(empty($user)) {
        $errors['user'] = 'User do not exist.';
    } 

    if (!count($errors)) {
        if (password_verify($password, $user['password'])) {
            
        $_SESSION['user'] = [
            'id' => $user['id'],
            'username' => $user['first_name'],
            'lastname' => $user['last_name']
        ];
        redirect('profile');
        } else {
            echo "parolite ne suvpadat.";
        }
    }
}


?>

<html>
<head>
    <title>login.php</title>
    <meta charset="utf-8"/>
</head>
<body>
<h1>Login</h1>
<form method = "POST" action="">
<p>Use e-mail address for login.</p>
<input type = "text" name = "email"/>
<p>Password</p>
<input type = "password" name = "password" value = ""/>
<br />
<button type = "submit" name = "Login">Login</button>
</form>
</body>
</html>