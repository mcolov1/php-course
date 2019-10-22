<?php
session_start();
require_once 'config/db.php';
require_once 'config/settings.php';
require_once 'functions.php';
if(!isset($_SESSION['user'])) {
    redirect('login');
}

$sql = "SELECT
        `id`
        `country_id`,
        `first_name`,
        `last_name`,
        `email`,
        `username`,
        `age`,
        `image`
        FROM `".TABLE_USERS."`
        WHERE `id` = '".mysqli_real_escape_string($conn, $_SESSION
        ['user']['id'])."'
";

$user = [];
if ($result = mysqli_query($conn, $sql)) {
    $user = mysqli_fetch_assoc($result);
}

$sql = "SELECT
        `id`,
        `name`
        FROM `".TABLE_COUNTRIES."`
        ";

$countries = [];
if ($result = mysqli_query($conn, $sql)) {
    while ($row = mysqli_fetch_assoc($result)) {
        $countries[] = $row;
    }
}

if(isset($_POST['submit'])) {
    $errors = [];
    $image = isset($user['image']) ? $user['image'] : '';

    $firstName = '';
    if(isset($_POST['first_name'])) {
        $firstName = trim($_POST['first_name']);
    }
    $lastName = '';
    if(isset($_POST['last_name'])) {
        $lastName = trim($_POST['last_name']);
    }
    $email = '';
    if(isset($_POST['email'])) {
        $email = trim($_POST['email']);
    }
    $username = '';
    if(isset($_POST['username'])) {
        $username = trim($_POST['username']);
    }
    $age = 0;
    if(isset($_POST['age'])) {
        $age = trim($_POST['age']);
    }
    $country = '';
    if(isset($_POST['country'])) {
        $country = trim($_POST['country']);
    }

    if (!mb_strlen($firstName)) {
        $errors[] = 'Моля въведете име';
    } else if (mb_strlen($firstName) > 32) {
        $errors[] = 'Твърде дълго име';
    }
    if (!mb_strlen($lastName)) {
        $errors[] = 'Моля въведете фамилия';
    } else if (mb_strlen($lastName) > 32) {
        $errors[] = 'Твърде дълга фамилия';
    }

    if ($email !== $user['email']) {
        if (!mb_strlen($email)) {
            $errors = 'Моля въведете имейл';
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Грешен имейл';
        } else {
            $sql = "SELECT `id`
            FROM `".TABLE_USERS."`
            WHERE `email` = '".mysqli_real_escape_string($conn, $email)."'
            ";
            
            if($result = mysqli_query($conn, $sql)) {
                if (mysqli_num_rows($result)) {
                    $errors[] = 'Имейл адресът съществува';
                }
            }
        }
    }

    if ($username !== $user['username']) {
        if (!mb_strlen($username)) {
            $errors = 'Моля въведете имейл';
        } else if (!filter_var($username, FILTER_VALIDATE_userName)) {
            $errors[] = 'Грешен имейл';
        } else {
            $sql = "SELECT `id`
            FROM `".TABLE_USERS."`
            WHERE `username` = '".mysqli_real_escape_string($conn, $username)."'
            ";
            
            if($result = mysqli_query($conn, $sql)) {
                if (mysqli_num_rows($result)) {
                    $errors[] = 'Потребителското име вече съществува';
                }
            }
        }
    }

    if ($age < 1) {
        $errors[] = 'Моля, въведете години';
    }

    if ($country < 1) {
        $errors[] = 'Моля, изберете държава';
    }




    if (mb_strlen($_FILES['image']['name'])) {
        $dir = 'upload/profile/';
        $fileName = basename($_FILES['image']['name']);
        $size = getimagesize($_FILES['image']['tmp_name']);
        $errorsImage=[];
        if(!$size) {
            $errors[]= 'Моля изберете снимка';
        }
        for(;;) {
            if (!file_exists($dir . $fileName)) {
                break;
            }
            $fileName = mt_rand() . $fileName;
        }
        $type = strtolower(pathinfo($dir . $fileName, PATHINFO_EXTENSION));
    if ($type !== 'jpg' && $type !== 'png' && $type !== 'jpeg') {
        $errors[] = 'Моля, качете изображение';
    }
    if (!count($errorsImage)) {
        if (move_uploaded_file($_FILES['image']['tmp_name'], $dir . $fileName)) {
            $image = $dir . $fileName;
            }
        }
    $errors = array_merge($errors, $errorsImage);
    }
    showArray($errors);
    if (!count($errors)) {
        $sql = "UPDATE `".TABLE_USERS."`
                SET 
                    `country_id` = '".mysqli_real_escape_string($conn, $country)."',
                    `first_name` = '".mysqli_real_escape_string($conn, $firstName)."',
                    `last_name` = '".mysqli_real_escape_string($conn, $lastName)."',
                    `email` = '".mysqli_real_escape_string($conn, $email)."',
                    `username` = '".mysqli_real_escape_string($conn, $username)."',
                    `age` = '".mysqli_real_escape_string($conn, $age)."',
                    `image` = '".mysqli_real_escape_string($conn, $image)."',
                    `updated_at` = NOW()
                WHERE `id` = '".mysqli_real_escape_string($conn, $_SESSION['user']['id'])."'
                ";

                if (mysqli_query($conn, $sql)) {
                    $success = 'Успешно променена информация';
                    $_SESSION['user']['first_name'] = $firstName;
                    $_SESSION['user']['last_name'] = $lastName;
                    $_SESSION['user']['image'] = $image;
                    $_SESSION['user']['email'] = $email;
                    $_SESSION['user']['username'] = $username;
                }
            }
    }








?>

<html>
<head>
    <title>Profile</title>
    <style>
    .alert {
        background : green;
        height : 200px;
        width : 200px;
        
    }
    .alert p {
        
    }
    </style>
</head>
<body>
    <h1>Welcome <?=$_SESSION['user']['username']?> <?=$_SESSION['user']['lastname']?></h1>
    <a href="logout.php">Logout</a>

    <form method="POST" action="" enctype="multipart/form-data">
    <br />
    <p>First Name</p>
    <input type="text" name="first_name" value="<?=$user['first_name']?>" />
    <p>Last_name</p>
    <input type="text" name="last_name" value="<?=$user['last_name']?>" />
    <p>email</p>
    <input type="text" name="email" value="<?=$user['email']?>" />
    <p>username</p>
    <input type="text" name="username" value="<?=$user['username']?>" />
    <p>age</p>
    <input type="text" name="age" value="<?=$user['age']?>" />
    <p>Country</p>
    <select name="country">
        <?php for($i = 0; $i < count($countries); $i++) : ?>
            <option
                <?php if ($countries[$i]['id'] === $user
                ['country_id']) : ?>
                selected="selected"
                <?php endif ?>
                value="<?=$countries[$i]['id']?>">
                <?=$countries[$i]['name']?>
            </option>
        <?php endfor ?>
    </select>
    <p>Profie Image</p>
    <input type="file" name="image" />
    <?php if ($user['image']) : ?>
        <img src="<?=$user['image'] ?>"/>
    <?php endif ?>
    
    <br />
    <input type="submit" name="submit" value="submit" />
    <br /><br /><br /><br /><br /><br /><br />
    </form>
    <?php if (isset($success)) : ?>
        <div class='alert'>
            <p><?=$success?></p>
        <div>
    <?php endif ?>
</body>












</html>