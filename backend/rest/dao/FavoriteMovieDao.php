<?php
require_once __DIR__ . '/../db.php'; 

class FavoriteMovieDao {
    private $connection;

    public function __construct($connection) {
        $this->connection = $connection;
    }

    
    public function getAllFavorites() {
        $stmt = $this->connection->prepare("SELECT * FROM favoritemovies");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    
    public function getFavoritesByUserId($userId) {
        $stmt = $this->connection->prepare("SELECT * FROM favoritemovies WHERE user_id = :user_id");
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    
    public function addFavorite($data) {
        $stmt = $this->connection->prepare(
            "INSERT INTO favoritemovies (user_id, movie_id, added_at) 
             VALUES (:user_id, :movie_id, NOW())"
        );
        $stmt->bindParam(':user_id', $data['user_id']);
        $stmt->bindParam(':movie_id', $data['movie_id']);
        return $stmt->execute();
    }

    
    public function deleteFavorite($userId, $movieId) {
        $stmt = $this->connection->prepare(
            "DELETE FROM favoritemovies WHERE user_id = :user_id AND movie_id = :movie_id"
        );
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':movie_id', $movieId);
        return $stmt->execute();
    }
}
?>
