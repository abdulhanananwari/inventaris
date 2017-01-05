<?php

namespace Inventori\App\MaintenanceInventori\Managers\Assigners;

use Inventori\App\MaintenanceInventori\MaintenanceInventoriModel;

class FromRequest {
    
    protected $maintenance;
    
    public function __construct($maintenance) {
        $this->maintenance = $maintenance;
    }
    
    public function assign(\Illuminate\Http\Request $request) {
        
        $this->maintenance->fill($request->only('id','reminder_id','nama_maintenance','keterangan','biaya','inventori_id'));
        
        $this->maintenance->nama_pic = \ParsedJwt::getByKey('name');
        
         if ($request->has('photos')) {

            $this->maintenance->photos = json_encode($request->get('photos'));
        }

        return $this->maintenance;
    }
}
