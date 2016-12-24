<?php

namespace Inventori\App\Location;

use Solumax\PhpHelper\App\BaseModel as Model;

class LocationModel extends Model {
    
    protected $table = 'locations';
    
    protected $guarded = ['created_at', 'updated_at'];

  
    // Managers
    
    public function assign() {
        return new Managers\Assigner($this);
    }

    public function action() {
    	return new Managers\Actioner($this);
    }

    public function validate() {
        return new Managers\Validator($this);
    }
}
