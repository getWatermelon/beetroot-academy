<?php
require 'functions.php';
$books = getBooks();

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
<div class="container">
    <h2>BookStore</h2>
    <table class="table">
        <tr>
            <th>#</th>
            <th>Title</th>
            <th>Genre</th>
            <th>Author</th>
        </tr>
        <tbody>
        <?php foreach ($books as $key => $row) : ?>
            <tr style="background-color: <?= ($key % 2 === 0) ? '#aaa' : '#fff' ?>">
                <td><?= $row['book_id'] ?></td>
                <td><a href="/page.php?book_id=<?=$row['book_id']?>"><?= htmlspecialchars($row['title'] )?></td>
                <td><?= $row['name'] ?></td>
                <td><?= $row['genre_name'] ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>