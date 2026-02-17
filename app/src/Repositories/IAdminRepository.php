<?php
namespace App\Repositories;
use App\Models\DrivingLesson;
use App\Models\Student;

interface IAdminRepository{
    public function getAllStudents();
    public function updateType($id, $type);
    public function getStudentById($id);
    public function getLessonsByStudent($id);
    public function planLesson(DrivingLesson $drivinglesson);
    public function removeLesson($lessonId);
    public function getLessonById($id);
    public function updateLesson(DrivingLesson $lesson);
    public function deleteStudent(Student $student);
    public function getFaqs();
}

?>