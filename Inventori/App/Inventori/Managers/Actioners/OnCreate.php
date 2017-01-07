<?php

namespace Inventori\App\Inventori\Managers\Actioners;

use Inventori\App\Inventori\InventoriModel;

class OnCreate {
    
    protected $inventori;
    
    public function __construct(InventoriModel $inventori) {
        $this->inventori = $inventori;
    }
    
    public function action() {

       include(base_path().'/phpqrcode/phpqrcode.php');

       $this->inventori->uuid = \Solumax\PhpHelper\Helpers\UuidGenerator::generate();

       $this->inventori->save();

        $x = storage_path($this->inventori->uuid . '.png');

         \QRcode::png($this->inventori->uuid, $x);

        $y = \SolFileManager::upload(fopen($x, 'r') ,$this->inventori->uuid . '.png', $this->inventori->id, 'qrcode');

        $url = $y->getFullUrl();

        fclose();

        $this->inventori->url_qrcode = $url;

        $this->inventori->save();
        
        return $url;

        }
}
