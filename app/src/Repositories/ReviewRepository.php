<?php
namespace App\Repositories;

use App\Repositories\IReviewRepository;
use App\Models\Review;
use App\Framework\Repository;
use Exception;
use PDO;

class ReviewRepository extends Repository implements IReviewRepository{
    public function writeReview(Review $review){
        try{
            $sql = 'INSERT INTO Reviews (name, review) VALUES (:name, :review)';
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->bindParam(':name', $review->name);
            $stmt->bindParam(':review', $review->review);
            $stmt->execute();
        }
        catch(Exception $e){
             echo "Error: " . $e->getMessage();
        }
    }

    public function getAll(){
        try{
            $sql = 'SELECT id, name, review FROM Reviews';
            $result = $this->getConnection()->query($sql);
            $reviews = $result->fetchAll(PDO::FETCH_CLASS, Review::class);
            return $reviews;
        }
        catch(Exception $e){
            echo "Error: " . $e->getMessage();
        }
    }
}

?>