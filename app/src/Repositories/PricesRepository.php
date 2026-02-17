<?php
namespace App\Repositories;

use App\Repositories\IPricesRepository;
use App\Models\Package;
use App\Framework\Repository;
use App\Models\IndividualPrices;
use Exception;
use PDO;

class PricesRepository extends Repository implements IPricesRepository{
    public function getAllPackages(string $type){
         try{
            $sql = 'SELECT * FROM Packages WHERE type = :type';
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->bindParam(':type', $type);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_CLASS, Package::class);
        }
        catch(Exception $e){
            echo "Error: " . $e->getMessage();
        }
    }

    public function getIndividualPrices(){
         try{
            $sql = 'SELECT * FROM IndividualPrices';
            $result = $this->getConnection()->query($sql);
            $packages = $result->fetchAll(PDO::FETCH_CLASS, IndividualPrices::class);
            return $packages;
        }
        catch(Exception $e){
            echo "Error: " . $e->getMessage();
        }
    }
}

?>