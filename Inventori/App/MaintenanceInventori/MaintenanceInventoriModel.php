<?php

namespace Inventori\App\MaintenanceInventori;

use Solumax\PhpHelper\App\BaseModel as Model;

class MaintenanceInventoriModel extends Model {
    
    protected $table = 'maintenances';
    
    protected $guarded = ['created_at', 'updated_at'];

    protected $doNotSave = ['photos'];
    
    // Managers
    
    public function assign() {
        return new Managers\Assigner($this);
    }
    public function validate() {
    	return new Managers\Validator($this);
    }

    //Related

    
}

