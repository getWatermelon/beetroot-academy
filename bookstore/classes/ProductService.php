<?php
declare(strict_types = 1);

/**
 * Class ProductService
 */
class ProductService
{

    private $isPaginationEnabled;

    /**
     * ProductService constructor.
     * @param bool $isPaginationEnabled
     */
    public function __construct(bool $isPaginationEnabled = true)
    {
        $this->isPaginationEnabled = $isPaginationEnabled;
    }

    /**
     * @param array $ids
     * @return array
     */
    public function getProductsList(array $ids = [])
    {
        $page = getPageNumber();
        $offset = ($page - 1) * ITEMS_PER_PAGE;

        $query = "SELECT b.id book_id, b.title, g.`name` genre_name, a.`name`, b.cost FROM bookstore.book AS b
          left join bookstore.genre AS g ON b.genre_id  = g.id
          left join bookstore.author AS a ON b.author_id  = a.id
          %s
          ORDER BY b.id 
          ";

        if($this->isPaginationEnabled){
            $query .= "LIMIT $offset,8";
        }
        $where = '';
        if (!empty($ids)) {
            $where = sprintf('WHERE b.id IN (%s)', implode(', ', $ids));
        }
        $query = sprintf($query, $where);
        $pdo = getPDO();
        $result = $pdo->query($query);
        $result->setFetchMode(PDO::FETCH_ASSOC);
//        $books = [];
//        foreach ($result as $row) {
//            $books[] = $row;
//        }
        return $result->fetchAll();
    }

    public function getBookById($id) : array
    {
        $query = "SELECT b.id book_id, b.title, b.genre_id, g.`name` genre_name, a.`name`, b.cost FROM bookstore.book AS b
          left join bookstore.genre AS g ON b.genre_id  = g.id
          left join bookstore.author AS a ON b.author_id  = a.id
          WHERE b.id = ?
          ";
        $pdo = getPDO();
        $result = $pdo->prepare($query);
        $result->execute([$id]);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        return $result->fetch();
    }

    public function update($bookId, array $data)
    {
        try {
            $pdo = getPDO();
            $pdo->beginTransaction();
            $authorId = $this->upsertAuthor($data['name']); // name
            $genreId = $this->getGenre($data['genre_name']); // genre_name
            $sql = "UPDATE book SET author_id = :author, genre_id = :genre, cost = :cost, title = :title
                    WHERE id = :book_id
                    ";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
               'author' => $authorId,
               'genre' => $genreId,
               'cost' => $data['cost'],
               'title' => $data['title'],
               'book_id' => $bookId
            ]);
            $pdo->commit();
        }catch (Exception $e) {
            echo "<h1>{ $e ->getMessage() }</h1>";
            $pdo->rollBack();
        }
    }

    private function upsertAuthor($name) : int
    {
        $authorSql = 'SELECT id FROM author WHERE name LIKE ?';
        $pdo = getPDO();
        $stmt = $pdo->prepare($authorSql);
        $stmt->execute([$name]);
        $authorId = (int) $stmt->fetchColumn();
        if ($authorId) {
            return $authorId;
        }
        $sql = 'INSERT INTO author (name) VALUE (?)';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$name]);
        return (int) $pdo->lastInsertId();
    }

    private function getGenre($name) : int
    {
        $genre = 'SELECT id FROM genre WHERE name LIKE ?';
        $stmt = getPDO()->prepare($genre);
        $stmt->execute([$name]);
        $genreId = (int) $stmt->fetchColumn();
        if (!empty($genreId)) {
            return $genreId;
        }
        throw new Exception('Something wrong with product edit');

    }

}