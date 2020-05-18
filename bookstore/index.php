<?php
$pdo = new PDO("mysql:dbname=bookstore;host=127.0.0.1;charset=utf8mb4", 'root', '', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);

$query = 'SELECT b.id, b.title, g.`name`, a.`name` FROM bookstore.book AS b
          left join bookstore.genre AS g ON b.genre_id  = g.id
          left join bookstore.author AS a ON b.author_id  = a.id
          ORDER BY b.id';

$result = $pdo->query($query);
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
        <?php foreach ($result as $key => $row) : ?>
            <tr style="background-color: <?= ($key % 2 === 0) ? '#aaa' : '#fff' ?>">
                <td><?= $row[0] ?></td>
                <td><?= $row[1] ?></td>
                <td><?= $row[2] ?></td>
                <td><?= $row[3] ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>