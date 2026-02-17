<?php
namespace App\Models;
use App\ViewModels\ResetPasswordViewModel;

class User{
    public int $id;
    public string $firstname;
    public string $lastname;
    public string $username;
    public string $password;
    public string $email;
    public string $role;
}

?>