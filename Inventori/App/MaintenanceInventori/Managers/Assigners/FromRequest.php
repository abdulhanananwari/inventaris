<?php

namespace Inventori\App\MaintenanceInventori\Managers\Assigners;

use Inventori\App\MaintenanceInventori\MaintenanceInventoriModel;

class FromRequest {
    
    protected $maintenance;
    
    public function __construct($maintenance) {
        $this->maintenance = $maintenance;
    }
    
    public function assign(\Illuminate\Http\Request $request) {
        
        $this->maintenance->fill($request->only('id','reminder_id','nama_maintenance','keterangan','biaya','photos','inventori_id'));
        
        $this->maintenance->nama_pic = \ParsedJwt::getByKey('name');

        return $this->maintenance;
    }
}
