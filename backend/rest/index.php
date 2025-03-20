<?php
require __DIR__ . '/../vendor/autoload.php'; // Podesi ispravan put do autoloadera

Flight::route('/', function () {
    echo 'FlightPHP radi!';
});

Flight::start();
