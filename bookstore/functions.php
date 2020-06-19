<?php
require 'vendor/autoload.php';

define('ITEMS_PER_PAGE', 8);
define('PUB_KEY', 'sandbox_i93994735163');
define('PRIVATE_KEY', 'sandbox_4NGoJapkzYG3akmvwD7yKVgEFvovYsnLKDWWQuwM');

function getPDO()
{
    $pdo = new PDO("mysql:dbname=bookstore;host=127.0.0.1;charset=utf8mb4", 'root', '', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
    return $pdo;
}

function getBooks(array $ids = []): array
{
    require_once "classes/ProductService.php";
    $class = new ProductService();
    return $class->getProductsList($ids);
}

/**
 * @param $bookId
 * @return mixed
 */
function getBookById($bookId) : array
{
    if ($bookId < 1) {
        $bookId = 1;
    }
    if ($bookId > 99) {
        $bookId = 99;
    }
    require "classes/ProductService.php";
    $class = new ProductService();
    return $class->getBookById($bookId);
}

function getGenres()
{
    $query = 'SELECT id, name FROM genre';
    $pdo = getPDO();
    $result = $pdo->query($query);
    return $result->fetchAll(PDO::FETCH_ASSOC);
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
        setcookie('cart', '', time() - 1);
    }
}


/**
 * get total cost of order
 *
 * @return float|int
 */
function getOrderTotal()
{
    $cost = 0.0;
    if (!empty($_COOKIE['cart'])) {
        $books = getCartItems();
        foreach ($books as $book) {
            $cost += $book['cost'] * $book['count'];
        }
    }
    return $cost;
}

/**
 * crete order with books
 *
 * @return int
 */
function createOrder() : int
{
    $items = getCartItems();
    $sql = "INSERT INTO `order` VALUES()";
    $pdo = getPDO();
    $pdo->query($sql);
    $orderId = $pdo->lastInsertId();

    $sql = 'INSERT INTO order_book (order_id, book_id, count) VALUES(?, ?, ?)';
    $stmt = $pdo->prepare($sql);
    foreach ($items as $item) {
        $stmt->execute([
            $orderId,
            $item['book_id'],
            $item['count']
        ]);
    }
    return $orderId;
}

function getData($orderId)
{
    $json_string = sprintf(
        '{"result_url":"http://localhost:8080/callback.php",
                "public_key":"%s",
                "version":"3",
                "action":"pay",
                "amount":"%s",
                "currency":"UAH",
                "description":"Ваша покупка",
                "order_id":"%s"}',
                PUB_KEY,
                getOrderTotal(),
                $orderId
        );
    return base64_encode($json_string);
}

function getSignature($orderId)
{
    return base64_encode(sha1( PRIVATE_KEY . getData($orderId) . PRIVATE_KEY, true));
}

function updateOrder(string $data)
{
    $paymentData = json_decode(base64_decode($data), true);
    $orderId = $paymentData['order_id'];
    $amount = $paymentData['amount'];
    $status = $paymentData['status'];
    if ($status == 'failure' || $status == 'try_again') {
        $status = 'failed';
    }
    $sql = "UPDATE `order` SET `status` = :status, amount = :amount WHERE order_id = :order_id";
    $pdo = getPDO();
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'status' => $status,
        'order_id' => $orderId,
        'amount' => $amount
    ]);
    $mailer = new Mailer();
    $mailer->notifyOrder();
    return [$orderId, $status];
}

function getPaymentStatusMessage()
{
    if (!empty($_SESSION['order_id'])) {
        $sql = 'SELECT * FROM `order` WHERE order_id = ?';
        $pdo = getPDO();
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$_SESSION['order_id']]);
        $order = $stmt->fetch(PDO::FETCH_ASSOC);
        if($order['status'] == 'failed') {
            $message = sprintf("При заказе произошла ошибка. Заказ на сумму %s не оплачен", $order['amount']);
        }
        if($order['status'] == 'success') {
            $message = sprintf("Заказ успешно прошел. Заказ на сумму %s оплачен", $order['amount']);
        }
        $message .= "
        <script>
          $('#exampleModalCenter').modal('show')
        </script>
        ";
        unset($_SESSION['order_id']);
        return $message;
    }
}

function getBookUrl(array $book)
{
    if(!empty($book)) {
        return "/page/{$book['url']}.html";
    }
}

function getBookByUrl($url)
{
    $books = new ProductService();
    return $books -> getBookByUrl($url);
}



