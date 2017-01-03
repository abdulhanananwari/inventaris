<?php

namespace Inventori\App\CheckInventori;

use Solumax\PhpHelper\App\BaseModel as Model;

class CheckInventoriModel extends Model {
    
    protected $table = 'check_inventories';
    
    protected $guarded = ['created_at', 'updated_at'];

    protected $doNotSave = ['photos,reminder_id'];
    
    // Managers
    
    public function assign() {
        return new Managers\Assigner($this);
    }
    public function validate() {
        return new Managers\Validator($this);
    }
}
