<?php


require_once __DIR__ . '/../services/GenreService.php';

/**
 * @OA\Get(
 *     path="/genres",
 *     summary="Get all genres",
 *     tags={"Genres"},
 *     security={{"ApiKey":{}}},
 *     @OA\Response(
 *         response=200,
 *         description="List of genres"
 *     )
 * )
 */
Flight::route('GET /genres', function() {
    Flight::auth_middleware()->authorizeRoles([Roles::ADMIN, Roles::USER]);
    $conn = Flight::get('db');
    $service = new GenreService($conn);
    Flight::json($service->getAllGenres());
});

/**
 * @OA\Get(
 *     path="/genres/{id}",
 *     summary="Get a genre by ID",
 *     tags={"Genres"},
 *     security={{"ApiKey":{}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Genre found"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Genre not found"
 *     )
 * )
 */
Flight::route('GET /genres/@id', function($id) {
    Flight::auth_middleware()->authorizeRoles([Roles::ADMIN, Roles::USER]);
    $conn = Flight::get('db');
    $service = new GenreService($conn);
    Flight::json($service->getGenreById($id));
});

/**
 * @OA\Post(
 *     path="/genres",
 *     summary="Create a new genre",
 *     tags={"Genres"},
 *     security={{"ApiKey":{}}},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"name"},
 *             @OA\Property(property="name", type="string")
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Genre created successfully"
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Invalid input or error occurred"
 *     )
 * )
 */
Flight::route('POST /genres', function() {
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
    $conn = Flight::get('db');
    $service = new GenreService($conn);
    $data = Flight::request()->data->getData();

    $result = $service->createGenre($data);

    if (isset($result['error'])) {
        Flight::json($result, 400); 
    } else {
        Flight::json(["message" => "Genre created successfully"], 201);
    }
});

/**
 * @OA\Put(
 *     path="/genres/{id}",
 *     summary="Update a genre",
 *     tags={"Genres"},
 *     security={{"ApiKey":{}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="name", type="string")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Genre updated successfully"
 *     )
 * )
 */
Flight::route('PUT /genres/@id', function($id) {
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
    $conn = Flight::get('db');
    $service = new GenreService($conn);
    $data = Flight::request()->data->getData();
    $service->updateGenre($id, $data);
    Flight::json(["message" => "Genre updated successfully"]);
});

/**
 * @OA\Delete(
 *     path="/genres/{id}",
 *     summary="Delete a genre",
 *     tags={"Genres"},
 *     security={{"ApiKey":{}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Genre deleted successfully"
 *     )
 * )
 */
Flight::route('DELETE /genres/@id', function($id) {
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
    $conn = Flight::get('db');
    $service = new GenreService($conn);
    $service->deleteGenre($id);
    Flight::json(["message" => "Genre deleted successfully"]);
});