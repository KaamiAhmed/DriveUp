<?php
namespace App\Repositories;
use App\Models\Package;

interface IPricesRepository{
    public function getAllPackages(string $type);
    public function getIndividualPrices();
}

?>