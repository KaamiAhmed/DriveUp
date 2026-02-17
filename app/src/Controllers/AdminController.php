<?php

namespace App\Controllers;
use App\Models\DrivingLesson;
use App\Services\IAdminService;
use App\Services\AdminService;
use App\Models\Enums\StudentType;
use App\ViewModels\LessonsViewModel;
use App\ViewModels\LessonViewModel;
use Exception;

class AdminController{
    private IAdminService $adminService;

    public function __construct(){
        $this->adminService = new AdminService();
    }

    public function showPortal(){
        try{
            if(isset($_SESSION['user']) && $_SESSION['user']['role'] == 'admin'){
                $students = $this->adminService->getAllStudents();
                $types = StudentType::values();
                require __DIR__ . '/../Views/portal.php';
            }
            else{
                header("Location: /");
                exit();
            }
        }
        catch(Exception $e){
            echo "Error: " . htmlspecialchars($e->getMessage());
        }
    }

    public function updateStudentType() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            if (!$data) {
                echo json_encode(['success' => false, 'message' => 'Invalid input']);
                return;
            }
        
            $studentId = $data['student_id'] ?? null;
            $type = $data['type'] ?? null;

            try{
                $this->adminService->updateType($studentId, $type);
            }
            catch(Exception $e){
                echo "Error: " . htmlspecialchars($e->getMessage());
            }

            $student = $this->adminService->getStudentById($studentId);
            header("Content-Type: application/json");
            echo json_encode([
                "success" => true,
                "message" => "Type of student '{$student->firstname}' updated successfully"
            ]);
        }
    }

    public function deleteStudent($vars){
        if($_SESSION['user']['role'] != 'admin'){
            return;
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            header('Content-Type: application/json');
            $studentId = $vars['studentId'] ?? null;

            if (!$studentId) {
                echo json_encode([
                    'success' => false,
                    'message' => 'Student ID missing'
                ]);
                return;
            }

            try{
                $student = $this->adminService->getStudentById($studentId);
                $this->adminService->deleteStudent($student);
                echo json_encode([
                    'success' => true,
                    'message' => "Student with id {$studentId} has been deleted."
                ]);
            }
            catch(Exception $e){
                echo json_encode([
                    'success' => false,
                    'message' => $e->getMessage()
                ]);
            }
        }

    }

    public function showSchedule($vars){
        try{
            $studentId = $vars['studentId'] ?? null;

            if (!$studentId) {
                header('Location: /portal');
                exit();
            }

            if(isset($_SESSION['user']) && $_SESSION['user']['role'] == 'admin'){
                $student = $this->adminService->getStudentById($studentId);
                $lessons = $this->adminService->getLessonsByStudent($studentId);
                
                if(!$lessons){
                    $_SESSION['no_lessons'] = 'There are no lessons to show.';
                }
                
                $vm = new LessonsViewModel($lessons);
                require __DIR__ . '/../Views/schedule.php';
            }
            else{
                header("Location: /");
                exit();
            }
        }
        catch(Exception $e){
            echo "Error: " . htmlspecialchars($e->getMessage());
        }
    }

    public function showPlanLesson($vars){
        try{
            if(isset($_SESSION['user']) && $_SESSION['user']['role'] == 'admin'){
                $studentId = $vars['studentId'] ?? null;

                if (!$studentId) {
                    header('Location: /schedule');
                    exit();
                }

                require __DIR__ . '/../Views/planlesson.php';
            }
            else{
                header("Location: /");
                exit();
            }
        }
        catch(Exception $e){
            echo "Error: " . htmlspecialchars($e->getMessage());
        }
    }

    public function planLesson($vars){
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /portal');
            exit();
        }

        $studentId = $vars['studentId'] ?? null;
        if (!$studentId) {
            header("Location: /planlesson/{$studentId}");
            exit();
        }

        $drivinglesson = new DrivingLesson();
        $drivinglesson->student_id = $studentId;
        $drivinglesson->lesson_date = trim($_POST['lesson_date'] ?? '');
        $drivinglesson->start_time = trim($_POST['start_time'] ?? '');
        $drivinglesson->duration_minutes = (int)trim($_POST['duration_minutes'] ?? '');

        try{
            $this->adminService->planLesson($drivinglesson);
        }
        catch(Exception $e){
            $_SESSION['error'] = $e->getMessage();
            header("Location: /planlesson/{$studentId}");
            exit();
        }

        $_SESSION['success'] = "Lesson planned successfully!";
        header("Location: /schedule/{$studentId}");
        exit();
    }

    public function removeLesson($vars){
        if($_SESSION['user']['role'] != 'admin'){
            return;
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            header('Content-Type: application/json');
            $lessonId = $vars['lessonId'] ?? null;

            if (!$lessonId) {
                echo json_encode([
                    'success' => false,
                    'message' => 'Lesson ID missing'
                ]);
                return;
            }

            try{
                $this->adminService->removeLesson($lessonId);
                echo json_encode([
                    'success' => true,
                    'message' => "Lesson with id {$lessonId} removed successfully."
                ]);
            }
            catch(Exception $e){
                echo json_encode([
                    'success' => false,
                    'message' => $e->getMessage()
                ]);
            }
        }
    }

    public function editLesson($vars){
        try{
            if(isset($_SESSION['user']) && $_SESSION['user']['role'] == 'admin'){
                $lessonId = $vars['lessonId'] ?? null;
                $lesson = $this->adminService->getLessonById($lessonId);
                if(!$lesson){
                    echo "Lesson not found";
                    return;
                }

                $vm = new LessonViewModel($lesson);
                require __DIR__ . '/../Views/editlesson.php';
            }
            else{
                header("Location: /");
                exit();
            }
        }
        catch(Exception $e){
            echo "Error: " . htmlspecialchars($e->getMessage());
        }
    }

    public function updateLesson($vars){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $lessonId = $vars['lessonId'] ?? null;
            $lesson = $this->adminService->getLessonById($lessonId);
            if(!$lesson){
                echo "Lesson not found";
                return;
            }

            $lesson->lesson_date = trim($_POST['lesson_date'] ?? '');
            $lesson->start_time = trim($_POST['start_time'] ?? '');
            $lesson->duration_minutes = (int)trim($_POST['duration_minutes'] ?? '');

            try{
                $this->adminService->updateLesson($lesson);
            }
            catch(Exception $e){
                $_SESSION['error'] = $e->getMessage();
                header("Location: /planlesson/{$lesson->student_id}");
                exit();
            }

            $_SESSION['success'] = "Lesson updated successfully!";
            header("Location: /schedule/{$lesson->student_id}");
            exit();
        }
    }

}

?>