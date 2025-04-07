<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once 'db.php'; 
$db = new Database();
Flight::set('db', $db->getConnection());


require_once __DIR__ . '/routes/userRoutes.php';
require_once __DIR__ . '/routes/reviewRoutes.php';


Flight::start();
