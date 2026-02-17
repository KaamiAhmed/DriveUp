<?php
namespace App\ViewModels;
use App\Models\DrivingLesson;
class LessonsViewModel{
    /**
    * @var DrivingLesson[]
    */
    public array $lessons;

    public function __construct(array $lessons){
        $this->lessons = $lessons;
    }
}
?>