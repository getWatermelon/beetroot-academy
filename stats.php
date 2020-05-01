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
sort($users[$merkelId]['animals']);


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
    <li><?="$oldestUsersInfo[0] $oldestUsersInfo[1]"?></li>
        <li>Общее количество пользователей: <?=count($users)?></li>
    </ul>
    <table class="table table-striped">
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Surname</th>
            <th>Age</th>
            <th>Avatar</th>
            <th>Animals</th>
        </tr>
        <tbody>
        <tr>
            <td><?=$jackId?></td>
            <td><?=$users[$jackId]['name']?></td>
            <td><?=$users[$jackId]['surname']?></td>
            <td><?=$users[$jackId]['age']?></td>
            <td><?="<img src='$jackImage' height = '100' width = '100' alt='jackImage'>"?></td>
            <td></td>
        </tr>
        <tr>
            <td><?=$randomUserId?></td>
            <td><?=$randomUser['name']?></td>
            <td><?=$randomUser['surname']?></td>
            <td><?=$randomUser['age']?></td>
            <td><?="<img src='$randomUserImage' height = '100' width = '100' alt='randomUserImage'>"?></td>
            <td></td>
        </tr>
        <tr>
            <td><?=$merkelId?></td>
            <td><?=$users[$merkelId]['name']?></td>
            <td><?=$users[$merkelId]['surname']?></td>
            <td><?=$users[$merkelId]['age']?></td>
            <td><?="<img src='$merkelImage' height = '100' width = '100' alt=''>"?></td>
            <td><?=implode(", ", $users[$merkelId]['animals'])?></td>
        </tr>
        </tbody>
    </table>
    <a href="user.php">На страницу регистрации</a>
</div>
</body>
</html>