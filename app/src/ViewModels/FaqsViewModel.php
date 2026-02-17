<?php
namespace App\ViewModels;
use App\Models\Faq;
class FaqsViewModel{
    /**
    * @var Faq[]
    */
    public array $faqs;

    public function __construct(array $faqs){
        $this->faqs = $faqs;
    }
}
?>