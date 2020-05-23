<?php

require 'functions.php';
$books = getBooks();

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Heroic Features - Start Bootstrap Template</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/heroic-features.css" rel="stylesheet">

</head>

<body>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#">Start Bootstrap</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">

    <header class="jumbotron my-4">
        <h1 class="display-3">A Warm Welcome!</h1>
        <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa, ipsam, eligendi, in quo sunt
            possimus non incidunt odit vero aliquid similique quaerat nam nobis illo aspernatur vitae fugiat numquam
            repellat.</p>
        <a href="#" class="btn btn-primary btn-lg">Call to action!</a>
    </header>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">Start Bootstrap</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                    aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <div class="row text-center">
        <?php foreach ($books as $key => $row) : ?>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card h-100">
                    <img class="card-img-top" src="http://placehold.it/500x325" alt="">
                    <div class="card-body">
                        <h4 class="card-title"><?= $row['title'] ?></h4>
                        <p class="card-text">Автор: <?= $row['name'] ?>, Жанр: <?= $row['genre_name'] ?></p>
                    </div>
                    <div class="card-footer">
                        <a href="/page.php?book_id=<?= $row['book_id'] ?>" class="btn btn-primary">Подробнее</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <!-- /.container -->

    <?= paginate() ?>

</div>

<!-- Footer -->
<footer class="py-5 bg-dark">
    <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Your Website 2019</p>
    </div>
    <!-- /.container -->
</footer>

<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>


<!--<!DOCTYPE html>-->
<!--<html lang="en">-->
<!--<head>-->
<!--    <meta charset="UTF-8">-->
<!--    <title>Title</title>-->
<!--    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"-->
<!--          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">-->
<!--</head>-->
<!--<body>-->
<!---->
<!--<div class="row text-center">-->
<!--    --><?php //foreach ($books as $key => $row) : ?>
<!--    <div class="col-lg-3 col-md-6 mb-4">-->
<!--        <div class="card h-100">-->
<!--            <img class="card-img-top" src="http://placehold.it/500x325" alt="">-->
<!--            <div class="card-body">-->
<!--                <h4 class="card-title">--><? //=$row['title'] ?><!--</h4>-->
<!--                <p class="card-text">Автор: --><? //= $row['name'] ?><!--, Жанр: --><? //= $row['genre_name'] ?><!--</p>-->
<!--            </div>-->
<!--            <div class="card-footer">-->
<!--                <a href="href="/page.php?book_id=--><? //=$row['book_id']?><!--" class="btn btn-primary">Подробнее</a>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--    --><?php //endforeach; ?>

<!--<div class="container">-->
<!--    <h2>BookStore</h2>-->
<!--    <table class="table">-->
<!--        <tr>-->
<!--            <th>#</th>-->
<!--            <th>Title</th>-->
<!--            <th>Genre</th>-->
<!--            <th>Author</th>-->
<!--        </tr>-->
<!--        <tbody>-->
<!--        --><?php //foreach ($books as $key => $row) : ?>
<!--            <tr style="background-color: --><? //= ($key % 2 === 0) ? '#aaa' : '#fff' ?><!--">-->
<!--                <td>--><? //= $row['book_id'] ?><!--</td>-->
<!--                <td><a href="/page.php?book_id=--><? //=$row['book_id']?><!--">--><? //= htmlspecialchars($row['title'] )?><!--</td>-->
<!--                <td>--><? //= $row['name'] ?><!--</td>-->
<!--                <td>--><? //= $row['genre_name'] ?><!--</td>-->
<!--            </tr>-->
<!--        --><?php //endforeach; ?>
<!--        </tbody>-->
<!--    </table>-->
<!--</div>-->
<!--</div>-->
<!--</body>-->
<!--</html>-->