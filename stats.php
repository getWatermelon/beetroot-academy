<?php

$users = [
    [
        'name' => 'Bob',
        'surname' => 'Martin',
        'age' => 75,
        'gender' => 'man',
        'avatar' => 'https://i.ytimg.com/vi/sDnPs_V8M-c/hqdefault.jpg',
        'animals' => ['dog']
    ],
    [
        'name' => 'Alice',
        'surname' => 'Merton',
        'age' => 25,
        'gender' => 'woman',
        'avatar' => 'https://i.scdn.co/image/d44a5d71596b03b5dc6f5bbcc789458700038951',
        'animals' => ['dog', 'cat']
    ],
    [
        'name' => 'Jack',
        'surname' => 'Sparrow',
        'age' => 45,
        'gender' => 'man',
        'avatar' => 'https://pbs.twimg.com/profile_images/427547618600710144/wCeLVpBa_400x400.jpeg',
        'animals' => []
    ],
    [
        'name' => 'Angela',
        'surname' => 'Merkel',
        'age' => 65,
        'gender' => 'woman',
        'avatar' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/b/b6/Besuch_Bundeskanzlerin_Angela_Merkel_im_Rathaus_K%C3%B6ln-09916.jpg/330px-Besuch_Bundeskanzlerin_Angela_Merkel_im_Rathaus_K%C3%B6ln-09916.jpg',
        'animals' => ['dog', 'parrot', 'horse']
    ]
];

if(!empty($_POST)) {
    $users[] = $_POST;
    $newUser = $users[count($users) - 1];
}

$names = array_column($users, 'name');
$surnames = array_column($users, 'surname');
$ages = array_column($users, 'age');

$maxAge = max($ages);
$maxAgeId = array_search($maxAge, $ages);
$oldestUser = $users[$maxAgeId];


define('JACK_NAME', 'Jack');
$jackId = array_search(JACK_NAME, $names);
$jackImage = $users[$jackId]['avatar'];

define('MERKEL_SURNAME', 'Merkel');
$merkelId = array_search(MERKEL_SURNAME, $surnames);
$merkelImage = $users[$merkelId]['avatar'];
ksort($users[$merkelId]['animals']);


$randomUserId = rand(0, count($users) - 1);
$randomUser = $users[$randomUserId];
$randomUserImage = $randomUser['avatar'];

if($oldestUser['age'] == $newUser['age'] && $maxAgeId != count($users) - 1){
    $oldestUsersInfo[0] = "Самые старые пользователи: ";
    $oldestUsersInfo[1] =  $oldestUser['name'] . " " . $oldestUser['surname'] . ":" . " " . $oldestUser['age'] .", ". $newUser['name'] . " " . $newUser['surname'] . ":" . " " . $newUser['age'];
}
else{
    $oldestUsersInfo[0] = "Самый старый пользователь: ";
    $oldestUsersInfo[1] = $oldestUser['name'] . " " . $oldestUser['surname'] . ":" . " " . $oldestUser['age'];
}



//foreach ($users as $key => &$user){
//    echo "Key is: $key" . " " . strtoupper($user['name']) . '<br />';
//    $user['name'] = strtoupper($users['name']);
//
//}


$animals = [];
foreach ($users as $user) {
    $animals = array_merge($animals, $user['animals']);
}

$animalsFilter = array_unique($animals);
//
//print_r($animalsFilter); exit;


if (!empty($_GET['sort'])){
    switch ($_GET['sort']) {
        case 'id':
            if(!empty($_GET['order']) && $_GET['order'] == 'desc') {
                krsort($users);
            }
            else {
                ksort($users);
            }
            $users = array_values($users);
            break;
    }
}

if(!empty($_GET['filter'])) {
    switch ($_GET['filter']){
        case  'man':
            foreach ($users as $key => $user) {
                if ($user['gender'] == 'man') {
                    unset($user[$key]);

                }
            }
            break;
    }
}
if(!empty($_GET['filter'])) {
    switch ($_GET['filter']){
        case  'man':
            foreach ($users as $key => $user) {
                if ($user['gender'] !== 'man') {
                    unset($users[$key]);

                }
            }
            break;
        case  'woman':
            foreach ($users as $key => $user) {
                if ($user['gender'] !== 'woman') {
                    unset($users[$key]);

                }
            }
            break;
        case  'covid':
            foreach ($users as $key => $user) {
                if ($user['age'] < 60) {
                    unset($users[$key]);
                }
            }
            break;
//        case  'dog':
//            foreach ($users as $key => $user) {
//                $index = array_search('dog', $users['animals']);
//                if (false === $index) {
//                    unset($users[$key]);
//                }
//            }
//            break;
//        case  'cat':
//            foreach ($users as $key => $user) {
//                $index = array_search('cat', $users['animals']);
//                if (false === $index) {
//                    unset($users[$key]);
//                }
//            }
//            break;
//        case  'parrot':
//            foreach ($users as $key => $user) {
//                $index = array_search('parrot', $users['animals']);
//                if (false === $index) {
//                    unset($users[$key]);
//                }
//            }
//            break;
//        case  'horse':
//            foreach ($users as $key => $user) {
//                $index = array_search('horse', $users['animals']);
//                if (false === $index) {
//                    unset($users[$key]);
//                }
//            }
//            break;
//
        case  'dog':
        case  'cat':
        case  'parrot':
        case  'horse':
        foreach ($users as $key => $user) {
            $index = array_search($_GET['filter'], $users['animals']);
            if (false === $index) {
                unset($users[$key]);
            }
        }
        break;
    }


}

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
    <h1>Статистика</h1>
    <ul>
<!--    <li>--><?//="$oldestUsersInfo[0] $oldestUsersInfo[1]"?><!--</li>-->
<!--        <li>Общее количество пользователей: --><?//=count($users)?><!--</li>-->
    </ul>
    <table class="table table-striped">
        <tr>
            <th> <a href="?sort=id&order=<?=!empty($_GET['order']) && $_GET['order'] == 'desc' ? 'asc': 'desc' ?>> # </th>
            <th> <a href="?sort=name&order=asc">Name</th>
            <th><a href="?sort=surname">Surname</th>
            <th><a href="?sort=age">Age</th>
            <th><a href="?sort=avatar">Avatar</th>
        </tr>
        <tbody>
        <?php foreach ($users as $key => $user) : ?>
        <?php $id = (!empty($_GET['sort'] && $_GET['sort'] == 'id' && $_GET['sort'] == 'desc') ? count($users) - $key: $key + 1)?>
        <tr style="background-color: <?=($key%2===0) ? '#aaa' : '#fff'?>">
            <td><?=$key + 1?></td>
            <td><?=$user['name'] ?></td>
            <td><?=$user['surname'] ?></td>
            <td><?=$user['age'] ?></td>
            <td><img src="<?=$user['avatar']?>" style="width:60px"/></td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <form method="get">
    <select name="filter">
        <option value="man">Man</option>>
        <option value="woman">Woman</option>>
        <option value="covid">Age > 60</option>>
        <?php foreach ($animalsFilter as $animal): ?>
        <option value="<?=$animal?>"><?=$animal?></option>
        <?php endforeach; ?>
    </select>
        <input type="submit">
        </form>
    <a href="user.php">На страницу регистрации</a>
</div>
</body>
</html>