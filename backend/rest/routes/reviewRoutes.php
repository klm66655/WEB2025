
<?php


require_once __DIR__ . '/../services/ReviewService.php';

/**
 * @OA\Get(
 *     path="/reviews",
 *     summary="Get all reviews",
 *     tags={"Reviews"},
 *     @OA\Response(
 *         response=200,
 *         description="List of reviews"
 *     )
 * )
 */
Flight::route('GET /reviews', function() {
    $conn = Flight::get('db');
    $service = new ReviewService($conn);
    Flight::json($service->getAllReviews());
});

/**
 * @OA\Get(
 *     path="/reviews/{id}",
 *     summary="Get a review by ID",
 *     tags={"Reviews"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Review found"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Review not found"
 *     )
 * )
 */
Flight::route('GET /reviews/@id', function($id) {
    $conn = Flight::get('db');
    $service = new ReviewService($conn);
    Flight::json($service->getReviewById($id));
});

/**
 * @OA\Post(
 *     path="/reviews",
 *     summary="Create a new review",
 *     tags={"Reviews"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"user_id","movie_id","rating","comment"},
 *             @OA\Property(property="user_id", type="integer"),
 *             @OA\Property(property="movie_id", type="integer"),
 *             @OA\Property(property="rating", type="number", format="float"),
 *             @OA\Property(property="comment", type="string")
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Review created successfully"
 *     ),
 *     @OA\Response(
 *         response=409,
 *         description="Review already exists or conflict"
 *     )
 * )
 */
Flight::route('POST /reviews', function() {
    $conn = Flight::get('db');
    $service = new ReviewService($conn);
    $data = Flight::request()->data->getData();

    $result = $service->createReview($data);

    if (isset($result['error'])) {
        Flight::json($result, 409); 
    } else {
        Flight::json(["message" => "Review created successfully"], 201);
    }
});

/**
 * @OA\Put(
 *     path="/reviews/{id}",
 *     summary="Update a review",
 *     tags={"Reviews"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="rating", type="number", format="float"),
 *             @OA\Property(property="comment", type="string")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Review updated successfully"
 *     )
 * )
 */
Flight::route('PUT /reviews/@id', function($id) {
    $conn = Flight::get('db');
    $service = new ReviewService($conn);
    $data = Flight::request()->data->getData();
    $service->updateReview($id, $data);
    Flight::json(["message" => "Review updated successfully"]);
});

/**
 * @OA\Delete(
 *     path="/reviews/{id}",
 *     summary="Delete a review",
 *     tags={"Reviews"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Review deleted successfully"
 *     )
 * )
 */
Flight::route('DELETE /reviews/@id', function($id) {
    $conn = Flight::get('db');
    $service = new ReviewService($conn);
    $service->deleteReview($id);
    Flight::json(["message" => "Review deleted successfully"]);
});