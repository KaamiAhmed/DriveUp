<?php
namespace App\Repositories;
use App\Models\Review;

interface IReviewRepository{
    public function writeReview(Review $review);
    public function getAll();
}

?>