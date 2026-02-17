<?php
namespace App\Models;

use DateTime;

class ResetPassword{
    public int $id;
    public int $userId;
    public string $token;
    public DateTime $tokenExpiry;
    public DateTime $createdAt;
}

?>