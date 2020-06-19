<?php
// 1. получить все книги
// 2. транслитерировать название книг
// 3. апдейт в базе
require '../functions.php';

//echo transliterator_transliterate('Russian-Latin/BGN', 'Привет медвед') . PHP_EOL;
//$str = preg_replace('/\w/', '-', 'Привет медвед');
//echo $str;
//exit;
$pdo = getPDO();
$sql = 'SELECT * FROM book';
$stmt = $pdo->query($sql);
$books = $stmt->fetchAll(PDO::FETCH_ASSOC);

$sql = 'UPDATE book set url = ? WHERE id = ?';
$stmt = $pdo->prepare($sql);

$search = [' ', ',', '.', '"', 'ʹ', '!', '-—-'];
$replace = ['-'];

foreach ($books as $book) {
    $url =  transliterator_transliterate('Russian-Latin/BGN', $book['title']);
    $url = strtolower($url);
    $url = str_replace($search, $replace, $url);
    echo $url . PHP_EOL;
    $stmt->execute([
        $url,
        $book['id']
        ]);
}