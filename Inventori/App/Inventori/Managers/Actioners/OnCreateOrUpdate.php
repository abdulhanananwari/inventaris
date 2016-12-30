<?php

namespace Inventori\App\Inventori\Managers\Actioners;

use Inventori\App\Inventori\InventoriModel;

class OnCreateOrUpdate {
    
    protected $inventori;
    
    public function __construct(InventoriModel $inventori) {
        $this->inventori = $inventori;
    }
    
    public function action() {
 

        if ($this->inventori->rencana_tanggal_peremajaan) {

        	$this->inventori->rencana_tanggal_peremajaan = $request->get('rencana_tanggal_peremajaan') \Carbon\Carbon::createFromFormat('Y-m-d', $this->inventori->rencana_tanggal_peremajaan));
        }
        if ($this->inventori->tanggal_pembelian) {

             $this->inventori->tanggal_pembelian = $request->get('tanggal_pembelian') Carbon\Carbon::createFromFormat('Y-m-d', $this->inventori->tanggal_pembelian);
        }
      $this->location->save();
    }
}