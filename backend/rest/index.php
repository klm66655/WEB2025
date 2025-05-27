<?php
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/services/AuthService.php';
require_once __DIR__ . '/../middleware/AuthMiddleware.php';
require_once 'db.php'; 
require_once 'config.php'; 

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Povezivanje na bazu
$db = new Database();
Flight::set('db', $db->getConnection());

// Registracija servisa
Flight::register('auth_service', 'AuthService');
Flight::register('auth_middleware', 'AuthMiddleware');

// Globalna autentikacija (osim za login/register)
Flight::route('/*', function() {
    $public_routes = ['/auth/login', '/auth/register'];
    $url = Flight::request()->url;

    foreach ($public_routes as $route) {
        if (strpos($url, $route) === 0) {
            return TRUE;
        }
    }

    try {
        $token = Flight::request()->getHeader("Authentication");
        if (Flight::auth_middleware()->verifyToken($token)) {
            return TRUE;
        }
    } catch (\Exception $e) {
        Flight::halt(401, $e->getMessage());
    }
});

// Učitavanje svih ruta aplikacije
require_once __DIR__ . '/routes/authRoutes.php';
require_once __DIR__ . '/routes/userRoutes.php';
require_once __DIR__ . '/routes/reviewRoutes.php';
require_once __DIR__ . '/routes/movieRoutes.php';
require_once __DIR__ . '/routes/genreRoutes.php';
require_once __DIR__ . '/routes/favoriteMovieRoutes.php';

// Pokretanje aplikacije
Flight::start();
