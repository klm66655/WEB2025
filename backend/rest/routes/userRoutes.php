<?php

require_once __DIR__ . '/../services/UserService.php';

Flight::route('GET /users', function() {
    $conn = Flight::get('db');
    $service = new UserService($conn);
    Flight::json($service->getAllUsers());
});

Flight::route('GET /users/@id', function($id) {
    $conn = Flight::get('db');
    $service = new UserService($conn);
    Flight::json($service->getUserById($id));
});

Flight::route('POST /users', function() {
    $conn = Flight::get('db');
    $service = new UserService($conn);
    $data = Flight::request()->data->getData();
    $service->createUser($data);
    Flight::json(["message" => "User created successfully"]);
});

Flight::route('PUT /users/@id', function($id) {
    $conn = Flight::get('db');
    $service = new UserService($conn);
    $data = Flight::request()->data->getData();
    $service->updateUser($id, $data);
    Flight::json(["message" => "User updated successfully"]);
});

Flight::route('DELETE /users/@id', function($id) {
    $conn = Flight::get('db');
    $service = new UserService($conn);
    $service->deleteUser($id);
    Flight::json(["message" => "User deleted successfully"]);
});
