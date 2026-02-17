<?php
namespace App\Services;

interface IForgotPasswordService{
    public function forgotPassword($email);
    public function validateToken($token);
    public function resetPassword($token, $password);
}
?>