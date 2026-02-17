<?php
namespace App\Services;
use App\Models\Review;

interface IReviewService{
    public function writeReview(Review $review);
    public function getAll();
}

?>