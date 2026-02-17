<?php
namespace App\Services;

use App\Models\Review;
use App\Repositories\IReviewRepository;
use App\Repositories\ReviewRepository;
use App\Services\IReviewService;
use Exception;

class ReviewService implements IReviewService{
    private IReviewRepository $reviewRepository;

    public function __construct()
    {
        $this->reviewRepository = new ReviewRepository();
    }

    public function writeReview(Review $review)
    {
        if(empty($review->name) || empty($review->review)){
            throw new Exception("All fields are required.");
        }
        
        $this->reviewRepository->writeReview($review);
    }

    public function getAll(){
        return $this->reviewRepository->getAll();
    }
}