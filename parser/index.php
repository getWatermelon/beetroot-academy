<?php

require 'functions.php';

$items = loadAll();
//$xml = loadRss('https://dumskaya.net/rssnews/');


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
        .mark {
            background: blue;
            color: orangered;
        }
    </style>
</head>
<body>
<div class="container">
    <h3 class="text-center">Новости Украины</h3>
    <form method="post">
    <div class="input-group">
        <input type="text" class="form-control" id="formGroupExampleInput" name="search" placeholder="Поиск">
        <div class="input-group-append">
            <button type="submit" class="btn btn-primary">Найти</button>
            </button>
        </div>
    </div>
    </form>
    <ul class="nav justify-content-end">
        <li class="nav-item">
            <a class="nav-link" href="?limit=5">6</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="?limit=10">10</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/">Все</a>
        </li>
    </ul>
    <ol>
    <?php foreach ($items as $article) : ?>
<!--        --><?php //if(!empty($_POST['search'])){
//            $article = searchFunction($article);
//        } ?>
        <li><a href="<?=$article->link?>" target="_blank"><?=$article->title ?></a>
        <p><?=$article->description?></p>
        </li>
    <?php endforeach; ?>
    </ol>
</div>
</body>
</html>
