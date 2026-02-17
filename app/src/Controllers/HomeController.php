<?php

namespace App\Controllers;

use App\Models\Review;
use App\Services\AdminService;
use App\Services\IAdminService;
use App\Services\IPricesService;
use App\Services\IReviewService;
use App\Services\IStudentService;
use App\Services\PricesService;
use App\Services\ReviewService;
use App\Services\StudentService;
use App\ViewModels\FaqsViewModel;
use App\ViewModels\ReviewsViewModel;
use App\ViewModels\PackagesViewModel;
use Exception;

class HomeController
{
    private IReviewService $reviewService;
    private IStudentService $studentService;
    private IPricesService $pricesService;
    private IAdminService $adminService;

    public function __construct(){
        $this->reviewService = new ReviewService();
        $this->studentService = new StudentService();
        $this->pricesService = new PricesService();
        $this->adminService = new AdminService();
    }

    public function home()
    {
        try{
            $studentId = null;
            if(isset($_SESSION['user']) && $_SESSION['user']['role'] == 'user'){
                $studentId = $_SESSION['user']['userId'];
            }

            if($studentId){
                $student = $this->studentService->getStudentById($studentId);
            }
            $reviews = $this->reviewService->getAll();
            $vm = new ReviewsViewModel($reviews);
            $type = $_GET['type'] ?? 'Manual';
            $packages = $this->pricesService->getAllPackages($type);
            $vm2 = new PackagesViewModel($packages);
            $faqs = $this->adminService->getFaqs();
            $vm3 = new FaqsViewModel($faqs);
            require __DIR__ . '/../Views/home.php';
        }
        catch(Exception $e){
            echo "Error: " . htmlspecialchars($e->getMessage());
        }
    }

    public function writeReview(){
        $data = json_decode(file_get_contents('php://input'), true);

        if (!$data) {
            http_response_code(400);
            echo json_encode([
                "success" => false,
                "message" => "Invalid JSON"
            ]);

            exit();
        }

        $review = new Review();
        $review->name = trim($data['name'] ?? '');
        $review->review = trim($data['review'] ?? '');

        try{
            $this->reviewService->writeReview($review);
        }
        catch(Exception $e){
            http_response_code(400);
            echo json_encode([
                "success" => false,
                "message" => "All fields are required."
            ]);
            exit();
        }

        // Return success response
        header("Content-Type: application/json");
        echo json_encode([
            "success" => true,
            "message" => "Review submitted successfully"
        ]);
    }

    public function setCookie(){
        setcookie('cookiesAccepted', 'true', [
            'expires' => time() + 30*24*60*60,
            'path' => '/',
            'secure' => true,
            'httponly' => true,
            'samesite' => 'Lax'
        ]);

        header('Content-Type: application/json');
        echo json_encode(['success' => true]);
    }
    
}