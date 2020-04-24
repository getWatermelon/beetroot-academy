<?php
//echo "Hello world form PHP!";
//phpinfo();

define('YEAR', 2020);

define('USD_COURSE', 27.397);

$usdInUah = round(100 / USD_COURSE, 2);
$uahInUsd = round(100 * USD_COURSE,2);

$name = 'Ivan';
$surname = 'Petrov';
$age = '28';
$year = '2020';
$born =  $year - $age;
$century =  ceil($year / 1000);

$bool = true;
$boolfalse = false;


echo "My name is " . $name . " ". $surname . " " . ($year - $age);

echo "<br />";

echo "Name: " . "" .  $name . " " ."Age: " . " " .  $age . " " . "Days: " . ($age * 365);

echo "<br />";

echo "The year is: " . ceil(YEAR / 1000);

echo "<br />";

echo "My name is $name $surname";

echo "<br />";

echo "Century: $century";

echo "<br />";

echo "100 $ сегодня стоят $usdInUah гривен";

echo "<br />";

echo "100 грн сегодня стоят $uahInUsd  долларов";

echo "<br />";

var_dump((bool)$age);

//$arr = [];
//$arr[] = $name;
//$arr = 'Kardakov';
//var_dump($arr[1]);

$assoc = [];
$assoc['name'] = $name;
$assoc['surname'] = $surname;

echo "<br />";

var_dump($assoc);

echo "<br />";

$arr = [];
$arr[] = $name;
$arr[] = $surname;
$arr[] = $age;
$arr[] = $year;
$arr[] = $century;

$arrAssoc = [
    'name' => 'Ivan',
    'surname' => 'Petrov',
    'age' => '28',
    'year' => '2020',
    'century' => '3'
];

echo "Name: $arr[0],  Surname:  $arr[1],  Age: $arr[2],  Year: $arr[3], Century: $arr[4]";

echo "<br />";

echo "Name: {$arrAssoc['name']}, Surname: {$arrAssoc['surname']}, Age: {$arrAssoc['age']}, Year: {$arrAssoc['year']}, Century: {$arrAssoc['century']}";
