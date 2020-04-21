<?php
//$value = 'Hello from PHP 7.2';
//$name = 'Ivan';
//$surname = 'Petrov';
//$age = '28';
//$email = 'ivan-myasoyedov@stud.onu.edu.ua';
//var_dump($_POST);
//var_dump($_GET);

if (!empty($_POST)) {
    $error = "";
    if (empty($_POST['name'])) {
        $error = "Имя";
    }
    if (empty($_POST['surname'])) {
        $error = "Фамииля";
    }
    if (empty($_POST['age']) || $_POST['age'] < 1) {
        $error = "Возраст";
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
<form method="post" action="user.php">
    <h3 style="color:red"><?=$error ?></h3>
    <div class="form-group">
        <label for="formGroupExampleInput">Имя</label>
        <input type="text" class="form-control" id="formGroupExampleInput" name="name"  placeholder="Example input" value="<?=$_POST['name'] ?? 'Mike'?>">
    </div>
    <div class="form-group">
        <label for="formGroupExampleInput">Фамилия</label>
        <input type="text" class="form-control" id="formGroupExampleInput" name="surname" placeholder="Example input" value="<?=$_POST['surname'] ?? 'Petrov'?>">
    </div>
    <div class="form-group">
        <label for="formGroupExampleInput">Возраст</label>
        <input type="text" class="form-control" id="formGroupExampleInput" name="age" placeholder="Example input" value="<?=$_POST['age'] ?? '20'?>">
    </div>
    <div class="form-group">
        <label for="formGroupExampleInput">Почта</label>
        <input type="text" class="form-control" id="formGroupExampleInput"name="email" placeholder="Example input" value="<?=$_POST['email'] ?? 'ivan-myasoyedov@stud.onu.edu.ua'?>">
    </div>
    <div class="form-group">
        <label for="exampleFormControlSelect1">Example select</label>
        <select multiple class="form-control" id="exampleFormControlSelect1" name="gender[]">
            <option>Man</option>
            <option>Woman</option>
            <option>Others</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Отправить</button>
</form>
</div>
</body>
</html>