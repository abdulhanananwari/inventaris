<?php

namespace Inventori\App\Location\Managers\Actioners;

use Inventori\App\Location\CheckInventoriModel;

class OnCreateOrUpdate {
    
    protected $checkInventori;
    
    public function __construct(CheckInventoriModel $checkInventori) {
        $this->checkInventori = $checkInventori;
    }
    
    public function action() {

      $this->checkInventori->save();
    }
}
