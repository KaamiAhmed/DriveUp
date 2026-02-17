<?php
namespace App\ViewModels;
use App\Models\Package;
class PackagesViewModel{
    /**
    * @var Package[]
    */
    public array $packages;

    public function __construct(array $packages){
        $this->packages = $packages;
    }
}
?>