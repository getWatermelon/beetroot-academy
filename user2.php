<?php
//$value = 'Hello from PHP 7.2';
//$name = 'Ivan';
//$surname = 'Petrov';
//$age = '28';
//$email = 'ivan-myasoyedov@stud.onu.edu.ua';
//var_dump($_POST);
//var_dump($_GET);

//error_reporting(E_ALL);


if (!empty($_POST)) {
    $error = [];

    if (empty($_POST['name'])) {
        $error['name'] = 'Имя не может быть пустым';
    }

    if (empty($_POST['surname'])) {
        $error['surname'] = 'Фамииля не может быть пустой';
    }

    if (empty($_POST['age']) || $_POST['age'] < 1) {
        $error['age'] = 'Возраст задан некорректно';
    }

    if (empty($_POST['age']) || $_POST['email'] < 1) {
        $error['email'] = 'Почта задана некорректно';
    }

    if (empty($_POST['password']) || $_POST['email'] < 1) {
        $error['password'] = 'Пароль задан некорректно';
    }

    $lang = (!empty($_GET['lang'])) ? $_GET['lang'] : ru;

    $labels = [
            'ru' => ['name'=> 'Имя', 'surname' => 'Фамилия']
    ];

    switch($lang) {
        case 'ru':
            break;
        case 'ua':
            break;
        case 'en':
            break;

    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
<br />
<h1>Your Name <?php echo $_POST['name']?> and your gender <?php echo $_POST['gender'][0]?></h1>
<div class="container">
    <div class="float-right">
        <a href="?lang=ru" class="badge badge-primary">Русский</a>
        <a href="?lang=ua" class="badge badge-secondary">Украинский</a>
        <a href="?lang=" class="badge badge-success">Английский</a>
    </div>
    <form method="post" action="user2.php">
<!--        <h3 style="color:red">--><?//=implode("<br />", $error)?><!--</h3>-->
        <div class="form-group">
            <label for="formGroupExampleInput">Name</label>
            <input type="text" class="form-control" id="formGroupExampleInput" name="name"  placeholder="Example input" value="<?=$_POST['name']?>">
            <?php if(!empty($error['name'])) : ?>
                <small id="passwordHelpBlock" class="from-text text-muted">
                    <?= $error['name'] ?>
                </small>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput">Surname</label>
            <input type="text" class="form-control" id="formGroupExampleInput" name="surname" placeholder="Example input" value="<?=$_POST['surname']?>">
        <?php if(!empty($error['surname'])) : ?>
            <small id="passwordHelpBlock" class="from-text text-muted">
                <?= $error['surname'] ?>
            </small>
        <?php endif; ?>
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput">Email</label>
            <input type="email" class="form-control" id="formGroupExampleInput" name="email" placeholder="Example input" value="<?=$_POST['email']?>">
            <?php if(!empty($error['email'])) : ?>
                <small id="passwordHelpBlock" class="from-text text-muted">
                    <?= $error['email'] ?>
                </small>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput">Age</label>
            <input type="number" class="form-control" id="formGroupExampleInput" name="age" placeholder="Example input" value="<?=$_POST['age']?>">
            <?php if(!empty($error['age'])) : ?>
                <small id="passwordHelpBlock" class="from-text text-muted">
                    <?= $error['age'] ?>
                </small>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput">Password</label>
            <input type="password" class="form-control" id="formGroupExampleInput"name="password" placeholder="Example input" value="<?=$_POST['password']?>">
            <?php if(!empty($error['password'])) : ?>
                <small id="passwordHelpBlock" class="from-text text-muted">
                    <?= $error['password'] ?>
                </small>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect1">Example select</label>
            <select multiple class="form-control" id="exampleFormControlSelect1" name="gender[]">
                <option>Man</option>
                <option>Woman</option>
                <option>Others</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
    </form>
</div>
</body>
</html>
