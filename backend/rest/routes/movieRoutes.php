<?php
require_once __DIR__ . '/../services/MovieService.php';

/**
 * @OA\Get(
 *     path="/movies",
 *     summary="Get all movies",
 *     tags={"Movies"},
 *     security={{"ApiKey":{}}},
 *     @OA\Response(response=200, description="List of movies")
 * )
 */
Flight::route('GET /movies', function () {
    Flight::auth_middleware()->authorizeRoles([Roles::ADMIN, Roles::USER]);
    $service = new MovieService();
    Flight::json($service->getAll());
});

/**
 * @OA\Get(
 *     path="/movies/{id}",
 *     summary="Get a movie by ID",
 *     tags={"Movies"},
 *     security={{"ApiKey":{}}},
 *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
 *     @OA\Response(response=200, description="Movie found"),
 *     @OA\Response(response=404, description="Movie not found")
 * )
 */
Flight::route('GET /movies/@id', function ($id) {
    Flight::auth_middleware()->authorizeRoles([Roles::ADMIN, Roles::USER]);
    $service = new MovieService();
    Flight::json($service->getById($id));
});

/**
 * @OA\Post(
 *     path="/movies",
 *     summary="Create a new movie",
 *     tags={"Movies"},
 *     security={{"ApiKey":{}}},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"title","release_year","description","genre_id"},
 *             @OA\Property(property="title", type="string"),
 *             @OA\Property(property="release_year", type="string"),
 *             @OA\Property(property="description", type="string"),
 *             @OA\Property(property="genre_id", type="integer")
 *         )
 *     ),
 *     @OA\Response(response=201, description="Movie created successfully"),
 *     @OA\Response(response=400, description="Invalid input or error occurred")
 * )
 */
Flight::route('POST /movies', function () {
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
    $service = new MovieService();
    $data = Flight::request()->data->getData();
    $result = $service->create($data);

    if (isset($result['error'])) {
        Flight::json($result, 400);
    } else {
        Flight::json(["message" => "Movie created successfully"], 201);
    }
});

/**
 * @OA\Put(
 *     path="/movies/{id}",
 *     summary="Update a movie",
 *     tags={"Movies"},
 *     security={{"ApiKey":{}}},
 *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="title", type="string"),
 *             @OA\Property(property="release_year", type="integer"),
 *             @OA\Property(property="description", type="string"),
 *             @OA\Property(property="genre_id", type="integer")
 *         )
 *     ),
 *     @OA\Response(response=200, description="Movie updated successfully")
 * )
 */
Flight::route('PUT /movies/@id', function ($id) {
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
    $service = new MovieService();
    $data = Flight::request()->data->getData();
    $result = $service->update($id, $data);

    if (isset($result['error'])) {
        Flight::json($result, 400);
    } else {
        Flight::json(["message" => "Movie updated successfully"]);
    }
});

/**
 * @OA\Delete(
 *     path="/movies/{id}",
 *     summary="Delete a movie",
 *     tags={"Movies"},
 *     security={{"ApiKey":{}}},
 *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
 *     @OA\Response(response=200, description="Movie deleted successfully")
 * )
 */
Flight::route('DELETE /movies/@id', function ($id) {
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
    $service = new MovieService();
    $service->delete($id);
    Flight::json(["message" => "Movie deleted successfully"]);
});
