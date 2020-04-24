<?php

//error_reporting(E_ALL);
//ini_set('display_errors', true);

$lang = (!empty($_GET['lang'])) ? $_GET['lang'] : 'ru';

$labels = [
    'ru' => ['name'=> 'Имя', 'surname' => 'Фамилия', 'email' => 'Почта', 'age' => 'Возраст', 'password' => 'Пароль', 'gender' => 'Пол', 'title' => 'Регистрация', 'button' => 'Зарегистрироваться'],
    'ua' => ['name'=> "Им'я", 'surname' => 'Прізвище', 'email' => 'Пошта', 'age' => 'Вік', 'password' => 'Пароль', 'gender' => 'Стать', 'title' => 'Реєстрація', 'button' => 'Зареєструватися'],
    'en' => ['name'=> 'Name', 'surname' => 'Surname', 'email' => 'Email', 'age' => 'Age', 'password' => 'Password', 'gender' => 'Gender', 'title' => 'Registration', 'button' => 'Register']
];

switch($lang) {
    case 'ru':
        $translation = $labels['ru'];
        break;
    case 'ua':
        $translation = $labels['ua'];
        break;
    case 'en':
        $translation = $labels['en'];
        break;
}


if (!empty($_POST)) {

    $error = [];

    if (empty($_POST['name'])) {
        $error['name'] = 'Поле имя не может быть пустым';
    }
    if (empty($_POST['surname'])) {
        $error['surname'] = 'Поле фамииля не может быть пустой';
    }
    if (empty($_POST['age']) || $_POST['age'] < 1) {
        $error['age'] = 'Возраст задан некорректно';
    }
    if (empty($_POST['age'])) {
        $error['email'] = 'Почта задана некорректно';
    }
    if (empty($_POST['password'])) {
        $error['password'] = 'Поле пароль не может быть пустым';
    }
    if (empty($_POST['gender'])) {
        $error['gender'] = 'Поле пол не может быть пустым';
    }

}


var_dump(empty(array()));



//$users = [
//    [
//        'name' => 'Bob',
//        'surname' => 'Martin',
//        'age' => 75,
//        'gender' => 'man',
//        'avatar' => 'https://i.ytimg.com/vi/sDnPs_V8M-c/hqdefault.jpg',
//        'animals' => ['dog']
//    ],
//    [
//        'name' => 'Alice',
//        'surname' => 'Merton',
//        'age' => 25,
//        'gender' => 'woman',
//        'avatar' => 'https://i.scdn.co/image/d44a5d71596b03b5dc6f5bbcc789458700038951',
//        'animals' => ['dog', 'cat']
//    ],
//    [
//        'name' => 'Jack',
//        'surname' => 'Sparrow',
//        'age' => 45,
//        'gender' => 'man',
//        'avatar' => 'https://pbs.twimg.com/profile_images/427547618600710144/wCeLVpBa_400x400.jpeg',
//        'animals' => []
//    ],
//    [
//        'name' => 'Angela',
//        'surname' => 'Merkel',
//        'age' => 65,
//        'gender' => 'woman',
//        'avatar' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/b/b6/Besuch_Bundeskanzlerin_Angela_Merkel_im_Rathaus_K%C3%B6ln-09916.jpg/330px-Besuch_Bundeskanzlerin_Angela_Merkel_im_Rathaus_K%C3%B6ln-09916.jpg',
//        'animals' => ['dog', 'parrot', 'horse']
//    ]
//];


$names = array_column($users, 'name');
$age = array_column($users, 'age');

var_dump($names);

echo "<br />";

echo "!!!!!!!";

echo "<br />";

$key = array_search(25, $age);

echo "var_dump(key) :  ";

var_dump($key);

echo "<br />";


echo "key :  ";

echo $key;

echo "<br />";

if($key !== false){
    echo "The age found!";
}
else{
    echo "NOT FOUND";
}

echo "<br />";

var_dump($age);

rsort($age);

var_dump($age);

var_dump(max($age));




//exit();



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
<br />
<div class="container">
    <h1><?=$translation['title']?></h1>
    <div class="float-right">
        <a href="?lang=ru" class="badge badge-primary">Русский</a>
        <a href="?lang=ua" class="badge badge-secondary">Украинский</a>
        <a href="?lang=en" class="badge badge-success">English</a>
    </div>
    <form method="post" action="stats.php">
        <div class="form-group">
            <label for="formGroupExampleInput"><?=$translation['name']?></label>
            <input type="text" class="form-control" id="formGroupExampleInput" name="name"  placeholder="Example input" value="<?=$_POST['name']?>">
            <?php if(!empty($error['name'])) : ?>
                <small style="color:red" id="passwordHelpBlock" class="from-text">
                    <?= $error['name'] ?>
                </small>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput"><?=$translation['surname']?></label>
            <input type="text" class="form-control" id="formGroupExampleInput" name="surname" placeholder="Example input" value="<?=$_POST['surname']?>">
        <?php if(!empty($error['surname'])) : ?>
            <small style="color:red" id="passwordHelpBlock" class="from-text">
                <?= $error['surname'] ?>
            </small>
        <?php endif; ?>
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput"><?=$translation['email']?></label>
            <input type="email" class="form-control" id="formGroupExampleInput" name="email" placeholder="Example input" value="<?=$_POST['email']?>">
            <?php if(!empty($error['email'])) : ?>
                <small style="color:red" id="passwordHelpBlock" class="from-text">
                    <?= $error['email'] ?>
                </small>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput"><?=$translation['age']?></label>
            <input type="number" class="form-control" id="formGroupExampleInput" name="age" placeholder="Example input" value="<?=$_POST['age']?>">
            <?php if(!empty($error['age'])) : ?>
                <small style="color:red" id="passwordHelpBlock" class="from-text">
                    <?= $error['age'] ?>
                </small>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput"><?=$translation['password']?></label>
            <input type="password" class="form-control" id="formGroupExampleInput" name="password" placeholder="Example input" value="<?=$_POST['password']?>">
            <?php if(!empty($error['password'])) : ?>
                <small style="color:red" id="passwordHelpBlock" class="from-text">
                    <?= $error['password'] ?>
                </small>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <? $gender = empty($_POST['gender'])?>
            <label for="exampleFormControlSelect1"><?=$translation['gender']?></label>
            <select multiple class="form-control" id="exampleFormControlSelect1" name="gender[]">
                <option></option>
                <option <?=$_POST['gender'] == 'Man' ? 'selected': ''?>>Man</option>
                <option <?=$_POST['gender'] == 'Woman' ? 'selected': ''?>>Woman</option>
                <option <?=$_POST['gender'] == 'Other' ? 'selected': ''?>>Others</option>
            </select>
            <?php if(!empty($error['gender'])) : ?>
                <small style="color:red" id="passwordHelpBlock" class="from-text">
                    <?= $error['gender'] ?>
                </small>
            <?php endif; ?>
        </div>
        <button type="submit" class="btn btn-primary"><?=$translation['button']?></button>
    </form>
</div>
</body>
</html>
