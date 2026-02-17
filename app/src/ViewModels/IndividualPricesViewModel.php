<?php
namespace App\ViewModels;
use App\Models\IndividualPrices;
class IndividualPricesViewModel{
    /**
    * @var IndividualPrices[]
    */
    public array $individualPrices;

    public function __construct(array $individualPrices){
        $this->individualPrices = $individualPrices;
    }
}
?>