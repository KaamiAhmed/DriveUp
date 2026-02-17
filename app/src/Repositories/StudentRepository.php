<?php
namespace App\Repositories;

use App\Repositories\IStudentRepository;
use App\Models\Student;
use App\Framework\Repository;
use Exception;

class StudentRepository extends Repository implements IStudentRepository{
    public function bookTrialLesson(Student $student){
        try{
            $sql = 'INSERT INTO Students (user_id, firstname, lastname, email, mobile, dateofbirth, street_house, postcode, residenceplace) VALUES (:userId, :firstname, :lastname, :email, :mobile, :dateofbirth, :street_house, :postcode, :residenceplace)';
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->bindParam(':userId', $student->user_id);
            $stmt->bindParam(':firstname', $student->firstname);
            $stmt->bindParam(':lastname', $student->lastname);
            $stmt->bindParam(':email', $student->email);
            $stmt->bindParam(':mobile', $student->mobile);
            $stmt->bindParam(':dateofbirth', $student->dateofbirth);
            $stmt->bindParam(':street_house', $student->street_house);
            $stmt->bindParam(':postcode', $student->postcode);
            $stmt->bindParam(':residenceplace', $student->residenceplace);
            $stmt->execute();
        }
        catch(Exception $e){
             echo "Error: " . $e->getMessage();
        }
    }

    public function EmailExists(Student $student){
        try{
            $sql = 'SELECT COUNT(*) FROM Students WHERE email = :email';
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->bindParam(':email', $student->email);
            $stmt->execute();
            $count = (int) $stmt->fetchColumn();
            return $count > 0;
        }
        catch(Exception $e){
             echo "Error checking. " . $e->getMessage();
        }
    }

    public function getStudentById($id){
        try{
            $sql = 'SELECT * FROM Students WHERE user_id = :id';
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetchObject(Student::class);
        }
        catch(Exception $e){
            echo "Error: " . $e->getMessage();
        }
    }

}

?>