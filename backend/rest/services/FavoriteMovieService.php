<?php
require_once __DIR__ . '/../dao/FavoriteMovieDao.php';

class FavoriteMovieService {
    private $dao;

    public function __construct($conn) {
        $this->dao = new FavoriteMovieDao($conn);
    }

    public function getAllFavorites() {
        return $this->dao->getAllFavorites();
    }

    public function getFavoritesByUserId($userId) {
        return $this->dao->getFavoritesByUserId($userId);
    }

    public function addFavorite($data) {
        try {
            return $this->dao->addFavorite($data);
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                
                Flight::halt(400, json_encode(["error" => "This movie is already in user's favorites."]));
            } else {
                
                throw $e;
            }
        }
    }
    

    public function deleteFavorite($userId, $movieId) {
        return $this->dao->deleteFavorite($userId, $movieId);
    }
}
