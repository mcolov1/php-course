<?php 
require_once "functions.php";

if (isset($_POST['submit'])){
    showArray($_FILES);
    $errors = [];
    $count = [];
    $count = count($_FILES['image']['name']);
    $files = [];
    for ($i = 0; $i < $count; $i++) {
            if(!isset($_FILES['image']['name'][$i])
            || !isset($_FILES['image']['type'][$i])
            || !isset($_FILES['image']['tmp_name'][$i])
            || !isset($_FILES['image']['error'][$i])
            || !isset($_FILES['image']['size'][$i])
        ) {
            continue;
        }
        $files[$i] = [
            'name' => $_FILES['image']['name'][$i],
            'type' => $_FILES['image']['type'][$i],
            'tmp_name' => $_FILES['image']['tmp_name'][$i],
            'error' => $_FILES['image']['error'][$i],
            'size' => $_FILES['image']['size'][$i],
        ];
    }
    showArray($files);
    $count = count($files);
    for ($i = 0; $i < $count; $i++ ) {
    $dir = 'upload/profile/';
    $fileName = basename($files[$i]['name']);
    $size = getimagesize($files[$i]['tmp_name']);
        
    

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

    if (!count($errors)) {
        if (move_uploaded_file($files[$i]['tmp_name'], $dir . $fileName)) {
            echo "успешно качено изображение";
            echo "<br />";
        } else {
            echo "няма да стяне";
            }
        }
    }
}
?>









<html>
    <head>
        <title>Upload File</title>
    </head>
    <body>
        <form action="" method="POST" enctype="multipart/form-data">
        <p>Upload Image</p>
        <input type="file" name="image[]" multiple="multiple"/>
        <br/>
        <input type="submit" name="submit" value="submit">
        </form>
    </body>
</html>