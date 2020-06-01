<?php

/**
 * Class GenreService
 */
class GenreService
{
    /**
     * @return array
     */
    public function getGenresStats() : array
    {
        $sql = "SELECT g.`name`, count(1) total from book b
                join genre g ON g.id = b.genre_id
                group by g.`name`
                order by total";
        $pdo = getPDO();
        $stmt = $pdo->query($sql);
        $stats = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $totalSum = array_sum( array_column( $stats, 'total' ) );
        foreach ($stats as &$stat) {
            $stat['percent'] = round(100 * $stat['total'] / $totalSum, 1);
        }
        return $stats;
    }

    /**
     * @param $stats
     * @return array
     */
    public function showAsPercents($stats) : array
    {
        $totalSum = array_sum( array_column( $stats, 'total' ) );
        foreach ($stats as &$stat) {
            $stat['percent'] = round(100 * $stat['total'] / $totalSum, 1);
        }
        return $stats;
    }

}