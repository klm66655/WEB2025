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
        return $this->dao->createReview($data);
    }

    public function updateReview($id, $data) {
        return $this->dao->updateReview($id, $data);
    }

    public function deleteReview($id) {
        return $this->dao->deleteReview($id);
    }
}
