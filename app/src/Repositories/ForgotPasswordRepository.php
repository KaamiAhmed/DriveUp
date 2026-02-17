<?php
namespace App\Repositories;

use App\Repositories\IForgotPasswordRepository;
use App\Framework\Repository;
use App\Models\ResetPassword;
use App\Models\User;
use Exception;

class ForgotPasswordRepository extends Repository implements IForgotPasswordRepository{
    public function getByEmail($email){
        try{
            $sql = 'SELECT * FROM Users WHERE email = :email';
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            return $stmt->fetchObject(User::class);
        }
        catch(Exception $e){
            echo "Error: " . $e->getMessage();
        }
    }

    public function setToken($userId, $token, $tokenExpiry){
        try{
        $sql = 'INSERT INTO PasswordResets (user_id, token, token_expiry)
                VALUES (:user_id, :token, :tokenExpiry)';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':token', $token);
        $stmt->bindValue(':tokenExpiry', $tokenExpiry->format('Y-m-d H:i:s'));
        $stmt->execute();
        }
        catch(Exception $e){
            echo "Error: " . $e->getMessage();
        }
    }

    public function isTokenValid($token){
        try{
            $sql = 'SELECT Count(*) FROM PasswordResets WHERE token = :token AND token_expiry > NOW()';
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->bindParam(':token', $token);
            $stmt->execute();
            $count = (int) $stmt->fetchColumn();
            return $count > 0;
        }
        catch(Exception $e){
            echo "Error: " . $e->getMessage();
        }
    }

    public function resetPassword($token, $password){
        try{
        $sql = 'UPDATE Users as u JOIN PasswordResets as pr ON u.id = pr.user_id SET u.password = :password WHERE pr.token = :token';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindParam(':token', $token);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        }
        catch(Exception $e){
            echo "Error: " . $e->getMessage();
        }
    }

    public function removeToken($token){
        try{
            $sql = 'DELETE FROM PasswordResets WHERE token = :token';
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->bindParam(':token', $token);
            $stmt->execute();
        }
        catch(Exception $e){
            echo "Error: " . $e->getMessage();
        }
    }
}
?>