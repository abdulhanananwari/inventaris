<?php

namespace Inventori\App\MaintenanceInventori\Managers\Validators;

use Inventori\App\MaintenanceInventori\MaintenanceInventoriModel;

class OnCreate{
    
    protected $inventori;
    
    public function __construct(MaintenanceInventoriModel $maintenance) {
        $this->maintenance = $maintenance;
    }
    

    public function validate() {
        
        $attributeValidation = $this->validateAttributes();
        if ($attributeValidation->fails()) {
          return $attributeValidation->errors()->all();
        }
        return true;
    }

    protected function validateAttributes() {

      return \Validator::make($this->maintenance->toArray(), [
       /* 'reminder_id' => 'required',*/
        "nama_maintenance" => 'required',
        'keterangan' => 'required',
        'biaya' => 'required'

        ]);

      // |unique:locations,name,' . $this->location->id

    }
}
