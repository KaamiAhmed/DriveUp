<?php
namespace App\Models;

class Package{
    public int $id;
    public string $title;
    public int $price;
    public string $type;
    public int $trial_lesson;
    public int $exam_included;
    public int $lesson_count;
    public int $interim_test;

}

?>