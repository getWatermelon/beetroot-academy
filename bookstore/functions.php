<?php

function getPDO()
{
    $pdo = new PDO("mysql:dbname=bookstore;host=127.0.0.1;charset=utf8mb4", 'root', '', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
    return $pdo;
}

function getBooks() : array
{
    $query = 'SELECT b.id book_id, b.title, g.`name` genre_name, a.`name` FROM bookstore.book AS b
          left join bookstore.genre AS g ON b.genre_id  = g.id
          left join bookstore.author AS a ON b.author_id  = a.id
          ORDER BY b.id';
    $pdo = getPDO();
    $result = $pdo->query($query);
    $result->setFetchMode(PDO::FETCH_ASSOC);
    $books = [];
    foreach ($result as $row)
    {

        $books[] = $row;
    }
    return $books;
}

function getBookById($bookId)
{
    $query = "SELECT b.id book_id, b.title, b.genre_id, g.`name` genre_name, a.`name` FROM bookstore.book AS b
          left join bookstore.genre AS g ON b.genre_id  = g.id
          left join bookstore.author AS a ON b.author_id  = a.id
          WHERE b.id = ?
          ";
    $pdo = getPDO();
    $result = $pdo->prepare($query);
    $result->execute([$bookId]);
    $result->setFetchMode(PDO::FETCH_ASSOC);
    return $result->fetch();
}

function getGenres()
{
    $query = 'SELECT id, name FROM genre';
    $pdo = getPDO();
    $result = $pdo->query($query);
    return $result->fetchALL(PDO::FETCH_ASSOC);
}

function getComments($bookId)
{
    $query = "SELECT message, rating FROM bookstore.comment
              WHERE book_id = ? 
              ";
    $pdo = getPDO();
    $result = $pdo->prepare($query);
    $result->execute([$bookId]);
    $result->setFetchMode(PDO::FETCH_ASSOC);
    return $result->fetchAll();
}

function getStars($rating)
{
    $stars = ['&#9734;', '&#9734;', '&#9734;', '&#9734;', '&#9734;'];

    for($i = 0; $i < $rating; $i++){
        $stars[$i] = '&#9733;';
    }

    return implode(" ", $stars);
}

