<?php
namespace App\Services;
use App\Models\Student;

interface IStudentService{
    public function bookTrialLesson(Student $student);
    public function getStudentById($id);
}

?>