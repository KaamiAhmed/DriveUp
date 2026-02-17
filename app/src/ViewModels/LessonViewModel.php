<?php
namespace App\ViewModels;
use App\Models\DrivingLesson;
class LessonViewModel{
    /**
    * @var DrivingLesson
    */
    public $lesson;

    public function __construct($lesson){
        $this->lesson = $lesson;
    }
}
?>