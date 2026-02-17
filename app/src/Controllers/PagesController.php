<?php
namespace App\Controllers;

use App\Services\AdminService;
use App\Services\IAdminService;
use App\Services\IReviewService;
use App\Services\IStudentService;
use App\Services\StudentService;
use App\Services\ReviewService;
use App\Services\IPricesService;
use App\Services\PricesService;
use App\ViewModels\ReviewsViewModel;
use App\ViewModels\PackagesViewModel;
use App\ViewModels\IndividualPricesViewModel;
use App\ViewModels\FaqsViewModel;
use Exception;

class PagesController{
    private IReviewService $reviewService;
    private IStudentService $studentService;
    private IPricesService $pricesService;
    private IAdminService $adminService;

    public function __construct()
    {
        $this->reviewService = new ReviewService();
        $this->studentService = new StudentService();
        $this->pricesService = new PricesService();
        $this->adminService = new AdminService();
    }
    
    public function showDrivingLessonsPage(){
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
            $faqs = $this->adminService->getFaqs();
            $vm2 = new FaqsViewModel($faqs);
            require __DIR__ . '/../Views/drivinglessons.php';
        }
        catch(Exception $e){
            echo "Error: " . htmlspecialchars($e->getMessage());
        }
    }

    public function showPricesPage(){
        try{
            $studentId = null;
            if(isset($_SESSION['user']) && $_SESSION['user']['role'] == 'user'){
                $studentId = $_SESSION['user']['userId'];
            }

            if($studentId){
                $student = $this->studentService->getStudentById($studentId);
            }

            $individualPrices = $this->pricesService->getIndividualPrices();
            $vm2 = new IndividualPricesViewModel($individualPrices);
            require __DIR__ . '/../Views/prices.php';
        }
        catch(Exception $e){
            echo "Error: " . htmlspecialchars($e->getMessage());
        }
    }

    public function showPackages(){
        try{
            $type = $_GET['type'] ?? 'Manual';
            $packages = $this->pricesService->getAllPackages($type);
            $vm = new PackagesViewModel($packages);
            require __DIR__ . '/../Views/partials/packages.php';
        }
        catch(Exception $e){
            echo "Error: " . htmlspecialchars($e->getMessage());
        }
    }

    public function showPrivacyPage(){
        require __DIR__ . '/../Views/privacypolicy.php';
    }
}
?>