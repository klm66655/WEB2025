<?php


require_once __DIR__ . '/../services/UserService.php';

/**
 * @OA\Get(
 *     path="/users",
 *     summary="Get all users",
 *     tags={"User"},
 *     @OA\Response(
 *         response=200,
 *         description="List of users"
 *     )
 * )
 */
Flight::route('GET /users', function() {
    $conn = Flight::get('db');
    $service = new UserService($conn);
    Flight::json($service->getAllUsers());
});

/**
 * @OA\Get(
 *     path="/users/{id}",
 *     summary="Get user by ID",
 *     tags={"User"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="User data"
 *     )
 * )
 */
Flight::route('GET /users/@id', function($id) {
    $conn = Flight::get('db');
    $service = new UserService($conn);
    Flight::json($service->getUserById($id));
});

/**
 * @OA\Post(
 *     path="/users",
 *     summary="Create a new user",
 *     tags={"User"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"username", "email", "password"},
 *             @OA\Property(property="username", type="string"),
 *             @OA\Property(property="email", type="string"),
 *             @OA\Property(property="password", type="string")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="User created"
 *     )
 * )
 */
Flight::route('POST /users', function() {
    $conn = Flight::get('db');
    $service = new UserService($conn);
    $data = Flight::request()->data->getData();
    $service->createUser($data);
    Flight::json(["message" => "User created successfully"]);
});

/**
 * @OA\Put(
 *     path="/users/{id}",
 *     summary="Update a user",
 *     tags={"User"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="name", type="string"),
 *             @OA\Property(property="email", type="string"),
 *             @OA\Property(property="password", type="string")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="User updated"
 *     )
 * )
 */
Flight::route('PUT /users/@id', function($id) {
    $conn = Flight::get('db');
    $service = new UserService($conn);
    $data = Flight::request()->data->getData();
    $service->updateUser($id, $data);
    Flight::json(["message" => "User updated successfully"]);
});

/**
 * @OA\Delete(
 *     path="/users/{id}",
 *     summary="Delete a user",
 *     tags={"User"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="User deleted"
 *     )
 * )
 */
Flight::route('DELETE /users/@id', function($id) {
    $conn = Flight::get('db');
    $service = new UserService($conn);
    $service->deleteUser($id);
    Flight::json(["message" => "User deleted successfully"]);
});