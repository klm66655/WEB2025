<?php


require_once __DIR__ . '/../services/FavoriteMovieService.php';

/**
 * @OA\Get(
 *     path="/favorites",
 *     summary="Get all favorite movies",
 *     tags={"Favorite Movies"},
 *     @OA\Response(
 *         response=200,
 *         description="List of all favorite movie entries"
 *     )
 * )
 */
Flight::route('GET /favorites', function() {
    $conn = Flight::get('db');
    $service = new FavoriteMovieService($conn);
    Flight::json($service->getAllFavorites());
});

/**
 * @OA\Get(
 *     path="/favorites/user/{user_id}",
 *     summary="Get favorite movies by user ID",
 *     tags={"Favorite Movies"},
 *     @OA\Parameter(
 *         name="user_id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="List of favorite movies for a specific user"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="No favorites found for this user"
 *     )
 * )
 */
Flight::route('GET /favorites/user/@user_id', function($user_id) {
    $conn = Flight::get('db');
    $service = new FavoriteMovieService($conn);
    Flight::json($service->getFavoritesByUserId($user_id));
});

/**
 * @OA\Post(
 *     path="/favorites",
 *     summary="Add a movie to favorites",
 *     tags={"Favorite Movies"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"user_id","movie_id"},
 *             @OA\Property(property="user_id", type="integer"),
 *             @OA\Property(property="movie_id", type="integer")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Favorite movie added successfully"
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Invalid input or error occurred"
 *     )
 * )
 */
Flight::route('POST /favorites', function() {
    $conn = Flight::get('db');
    $service = new FavoriteMovieService($conn);
    $data = Flight::request()->data->getData();
    $service->addFavorite($data);
    Flight::json(["message" => "Favorite movie added successfully"]);
});

/**
 * @OA\Delete(
 *     path="/favorites/{user_id}/{movie_id}",
 *     summary="Remove a movie from favorites",
 *     tags={"Favorite Movies"},
 *     @OA\Parameter(
 *         name="user_id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Parameter(
 *         name="movie_id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Favorite movie removed successfully"
 *     )
 * )
 */
Flight::route('DELETE /favorites/@user_id/@movie_id', function($user_id, $movie_id) {
    $conn = Flight::get('db');
    $service = new FavoriteMovieService($conn);
    $service->deleteFavorite($user_id, $movie_id);
    Flight::json(["message" => "Favorite movie removed successfully"]);
});