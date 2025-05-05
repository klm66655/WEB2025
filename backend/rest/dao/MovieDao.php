<?php
require_once __DIR__ . '/BaseDaov2.php';

class MovieDao extends BaseDaov2 {
    public function __construct() {
        parent::__construct("movies"); 
    }

    
    public function genreExists($genreId) {
        $stmt = $this->connection->prepare("SELECT COUNT(*) FROM genres WHERE id = :id");
        $stmt->bindParam(':id', $genreId);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    
}
