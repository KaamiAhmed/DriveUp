<?php
namespace App\Services;
use App\Models\Package;

interface IPricesService{
    public function getAllPackages(string $type);
    public function getIndividualPrices();
}

?>