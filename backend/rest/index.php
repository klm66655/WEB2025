<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once 'db.php'; 
$db = new Database();
Flight::set('db', $db->getConnection());


require_once __DIR__ . '/routes/userRoutes.php';
require_once __DIR__ . '/routes/reviewRoutes.php';
require_once __DIR__ . '/routes/movieRoutes.php';
require_once __DIR__ . '/routes/genreRoutes.php';
require_once __DIR__ . '/routes/favoriteMovieRoutes.php';


Flight::start();
