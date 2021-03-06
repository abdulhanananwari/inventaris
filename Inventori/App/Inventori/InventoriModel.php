<?php

namespace Inventori\App\Inventori;

use Solumax\PhpHelper\App\BaseModel as Model;

class InventoriModel extends Model {

    protected $table = 'inventories';
    protected $guarded = ['created_at', 'updated_at'];

    // Managers

    public function assign() {
        return new Managers\Assigner($this);
    }

    public function validate() {
        return new Managers\Validator($this);
    }

    public function calculate() {
        return new Managers\Calculator($this);
    }

    public function action() {
        return new Managers\Actioner($this);
    }

    public function email() {
        return new Managers\Emailer($this);
    }

    // Related
    //eloquent ORM 
    //Relationships laravel

    public function checkInventori() {
        return $this->hasMany('Inventori\App\CheckInventori\CheckInventoriModel', 'inventori_id');
    }

    public function maintenanceInventori() {
        return $this->hasMany('Inventori\App\MaintenanceInventori\MaintenanceInventoriModel', 'inventori_id');
    }

    public function location() {
        return $this->belongsTo('Inventori\App\Location\LocationModel', 'id_lokasi');
    }

}
