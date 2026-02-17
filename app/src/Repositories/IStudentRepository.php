<?php
namespace App\Repositories;
use App\Models\Student;

interface IStudentRepository{
    public function bookTrialLesson(Student $student);
     public function EmailExists(Student $student);
     public function getStudentById($id);
}

?>