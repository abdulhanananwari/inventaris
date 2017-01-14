<?php

namespace Inventori\App\Inventori\Managers\Actioners;

use Inventori\App\Inventori\InventoriModel;

class OnGenerateUuidAndQrCode {

    protected $inventori;

    public function __construct(InventoriModel $inventori) {
        $this->inventori = $inventori;
    }

    public function action() {
        
        $this->generateUuid();

        $file = $this->generateAndUploadQrCode();

        $this->inventori->url_qrcode = $file->getFullUrl();

        $this->inventori->save();
    }
    
    
    protected function generateUuid() {
        
        $this->inventori->uuid = \Solumax\PhpHelper\Helpers\UuidGenerator::generate();
    }
    
    protected function generateAndUploadQrCode() {
        
        include(base_path() . '/phpqrcode/phpqrcode.php');
        
        $qrCodeFile = storage_path($this->inventori->uuid . '.png');
        
        \QRcode::png($this->inventori->uuid, $qrCodeFile);
        
        $handle = fopen($qrCodeFile, 'r');

        $file = \SolFileManager::upload($handle,
                $this->inventori->uuid . '.png',
                $this->inventori->id,
                'qrcode',
                $this->inventori->id,
                null,
                $this->inventori);
        
        fclose($handle);
        unlink($qrCodeFile);
        
        return $file;
    }
}
