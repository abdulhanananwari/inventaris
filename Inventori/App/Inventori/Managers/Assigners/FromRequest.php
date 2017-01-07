<?php

namespace Inventori\App\Inventori\Managers\Assigners;

use Inventori\App\Inventori\InventoriModel;

class FromRequest {
    
    protected $inventori;
    
    public function __construct($inventori) {
        $this->inventori = $inventori;
    }
    
    public function assign(\Illuminate\Http\Request $request) {
        
        $this->inventori->fill($request->only('id','nama','keterangan','kondisi','jumlah','id_lokasi','estimasi_biaya','jadwal_check_inventori','jadwal_maintenance_inventori','uuid','url_qrcode'));

        if ($request->has('rencana_tanggal_peremajaan')) {
        	$this->inventori->rencana_tanggal_peremajaan = $request->get('rencana_tanggal_peremajaan');
        }
        if ($request->has('tanggal_pembelian')) {
            $this->inventori->tanggal_pembelian = $request->get('tanggal_pembelian');
        }
        
         if ($request->has('pic')) {
           
            $this->inventori->pic = json_encode($request->get('pic'));
            
         }

        if ($request->has('photos')) {

            $this->inventori->photos = json_encode($request->get('photos'));
        }
       

        return $this->inventori;
    }
    
}
