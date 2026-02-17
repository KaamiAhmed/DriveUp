<?php
namespace App\ViewModels;
use App\Models\Review;
class ReviewsViewModel{
    /**
    * @var Review[]
    */
    public array $reviews;

    public function __construct(array $reviews){
        $this->reviews = $reviews;
    }
}
?>