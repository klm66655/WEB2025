<?php
require_once __DIR__ . '/BaseService.php';
require_once __DIR__ . '/../dao/MovieDao.php';

class MovieService extends BaseService {
    public function __construct() {
        parent::__construct(new MovieDao());
    }

    
    public function create($data) {
        if (!(new MovieDao())->genreExists($data['genre_id'])) {
            return ['error' => 'Genre does not exist'];
        }
        return parent::create($data);
    }

    public function update($id, $data) {
        if (!(new MovieDao())->genreExists($data['genre_id'])) {
            return ['error' => 'Genre does not exist'];
        }
        return parent::update($id, $data);
    }
}
