<?php


require_once __DIR__ . '/../services/MovieService.php';

/**
 * @OA\Get(
 *     path="/movies",
 *     summary="Get all movies",
 *     tags={"Movies"},
 *     @OA\Response(
 *         response=200,
 *         description="List of movies"
 *     )
 * )
 */
Flight::route('GET /movies', function() {
    $conn = Flight::get('db');
    $service = new MovieService($conn);
    Flight::json($service->getAllMovies());
});

/**
 * @OA\Get(
 *     path="/movies/{id}",
 *     summary="Get a movie by ID",
 *     tags={"Movies"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Movie found"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Movie not found"
 *     )
 * )
 */
Flight::route('GET /movies/@id', function($id) {
    $conn = Flight::get('db');
    $service = new MovieService($conn);
    Flight::json($service->getMovieById($id));
});

/**
 * @OA\Post(
 *     path="/movies",
 *     summary="Create a new movie",
 *     tags={"Movies"},
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
 *     @OA\Response(
 *         response=201,
 *         description="Movie created successfully"
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Invalid input or error occurred"
 *     )
 * )
 */
Flight::route('POST /movies', function() {
    $conn = Flight::get('db');
    $service = new MovieService($conn);
    $data = Flight::request()->data->getData();

    $result = $service->createMovie($data);

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
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="title", type="string"),
 *             @OA\Property(property="genre", type="string"),
 *             @OA\Property(property="release_year", type="integer"),
 *             @OA\Property(property="director", type="string")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Movie updated successfully"
 *     )
 * )
 */
Flight::route('PUT /movies/@id', function($id) {
    $conn = Flight::get('db');
    $service = new MovieService($conn);
    $data = Flight::request()->data->getData();
    $service->updateMovie($id, $data);
    Flight::json(["message" => "Movie updated successfully"]);
});

/**
 * @OA\Delete(
 *     path="/movies/{id}",
 *     summary="Delete a movie",
 *     tags={"Movies"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Movie deleted successfully"
 *     )
 * )
 */
Flight::route('DELETE /movies/@id', function($id) {
    $conn = Flight::get('db');
    $service = new MovieService($conn);
    $service->deleteMovie($id);
    Flight::json(["message" => "Movie deleted successfully"]);
});
