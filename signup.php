<?php
session_start([
    'cookie_httponly' => true,
]);
    require_once 'functions.php';
    require_once 'config/db.php';
    require_once 'config/settings.php';

    if (isset($_SESSION['user'])) {
        redirect('profile');
    }

    // function showArray($data){
    //     echo "<pre>";
    //     print_r($data);
    //     echo "</pre>";
    // }

    $asYouWish = "SELECT
        id,
        name
    FROM ".TABLE_COUNTRIES."
    " ;

    $countries = [];
    if($result = mysqli_query($conn, $asYouWish)) {
        while ($row = mysqli_fetch_assoc($result)) {
            $countries[] = $row;
        }

    }




    //showArray($countries);
    
    if (isset($_POST['submit'])) {
        $errors=[];


        $name = '';
        if (isset($_POST['first_name'])) {
            $name = trim($_POST['first_name']);
        }

        $surname = '';
        if (isset($_POST['surname'])) {
            $surname = trim($_POST['surname']);
        }

        $email = '';
        if (isset($_POST['email'])) {
            $email = trim($_POST['email']);
        }

        $city = '';
        if(isset($_POST['country'])) {
            $city = trim($_POST['country']);
        }

        $age = '';
        if(isset($_POST['username'])) {
            $age = trim($_POST['username']);
        }

        $password = '';
        if(isset($_POST['password'])) {
            $password = trim($_POST['password']);
        }

        $rePassword = '';
        if(isset($_POST['re_password'])) {
            $rePassword = trim($_POST['re_password']);
        }

        if (mb_strlen($name) === 0) {
            $errors['first_name'] = "This field should be filled up";
        } elseif (mb_strlen($name) > 32) {
            $errors['first_name'] = "First name should be max 32 symbols" ;
        }


        if (mb_strlen($surname) < 1) {
            $errors['surname'] = "This field should be filled up";
        } elseif (mb_strlen($surname) > 32) {
            $errors['surname'] = "Surname is too long should be max 32 symbols";
        }


        if (!mb_strlen($email)) {    
            $errors['email'] = "Email should consist at least of one symbol";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Wrong Email Address';
        } else {
            $sql = "SELECT
                id
            FROM ".TABLE_USERS."
            WHERE email = '".$_POST['email']."'
            ";
            if($result = mysqli_query($conn,$sql)) {
                if(mysqli_num_rows($result)) {
                    $errors['email'] = 'This email already exists!';
                }
            }
        }






        if ($city == 0) {
            $errors['country'] = "Please choose a city";
        }
        if (mb_strlen($age) == 0) {
            $errors['username'] = "Please write down some value";
        } elseif (mb_strlen($age) < 0) {
            $errors['username'] = "It is not appropriate for infants";
        } elseif (mb_strlen($age) > 100) {
            $errors['username'] = "You are to old!";
        } else {
            $userCheck = "SELECT
                            id
                    FROM ".TABLE_USERS."
                    WHERE `username` = '".mysqli_real_escape_string($conn,$_POST['username'])."'           
            ";
            if($result = mysqli_query($conn,$userCheck)) {
                if(mysqli_num_rows($result)){
                    $errors['username'] = 'This username is occupied!';
                }
            }
        }


        if (!mb_strlen($password)) {
            $errors['password'] = 'Please, enter password';
        } elseif (mb_strlen($password) < 8) {
            $errors['password'] = 'Password shold be at least 8 symbols';
        } elseif ($password !== $rePassword) {
            $errors['password'] = 'Your posswords are not the same';
        }


        if(!count($errors)) {
        $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);
        $newUser = "INSERT INTO ".TABLE_USERS." (
                        country_id,
                        first_name,
                        last_name,
                        email,
                        username,
                        password,
                        created_at,
                        updated_at
                    ) VALUES (
                        '".mysqli_real_escape_string($conn,$_POST['country'])."',
                        '".mysqli_real_escape_string($conn,$_POST['first_name'])."',
                        '".mysqli_real_escape_string($conn,$_POST['surname'])."',
                        '".mysqli_real_escape_string($conn,$_POST['email'])."',
                        '".mysqli_real_escape_string($conn,$_POST['username'])."',
                        '".mysqli_real_escape_string($conn,$password)."',
                        NOW(),
                        NOW()
                    )
        ";
            if(!mysqli_query($conn, $newUser)) {
                echo "neshto se obarka ";
            } else {
                echo "bravo gospodine";
            }
        }
            
           
    }


        // showArray($errors);
        

?>

<html>
    <head>
        <title>Signup</title>
    </head>
    <body>
        <form action="" method="POST">
            <p>Name</p>
            <input type="text" name="first_name" placeholder="First_Name">
            <?php if (isset($errors['first_name'])) : ?>
                <P><?=$errors['first_name']?>
            <?php endif ?>
            <p>Surname</p>
            <input type="text" name="surname" placeholder="Surname">
            <p>E-mail</p>
            <input type="text" name="email" placeholder="email">
            <p>City</p>
            <select name="country" id="">
                <option value="0">Choose country</option>
                <?php foreach ($countries as $value) : ?>
                    <option value="<?=$value['id']?>"><?=$value['name']?></option>    
                <?php endforeach ?>
            </select>
            <p>Username</p>
            <input type="text" name="username" placeholder="username">
            <p>Gender</p>
            <input type="radio" name="gender" value="male">Male<br>
            <input type="radio" name="gender" value="female">Female<br>
            <p>Password</p>
            <input type="password" name="password" placeholder="password">
            <p>Confirm Password</p>
            <input type="password" name="re_password" placeholder="re_password">
            <br/>
            <input type="submit" name="submit" value="submit">
        </form>
    </body>
</html>