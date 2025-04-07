<?php

require_once __DIR__ . '/../services/ReviewService.php';

Flight::route('GET /reviews', function() {
    $conn = Flight::get('db');
    $service = new ReviewService($conn);
    Flight::json($service->getAllReviews());
});

Flight::route('GET /reviews/@id', function($id) {
    $conn = Flight::get('db');
    $service = new ReviewService($conn);
    Flight::json($service->getReviewById($id));
});

Flight::route('POST /reviews', function() {
    $conn = Flight::get('db');
    $service = new ReviewService($conn);
    $data = Flight::request()->data->getData();
    $service->createReview($data);
    Flight::json(["message" => "Review created successfully"]);
});

Flight::route('PUT /reviews/@id', function($id) {
    $conn = Flight::get('db');
    $service = new ReviewService($conn);
    $data = Flight::request()->data->getData();
    $service->updateReview($id, $data);
    Flight::json(["message" => "Review updated successfully"]);
});

Flight::route('DELETE /reviews/@id', function($id) {
    $conn = Flight::get('db');
    $service = new ReviewService($conn);
    $service->deleteReview($id);
    Flight::json(["message" => "Review deleted successfully"]);
});
