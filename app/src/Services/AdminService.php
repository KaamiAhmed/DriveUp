<?php
namespace App\Services;

use App\Services\IAdminService;
use App\Repositories\IAdminRepository;
use App\Repositories\AdminRepository;
use App\Models\DrivingLesson;
use App\Models\Student;
use DateTime;
use Exception;

class AdminService implements IAdminService{
    private IAdminRepository $adminRepository;

    public function __construct(){
        $this->adminRepository = new AdminRepository();
    }

    public function getAllStudents()
    {
        return $this->adminRepository->getAllStudents();
    }

    public function updateType($studentId, $type) {
        $this->adminRepository->updateType($studentId, $type);
    }

    public function getStudentById($id){
        return $this->adminRepository->getStudentById($id);
    }

    public function getLessonsByStudent($id){
        return $this->adminRepository->getLessonsByStudent($id);
    }

    public function planLesson(DrivingLesson $drivinglesson){
        if(empty($drivinglesson->lesson_date) || empty($drivinglesson->start_time) || empty($drivinglesson->duration_minutes)){ 
            throw new Exception("All fields are required.");
        }

        $this->validatePlanLesson($drivinglesson);
        $this->adminRepository->planLesson($drivinglesson);
    }

    public function removeLesson($lessonId){
        $this->adminRepository->removeLesson($lessonId);
    }

    public function getLessonById($id){
        return $this->adminRepository->getLessonById($id);
    }

    public function updateLesson(DrivingLesson $drivinglesson){
        if(empty($drivinglesson->lesson_date) || empty($drivinglesson->start_time) || empty($drivinglesson->duration_minutes)){ 
            throw new Exception("All fields are required.");
        }
        
        $this->validatePlanLesson($drivinglesson);
        $this->adminRepository->updateLesson($drivinglesson);
    }

    public function deleteStudent(Student $student){
        $this->adminRepository->deleteStudent($student);
    }

    public function getFaqs(){
        return $this->adminRepository->getFaqs();
    }

    private function validatePlanLesson(DrivingLesson $drivinglesson){
        $lessonDate = DateTime::createFromFormat('Y-m-d', $drivinglesson->lesson_date);
        if($lessonDate < new DateTime('today')){
            throw new Exception("Lesson date cannot be in the past.");
        }

        $startTime = DateTime::createFromFormat('H:i', $drivinglesson->start_time);
        $minTime = DateTime::createFromFormat('H:i', '07:00');
        $maxTime = DateTime::createFromFormat('H:i', '22:00');
        if ($startTime < $minTime || $startTime > $maxTime) {
            throw new Exception("Lesson time must be between 07:00 and 22:00.");
        }

        if($drivinglesson->duration_minutes < 60 || $drivinglesson->duration_minutes > 180){
            throw new Exception("Duration must be between 60 and 180.");
        }
    }

}

?>