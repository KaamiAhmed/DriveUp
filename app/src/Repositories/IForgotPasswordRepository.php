<?php
namespace App\Repositories;

interface IForgotPasswordRepository{
    public function getByEmail($email);
    public function setToken($userId, $token, $tokenExpiry);
    public function isTokenValid($token);
    public function resetPassword($token, $password);
    public function removeToken($token);
}
?>