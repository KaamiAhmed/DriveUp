<?php

namespace App\Models;

use DateTime;

class DrivingLesson
{
    public int $id;
    public int $student_id;
    public string $lesson_date;
    public string $start_time;
    public int $duration_minutes;
    public string $created_at;
    public string $updated_at;
    public string $firstname;
    public string $lastname;
}

?>