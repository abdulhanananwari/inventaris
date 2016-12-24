<?php

namespace Inventori\App\MaintenanceInventori\Managers;

use Inventori\App\MaintenanceInventori\MaintenanceInventoriModel;
use Solumax\PhpHelper\App\ManagerBase as Manager;

class Assigner extends Manager {
    
    protected $maintenance;
    
    public function __construct(MaintenanceInventoriModel $maintenance) {
        $this->maintenance = $maintenance;
    }
    
    public function __call($name, $arguments) {
        return $this->managerCaller($name, $arguments, $this->maintenance,
                __NAMESPACE__, 'Assigners', 'assign');
    }
}
