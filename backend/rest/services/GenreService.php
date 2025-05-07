<?php
require_once __DIR__ . '/../dao/GenreDao.php';

class GenreService {
    private $dao;

    public function __construct($conn) {
        $this->dao = new GenreDao($conn);
    }

    public function getAllGenres() {
        return $this->dao->getAllGenres();
    }

    public function getGenreById($id) {
        return $this->dao->getGenreById($id);
    }

    public function createGenre($data) {
        if ($this->dao->genreExistsByName($data['name'])) {
            return ['error' => 'Genre already exists.'];
        }
    
        return $this->dao->createGenre($data);
    }
    

    public function updateGenre($id, $data) {
        return $this->dao->updateGenre($id, $data);
    }

    public function deleteGenre($id) {
        return $this->dao->deleteGenre($id);
    }
}
