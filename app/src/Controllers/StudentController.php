<?php

namespace App\Controllers;
use App\Services\AdminService;
use App\Services\IStudentService;
use App\Services\StudentService;
use App\Models\Student;
use App\Services\IAdminService;
use App\Models\Enums\StudentType;
use App\ViewModels\LessonsViewModel;
use Exception;

class StudentController{
    private IStudentService $studentService;
    private IAdminService $adminService;

    public function __construct()
    {
        $this->studentService = new StudentService();
        $this->adminService = new AdminService();
    }

    public function showForm(){
        if(!isset($_SESSION['user'])){
            $_SESSION['pre-condition'] = "Please login or create account first.";
            header("Location: /login");
            exit();
        }
        require __DIR__ . '/../Views/triallessonform.php';
    }

    public function submitForm(){
        try{
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (isset($_POST['consent']) && $_POST['consent'] === 'yes') {
                    $_SESSION['consent_given'] = true;
                } else {
                    $_SESSION['consent_needed'] = "You must give consent to use the website features.";
                    require __DIR__ . '/../Views/triallessonform.php';
                    return;
                }

                $student = new Student();
                $student->firstname = trim($_POST['firstname'] ?? '');
                $student->lastname = trim($_POST['lastname'] ?? '');
                $student->email = trim($_POST['email'] ?? '');
                $student->mobile = trim($_POST['mobile'] ?? '');
                
                $student->dateofbirth = trim($_POST['dateofbirth'] ?? '');
                // if(!empty($_POST['dateofbirth'])){
                //     $student->dateofbirth = new DateTime($_POST['dateofbirth']);
                // }
                $student->street_house = trim($_POST['street_house'] ?? '');
                $student->postcode = trim($_POST['postcode'] ?? '');
                $student->residenceplace = trim($_POST['residence_place'] ?? '');
                $student->user_id = $_SESSION['user']['userId'];

                $this->studentService->bookTrialLesson($student);

                $_SESSION['form_submitted'] = "You have been registered successfully. A confirmation email has been sent to you.";
                header("Location: /triallessonform");
                exit();
            }
        }
        catch(Exception $e){
            $_SESSION['error_registering'] = $e->getMessage();
            require __DIR__ . '/../Views/triallessonform.php';
        }
    }

    public function showLessons(){
        try{
            if(!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'user'){
                return;
            }

            $studentId = $_SESSION['user']['userId'];

            if(!$studentId){
                return;
            }

            $student = $this->studentService->getStudentById($studentId);

            if(!$student || $student->type != StudentType::REGULAR->value){
                return;
            }

            $lessons = $this->adminService->getLessonsByStudent($student->id);
            
            if(!$lessons){
                $_SESSION['no_lessons'] = 'There are no lessons to show.';
            }
                
            $vm = new LessonsViewModel($lessons);
            require __DIR__ . '/../Views/schedule.php';
        }
        catch(Exception $e){
            echo "Error: " . htmlspecialchars($e->getMessage());
        }
    }
}

?>