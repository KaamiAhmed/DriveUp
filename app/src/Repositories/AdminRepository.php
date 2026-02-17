<?php
namespace App\Repositories;

use App\Repositories\IAdminRepository;
use App\Models\Student;
use App\Framework\Repository;
use App\Models\DrivingLesson;
use Exception;
use PDO;
use App\Models\Faq;
use DateTime;

class AdminRepository extends Repository implements IAdminRepository{
    public function getAllStudents(){
        try{
        $sql = 'SELECT * FROM Students';
        $result = $this->getConnection()->query($sql);
        $students = $result->fetchAll(PDO::FETCH_CLASS, Student::class);
        return $students;
        }
        catch(Exception $e){
            echo "Error: " . $e->getMessage();
        }
    }

    public function updateType($id, $type){
        try{
            $sql = 'UPDATE Students SET type = :type WHERE id = :id';
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':type', $type);
            $stmt->execute();
        }
        catch(Exception $e){
            echo "Error: " . $e->getMessage();
        }
    }

    public function getStudentById($id){
        try{
            $sql = 'SELECT * FROM Students WHERE id = :id';
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetchObject(Student::class);
        }
        catch(Exception $e){
            echo "Error: " . $e->getMessage();
        }
    }

    public function deleteStudent(Student $student){
        try{
            $sql = 'DELETE FROM Students WHERE id = :studentId';
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->bindParam(':studentId', $student->id);
            $stmt->execute();
        }
        catch(Exception $e){
            echo "Error: " . $e->getMessage();
        }
    }

    public function getLessonsByStudent($id){
        try{
            $sql = 'SELECT dl.*, s.firstname, s.lastname FROM DrivingLessons AS dl JOIN Students AS s ON dl.student_id = s.id WHERE dl.student_id = :id ORDER BY dl.lesson_date';
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_CLASS,DrivingLesson::class);
        }
        catch(Exception $e){
            echo "Error: " . $e->getMessage();
        }
    }

    public function planLesson(DrivingLesson $drivinglesson){
        try{
            $sql = 'INSERT INTO DrivingLessons (student_id, lesson_date, start_time, duration_minutes) 
                    VALUES (:student_id, :date, :start_time, :duration)';
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->bindParam(':student_id', $drivinglesson->student_id);
            $stmt->bindParam(':date', $drivinglesson->lesson_date);
            $stmt->bindParam(':start_time', $drivinglesson->start_time);
            $stmt->bindParam(':duration', $drivinglesson->duration_minutes);
            $stmt->execute();
        }
        catch(Exception $e){
            echo "Error: " . $e->getMessage();
        }
    }

    public function removeLesson($lessonId){
        try{
            $sql = 'DELETE FROM DrivingLessons WHERE id = :lessonId';
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->bindParam(':lessonId', $lessonId);
            $stmt->execute();
        }
        catch(Exception $e){
            echo "Error: " . $e->getMessage();
        }
    }

    public function getLessonById($id){
        try{
            $sql = 'SELECT * FROM DrivingLessons WHERE id = :id';
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetchObject(DrivingLesson::class);
        }
        catch(Exception $e){
            echo "Error: " . $e->getMessage();
        }
    }

    public function updateLesson(DrivingLesson $lesson){
        try{
            $sql = 'UPDATE DrivingLessons SET lesson_date = :lessonDate, start_time = :startTime, duration_minutes = :duration WHERE id = :lessonId';
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->bindParam(':lessonDate', $lesson->lesson_date);
            $stmt->bindParam(':startTime', $lesson->start_time);
            $stmt->bindParam(':duration', $lesson->duration_minutes);
            $stmt->bindParam(':lessonId', $lesson->id);
            $stmt->execute();
        }
        catch(Exception $e){
            echo "Error: " . $e->getMessage();
        }
    }

    public function getFaqs(){
        try{
            $sql = 'SELECT * FROM faqs';
            $result = $this->getConnection()->query($sql);
            $faqs = $result->fetchAll(PDO::FETCH_CLASS, Faq::class);
            return $faqs;
        }
        catch(Exception $e){
            echo "Error: " . $e->getMessage();
        }
    }
}

?>