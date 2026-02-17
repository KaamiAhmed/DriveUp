<?php
namespace App\Services;

use App\Services\IPricesService;
use App\Repositories\IPricesRepository;
use App\Repositories\PricesRepository;
use App\Models\Package;
use Exception;

class PricesService implements IPricesService{
    private IPricesRepository $pricesRepository;

    public function __construct(){
        $this->pricesRepository = new PricesRepository();
    }

    public function getAllPackages(string $type)
    {
        return $this->pricesRepository->getAllPackages($type);
    }

    public function getIndividualPrices(){
        return $this->pricesRepository->getIndividualPrices();
    }
}

?>