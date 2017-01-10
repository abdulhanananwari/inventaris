<?php

namespace Inventori\App\MaintenanceInventori\Managers\Actioners;

use Inventori\App\MaintenanceInventori\MaintenanceInventoriModel;

class OnCreateOrUpdate {
    
    protected $maintenance;
    
    public function __construct(MaintenanceInventoriModel $maintenance) {
        $this->maintenance = $maintenance;
    }
    
    public function action() {

      $this->maintenance->save();
    }
}
