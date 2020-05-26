<?php

define('ITEMS_PER_PAGE', 8);

function getPDO()
{
    $pdo = new PDO("mysql:dbname=bookstore;host=127.0.0.1;charset=utf8mb4", 'root', '', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
    return $pdo;
}

function getBooks(array $ids = []): array
{
    $page = getPageNumber();
    $offset = ($page - 1) * ITEMS_PER_PAGE;

    $query = "SELECT b.id book_id, b.title, g.`name` genre_name, a.`name`, b.cost FROM bookstore.book AS b
          left join bookstore.genre AS g ON b.genre_id  = g.id
          left join bookstore.author AS a ON b.author_id  = a.id
          %s
          ORDER BY b.id LIMIT $offset, 8
          ";
    $where = '';
    if (!empty($ids)) {
        $where = sprintf('WHERE b.id IN (%s)', implode(', ', $ids));
    }
    $query = sprintf($query, $where);
    $pdo = getPDO();
    $result = $pdo->query($query);
    $result->setFetchMode(PDO::FETCH_ASSOC);
    $books = [];
    foreach ($result as $row) {
        $books[] = $row;
    }
    return $books;
}

function getBookById($bookId)
{

    if ($bookId < 1) {
        $bookId = 1;
    }
    if ($bookId > 99) {
        $bookId = 99;
    }

    $query = "SELECT b.id book_id, b.title, b.genre_id, g.`name` genre_name, a.`name`, b.cost FROM bookstore.book AS b
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
    $query = "SELECT message, rating, added_at FROM bookstore.comment
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

    for ($i = 0; $i < $rating; $i++) {
        $stars[$i] = '&#9733;';
    }

    return implode(" ", $stars);
}

function addComment($comment, $bookId)
{
    $sql = "INSERT INTO `comment` (message, book_id) VALUES (:comment, :book)";
    $pdo = getPDO();
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'comment' => $comment,
        'book' => $bookId
    ]);

}

function formatCommentDate(string $data): string
{
    $time = strtotime($data);
    return date('n/j/y', $time);
}

function getPageNumber(): int
{
    $page = $_GET['page'] ?? 1;
    $total = getTotal();
    if ($page < 1) {
        $page = 1;
    } elseif ($page > $total) {
        $page = $total;
    }
    return $page;
}

function paginate()
{
    $pageCount = (int)getTotal();
    $buttons = "";

    $startPos = getPageNumber();
    for ($i = 0; $i < 2; $i++) {
        if ($startPos === 1) {
            break;
        }
        $startPos--;
    }

    $endPos = getPageNumber();
    for ($i = 0; $i < 2; $i++) {
        if ($endPos === $pageCount) {
            break;
        }
        $endPos++;
    }

    for ($i = $startPos; $i <= $endPos; $i++) {
        $buttons .= "<li class=\"page-item\"><a class=\"page-link\" href=\"?page=$i\">$i</a></li>";
    }
    return <<<PAGE
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item">
                <a class="page-link" href="?page=1" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                </a>
            </li>
            $buttons
            <li class="page-item">
                <a class="page-link" href="?page=$pageCount" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Next</span>
                </a>
            </li>
        </ul>
    </nav>
PAGE;
}

function getTotal()
{
    static $count;
    if ($count === null) {
        $sql = 'SELECT COUNT(1) FROM book';
        $pdo = getPDO();
        $stmt = $pdo->query($sql);
        $total = $stmt->fetch(PDO::FETCH_COLUMN);
        $count = ceil($total / ITEMS_PER_PAGE);
        return $count;
    }
    return $count;
}

function addToCart($bookId, int $count = 1)
{
    $cart = [];
    if (isset($_COOKIE['cart'])) {
        $cart = json_decode($_COOKIE['cart'], true);
    }
    if (!isset($cart[$bookId])) {
        $cart[$bookId] = 0;
    }
    $cart[$bookId] += $count;
    setcookie('cart', json_encode($cart), time() + 60 * 60 * 24 * 365);
}

function getItemsCount()
{
    $total = 0;
    if (!empty($_COOKIE['cart'])) {
        $cart = json_decode($_COOKIE['cart'], true);
//        foreach ($cart as $count) {
//            $total += $count;
//        }
        $total = array_sum($cart);
    }
    return $total;
}

function getCartItems()
{
    $books = [];
    if (!empty($_COOKIE['cart'])) {
        $cart = json_decode($_COOKIE['cart'], true);
        $ids = array_keys($cart);
        $books = getBooks($ids);
        foreach ($books as &$book) {
            $book['count'] = $cart[$book['book_id']];
        }
    }
    return $books;
}

function deleteCartItem($deleteId)
{
    $cart = json_decode($_COOKIE['cart'], true);
    unset($cart[$deleteId]);
    if (!empty($cart)) {
        setcookie('cart', json_encode($cart));

    } else {
        setcookie('cart', '');
    }
}

function getTotalCost()
{
    $cost = 0;
    if (!empty($_COOKIE['cart'])) {
        $books = getCartItems();
        foreach ($books as $book) {
            $cost += $book['cost'] * $book['count'];
        }
    }
    return $cost;
}
