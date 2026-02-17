<?php

namespace App\Controllers;
use App\Services\ILoginService;
use App\Services\LoginService;
use App\Models\User;
use Exception;

class LoginController
{
    private ILoginService $loginService;

    public function __construct(){
        $this->loginService = new LoginService();
    }

    public function showLogin(){
        require __DIR__ . '/../Views/login.php';
    }

    public function login(){
        try{
            if(isset($_SESSION['user'])){
                unset($_SESSION['user']);
            }
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $username = trim($_POST['username'] ?? '');
                $password = $_POST['password'] ?? '';
                if (empty($username) || empty($password)) {
                    $_SESSION['invalid_credentials'] = "Invalid username or password.";
                    header("Location: /login");
                    exit();
                }

                $user = $this->loginService->login($username, $password);

                if($user){
                    $_SESSION['user'] = [
                        'userId' => $user->id,
                        'role' => $user->role
                    ];

                    header("location: /");
                    exit();
                }
                else{
                    $_SESSION['invalid_credentials'] = "Invalid username or password";
                    header("Location: /login");
                    exit();
                }
            }
        }
        catch(Exception $e){
            echo "Something went wrong. " . htmlspecialchars($e->getMessage());
        }
    }

    public function logout(){
        try{
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            session_destroy();
            $_SESSION['confirm_logout'] = 'You have been logged out successfully.';
            header("Location: /");
            exit();
            }
        } 
        catch(Exception $e){
            echo "Error: " . htmlspecialchars($e->getMessage());
        }
    }

    public function showCreateAccount(){
        require __DIR__ . '/../Views/createaccount.php';
    }

    public function createAccount(){
        try{
         if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = new User();
            $user->firstname = trim($_POST['firstname'] ?? '');
            $user->lastname = trim($_POST['lastname'] ?? '');
            $user->username = trim($_POST['username'] ?? '');
            $user->email = trim($_POST['email'] ?? '');
            $user->password = $_POST['password'] ?? '';
            $confirmPassword = $_POST['confirmPassword'] ?? '';

            $this->loginService->createAccount($user, $confirmPassword);

            $_SESSION['account_created'] = "Account created Successfully.";
            header("Location: /login");
            exit();
            
         }
        }
        catch(Exception $e){
            $_SESSION['username_email_validate'] = $e->getMessage();
            require __DIR__ . '/../Views/createaccount.php';
        }
    }
}