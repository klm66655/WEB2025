<?php
require_once __DIR__ . '/../dao/MovieDao.php';

class MovieService {
    private $dao;

    public function __construct($conn) {
        $this->dao = new MovieDao($conn);
    }

    public function getAllMovies() {
        return $this->dao->getAllMovies();
    }

    public function getMovieById($id) {
        return $this->dao->getMovieById($id);
    }

    public function createMovie($data) {
        
        if (!$this->dao->genreExists($data['genre_id'])) {
            return ['error' => 'Genre does not exist.'];
        }
    
        return $this->dao->createMovie($data);
    }
    

    public function updateMovie($id, $data) {
        return $this->dao->updateMovie($id, $data);
    }

    public function deleteMovie($id) {
        return $this->dao->deleteMovie($id);
    }
}
