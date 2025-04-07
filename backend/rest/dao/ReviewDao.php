<?php
require_once __DIR__ . '/../db.php'; 

class ReviewDao {
    private $connection;

    public function __construct($connection) {
        $this->connection = $connection;
    }

    
    public function getAllReviews() {
        $stmt = $this->connection->prepare("SELECT * FROM reviews");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    
    public function getReviewById($id) {
        $stmt = $this->connection->prepare("SELECT * FROM reviews WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    
    public function createReview($data) {
        $stmt = $this->connection->prepare(
            "INSERT INTO reviews (user_id, movie_id, rating, comment, created_at)
             VALUES (:user_id, :movie_id, :rating, :comment, NOW())"
        );

        $stmt->bindParam(':user_id', $data['user_id']);
        $stmt->bindParam(':movie_id', $data['movie_id']);
        $stmt->bindParam(':rating', $data['rating']);
        $stmt->bindParam(':comment', $data['comment']);

        return $stmt->execute();
    }

    
    public function deleteReview($id) {
        $stmt = $this->connection->prepare("DELETE FROM reviews WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    
    public function updateReview($id, $data) {
        $stmt = $this->connection->prepare(
            "UPDATE reviews SET user_id = :user_id, movie_id = :movie_id, rating = :rating, comment = :comment
             WHERE id = :id"
        );

        $stmt->bindParam(':user_id', $data['user_id']);
        $stmt->bindParam(':movie_id', $data['movie_id']);
        $stmt->bindParam(':rating', $data['rating']);
        $stmt->bindParam(':comment', $data['comment']);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }
}
?>
