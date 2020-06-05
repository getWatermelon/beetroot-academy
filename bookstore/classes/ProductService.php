<?php

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
        $books = [];
        foreach ($result as $row) {
            $books[] = $row;
        }
        return $books;
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
            $authorId = $this->upsertAuthor($data['author']);
            $genreId = $this->getGenre($data['genre']);
            // TODO: update book
            $pdo->commit();
        }catch (\Exception $e) {
            $pdo->rollBack();
        }
    }

    private function upsertAuthor($name) : int
    {

    }

    private function getGenre($name) : int
    {

    }

}