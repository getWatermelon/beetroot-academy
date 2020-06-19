<?php
require 'vendor/autoload.php';
require 'functions.php';
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
<br/>
<div class="container">
    <h1>Напишите ваш отзыв</h1>
    <div class="float-right">
        <a href="?lang=ru" class="badge badge-primary">Русский</a>
        <a href="?lang=ua" class="badge badge-secondary">Украинский</a>
        <a href="?lang=en" class="badge badge-success">English</a>
    </div>
    <form method="post" action="index.php">
        <div class="form-group">
            <label for="formGroupExampleInput"></label>
            <input type="text" class="form-control" id="formGroupExampleInput" name="feedback" placeholder="Example input"
                   value="feedback">
        </div>
        <button type="submit" class="btn btn-primary">Отправить</button>
    </form>
</div>
</body>
</html>

