
<?php
require_once __DIR__ . '/../dao/ReviewDao.php';

class ReviewService {
    private $dao;

    public function __construct($conn) {
        $this->dao = new ReviewDao($conn);
    }

    public function getAllReviews() {
        return $this->dao->getAllReviews();
    }

    public function getReviewById($id) {
        return $this->dao->getReviewById($id);
    }

    public function createReview($data) {
        
        $existingReview = $this->dao->getReviewByUserAndMovie($data['user_id'], $data['movie_id']);
    
        if ($existingReview) {
            return ['error' => 'User has already submitted a review for this movie.'];
        }
    
        
        if ($data['rating'] < 1 || $data['rating'] > 5) {
            return ['error' => 'Rating must be between 1 and 5.'];
        }
    
        
        return $this->dao->createReview($data);
    }
    
    

    public function updateReview($id, $data) {
        return $this->dao->updateReview($id, $data);
    }

    public function deleteReview($id) {
        return $this->dao->deleteReview($id);
    }
}