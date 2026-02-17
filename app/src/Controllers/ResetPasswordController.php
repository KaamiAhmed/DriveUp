<?php

namespace App\Controllers;

use App\Services\IForgotPasswordService;
use App\Services\ForgotPasswordService;
use App\Services\ILoginService;
use App\Services\LoginService;
use Exception;

class ResetPasswordController
{
    private IForgotPasswordService $forgotPasswordService;
    private ILoginService $loginService;

    public function __construct(){
        $this->forgotPasswordService = new ForgotPasswordService();
        $this->loginService = new LoginService();
    }

    public function showForgotPassword(){
        if(isset($_SESSION['user'])){
            unset($_SESSION['user']);
        }
        require __DIR__ . '/../Views/forgotpassword.php';
    }

    public function forgotPassword(){
        try{
             if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $email = trim($_POST['email'] ?? '');
                if($email){
                    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                        throw new Exception("Invalid email.");
                    }

                    $this->forgotPasswordService->forgotPassword($email);
                    $_SESSION['email_sent'] = "Email with reset password link has been sent to you. Take me to <a href='https://mail.google.com' target='_blank'>Gmail</a>";
                    header('Location: /forgotpassword');
                    exit();
                }
             }
        }
        catch(Exception $e){
            $_SESSION['error'] = $e->getMessage();
            require __DIR__ . '/../Views/forgotpassword.php';
        }
    }

    public function showResetPassword($vars){
        try{
            // $token = $_GET['token'] ?? '';
            $token = $vars['token'] ?? '';
            if($this->forgotPasswordService->validateToken($token)){
                require __DIR__ . '/../Views/resetpassword.php';
            }
        }
        catch(Exception $e){
            echo "Error: " . htmlspecialchars($e->getMessage());
        }
    }

    public function resetPassword(){
        try{
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $token = $_POST['token'] ?? '';
                $password = $_POST['newpassword'] ?? '';
                $confirm = $_POST['confirmpassword'] ?? '';

                if($token && $password && $confirm){
                    $this->loginService->validatePassword($password);
                }

                if ($password !== $confirm) {
                    $_SESSION['error'] = "Passwords do not match.";
                    header("Location: /resetpassword/" . urlencode($token));
                    exit();
                }

                $this->forgotPasswordService->resetPassword($token, $password);

                $_SESSION['success'] = "Password reset successfully!";
                header('Location: /login');
                exit();
            }
        }
        catch(Exception $e){
            // echo "Error: " . htmlspecialchars($e->getMessage());
            $_SESSION['password_validate'] = $e->getMessage();
            require __DIR__ . '/../Views/resetpassword.php';
        }
    }
}

?>