<?php

/**
 * Class OrderService
 *
 */
class OrderService
{
    /**
     * @return array
     *
     */
    public function getOrders(): array
    {
        $sql = "SELECT ob.order_id, 
                    GROUP_CONCAT(
                    '<a href=\"/page.php?book_id=',  
                    b.id, 
                    '\">', 
                    b.title SEPARATOR
                    '</li><li>') books,
                    o.added_at,
                    o.`status`,
                    IFNULL(o.amount,0) amount
                FROM bookstore.order_book ob
                JOIN bookstore.`order` o ON ob.order_id = o.order_id
                JOIN bookstore.book b ON ob.book_id = b.id
                GROUP BY ob.order_id
                ORDER BY ob.order_id DESC";

        $pdo = getPDO();
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

//    /**
//     * @param $bookNames
//     * @return array
//     */

//    public function getBookIdByName($bookIds, $bookNames)
//    {
//        $bookIds = explode(',', $bookIds);
//        $bookNames = explode(',', $bookNames);
//        return array_combine($bookIds, $bookNames);
//    }

//    public function getBookIdByName($bookNames)
//    {
//        $bookNames = explode(',', $bookNames);
//        $bookNames = '"' . implode('","', $bookNames) . '"';
//        $sql = "SELECT id, title FROM bookstore.book
//                WHERE title IN (%s)";
//        $sql = sprintf($sql, $bookNames);
//        $pdo = getPDO();
//        $result = $pdo->query($sql);
//        return $result->fetchAll(PDO::FETCH_ASSOC);
//    }

}