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
        $sql = "SELECT ob.order_id, group_concat(b.title separator ',') books, o.added_at, o.`status`, IFNULL(o.amount,0) amount  FROM bookstore.order_book ob
                join bookstore.`order` as o on ob.order_id = o.order_id
                join bookstore.book as b on ob.book_id = b.id
                group by ob.order_id";
        $pdo = getPDO();
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @param $bookNames
     * @return array
     */
    public function getBookIdByName($bookNames)
    {
        $bookNames = explode(',', $bookNames);
        $bookNames = implode('","', $bookNames);
        $sql = "SELECT id, title FROM bookstore.book
                WHERE title IN (\"%s\")";
        $sql = sprintf($sql, $bookNames);
        $pdo = getPDO();
        $result = $pdo->query($sql);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

}