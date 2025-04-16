<?php
require_once __DIR__ . '/../db.php'; 

class MovieDao {
    private $connection;

    public function __construct($connection) {
        $this->connection = $connection;
    }

    public function getAllMovies() {
        $stmt = $this->connection->prepare("SELECT * FROM movies");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMovieById($id) {
        $stmt = $this->connection->prepare("SELECT * FROM movies WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createMovie($data) {
        $stmt = $this->connection->prepare(
            "INSERT INTO movies (title, release_year, description, genre_id, created_at)
             VALUES (:title, :release_year, :description, :genre_id, NOW())"
        );

        $stmt->bindParam(':title', $data['title']);
        $stmt->bindParam(':release_year', $data['release_year']);
        $stmt->bindParam(':description', $data['description']);
        $stmt->bindParam(':genre_id', $data['genre_id']);

        return $stmt->execute();
    }

    public function updateMovie($id, $data) {
        $stmt = $this->connection->prepare(
            "UPDATE movies SET title = :title, release_year = :release_year, description = :description, genre_id = :genre_id
             WHERE id = :id"
        );

        $stmt->bindParam(':title', $data['title']);
        $stmt->bindParam(':release_year', $data['release_year']);
        $stmt->bindParam(':description', $data['description']);
        $stmt->bindParam(':genre_id', $data['genre_id']);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }

    public function deleteMovie($id) {
        $stmt = $this->connection->prepare("DELETE FROM movies WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }


    public function genreExists($genreId) {
        $stmt = $this->connection->prepare("SELECT COUNT(*) FROM genres WHERE id = :id");
        $stmt->bindParam(':id', $genreId);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }
    
}
?>
