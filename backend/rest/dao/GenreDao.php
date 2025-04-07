<?php
require_once __DIR__ . '/../db.php'; 

class GenreDao {
    private $connection;

    public function __construct($connection) {
        $this->connection = $connection;
    }

    public function getAllGenres() {
        $stmt = $this->connection->prepare("SELECT * FROM genres");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getGenreById($id) {
        $stmt = $this->connection->prepare("SELECT * FROM genres WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createGenre($data) {
        $stmt = $this->connection->prepare(
            "INSERT INTO genres (name) VALUES (:name)"
        );

        $stmt->bindParam(':name', $data['name']);
        return $stmt->execute();
    }

    public function updateGenre($id, $data) {
        $stmt = $this->connection->prepare(
            "UPDATE genres SET name = :name WHERE id = :id"
        );

        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function deleteGenre($id) {
        $stmt = $this->connection->prepare("DELETE FROM genres WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>
