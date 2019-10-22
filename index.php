<?php
//     $number = 5;
//     echo $number;
//     $number = 6;
//     echo "<br />";
//     echo $number;
//     $number = 10;
//     $_number = 10;
//     $n2131 = 10;
//     $age = 22;

//     // int
//     $number = 25;
//     // double/ float
//     $double = 25.5;
//     // string
//     $name = "Miroslav" . ' ' . $number;
//     $nameSecond = "Miroslav $number";
//     $name1 = 'Miroslav $number';
//     echo '<br />';
//     echo $name .' ' . $name1;
//     echo '<br />';
//     echo $name1;
//     // boolean
//     $true = true;
//     $false = false;
//     echo '<br />';
//     echo $true;
//     echo '<br />';
//     echo $false;
    
//     echo "<br />";
//     echo "<br />";
//     echo "<br />";
//     echo "<br />";
//     echo "<br />";



//     $number1 = 10;
//     $number2 = 7;
//     echo $number1;
//     // $number1++l;
//     // $number1 = $number1 + 1;
//     echo $number1 += 1;
//     echo "<br />";
//     echo $number1;
//     echo "<br />";
//     echo '----------------';
//     echo "<br />";
//     echo $number2;
//     $number2--;
//     $number2 = $number2 - 1;
//     $number2 -= 1;
//     echo "<br />";
//     echo $number2;
//     echo "<br />";
//     $number3 = '';
//     $number4 = '20';
//     $number5 = 21;
//     // boolean
//     $true = true;
//     $false = false;
//     if (!$number3) {
//         echo "$number3";
//     } else if ($number3 > 20) {
//         echo "true";
//     } else {
//         echo "false";
//     }
    

//     echo "<br />";  
//     echo gettype($true);
//     echo "<br />";
//     echo gettype($false);

// echo "<br />";




// $age = 20;
// if ($age < 14){
// echo 'maloleten';
// }  else if($age < 18){
//     echo 'nepulnoleten';
// } else if($age > 18){
//     echo 'pulnoleten';
// }

// echo "<br />";

// $country = 'Bulgaria';
// switch ($country) {
//     case 'USA' : {
//         echo "your country is USA";
//         break;
//     }
//     case 'India' : {
//         echo "your country is India";
//         break;
//     }
//     case 'Bulgaria' : {
//         echo "your country is Bulgaria";
//         break;
//     }
//     default : {
//         echo "Country N/A";
//         break;
//     }
// }

// echo "<br />";
// if ($country === 'USA') {
//     echo "USA";
// } else if ($country === 'India'){
//     echo 'India';
// } else if ($country === 'Bulgaria'){
//     echo 'Bulgaria';
// } else if ($country === 'Country N/A'){
//     echo 'Country N/A';
// }

?>

 <!-- 

//     /* echo $number1 + $number2;
//     echo "<br />";
//     echo $number1 - $number2;
//     echo "<br />";
//     echo $number1 * $number2;
//     echo "<br />";
//     echo $number1 / $number2;
//     echo "<br />";
//     echo $number1 % $number2;
//     echo "<br />";
//     echo ($number1 + $number2) / $number1 + $number2; */ -->

<?php
//     $name = 'Miroslav';
//     $city = 'Varna';
//     $address = 'Al.Dqkovich N:14';
//     $age = '20';


//     echo checkAge($age,$name);
//     $user = checkAge($age, $name);
//     function checkAge($age,$name = '') {
//         $result = '';
//         if ($age < 14 ) {
//             return "$name e maloleten";
//         } elseif ($age < 18) {
//             return "$name e nepulnoleten";
//         } else {
//             return "$name e pulnoleten";
//         }
        
//         return $result;
//     } 








// echo "<br />";
// echo "<br />";
// echo "<br />";

//     $number1 = 1;
//     $number2 = 2;
    
//     add($number1,$number2);
//     function add($number1, $number2) {
//     echo $number1 + $number2;
//     }

//     delenie($number1,$number2);
// function delenie($number1,$number2) {
//     echo $number1 / $number2;
// }


// echo "<br />";
// echo "<br />";
// echo "<br />";


//     multiply($number1,$number2);
// function multiply($number1,$number2) {
//     echo $number1 * $number2;
// }

// echo "<br />";
// echo "<br />";
// echo "<br />";

// deduct($number1,$number2);
// function deduct($number1,$number2) {
//     echo $number1 - $number2;
// }

// echo "<br />";
// echo "<br />";
// echo "<br />";

// surplus($number1,$number2);
// function surplus($number1,$number2) {
//     echo $number1 % $number2;
// }


// echo "<br />";
// echo "<br />";
// echo "<br />";

// $a = 22;
// $b = 10;
// calc ($a,$b,"+");
// function calc($a,$b,$c) {
//     if ($c === "+") {
//     echo $a+$b;
//     } else if ($c === "-") {
//     echo $a-$b;
//     } else if ($c === "/") {
//     echo $a/$b;
//     } else if ($c === "*") {
//     echo $a*$b;
//     } else if ($c === "%") {
//     echo $a%$b;
//     } else {
//     echo "something wrong";
//  }
// }   



// $a = 22;
// $b = 10;
// echo calc ($a,$b,"+");
// function calc( int $a, int $b,str $c) {
//     if ( $a <= 0 || $b <= 0) {
//         return "invalid numbers";
//     }
//     if ( !is_int($a) && $b !is_int($b) ) {
//         return "invalid numbers";
//     }
//     if ($c === "+") {
//     return $a+$b;
//     } else if ($c === "-") {
//     return $a-$b;
//     } else if ($c === "/") {
//     return $a/$b;
//     } else if ($c === "*") {
//     return $a*$b;   
//     } else if ($c === "%") {
//     return $a%$b;
//     } else {
//     return "something wrong";
//  }
// }



// var_dump($array);
// print_r($array);






// showArray($array);
// $array[] = 10;
// $array[9999] = 11;
// $array[] = 20;
// $array[0] = 'Name';
// $user = [];
// $user['name'] = "Advance Academy";
// echo $array[0];
// echo $user['name'];
// showArray($user);
// showArray($array);


$user['name'] = "Miroslav";
$user['last'] = "Tsolov";
$user['age'] = "22";
$user['city'] = "Varna";
$user['Country'] = "Bulgaria";
echo $user['name'];
echo $user['last'];
echo $user['age'];
echo $user['city'];
echo $user['Country'];
function showuser($user) {
    echo "<pre>";
    print_r($user);
    echo "</pre>";
}
showuser($user);

$user = [
    'name' => 'Miroslav',
    'lastname' => 'Tsolov',
    'City' => 'Varna'

];
showuser($user);
















?>


<!-- <html>
<head>
<title>Php application</title>
</head>
<body>
    <p>My name is: <?php echo $name; ?></p>
    <p>City: <?=$city;?></p>
    <p>Adress:<?=$address?></p> 
    <?php if ($age < 14) : ?>
        <p>maloleten</p>
    <?php elseif ($age < 18) : ?>
        <p>nepulnoleten</p>
    <?php else : ?>
        <p>pulnoleten</p>
    <?php endif?>

</body>
</html> -->









