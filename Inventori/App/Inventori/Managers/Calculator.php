<?php

namespace Inventori\App\Inventori\Managers;

use Inventori\App\Inventori\InventoriModel;
use Solumax\PhpHelper\App\ManagerBase as Base;

class Calculator extends Base {
    
    protected $inventori;
    
    public function __construct(InventoriModel $inventori) {
        $this->inventori = $inventori;
    }
    
     public function __call($name, $arguments) {
        return $this->managerCaller($name, $arguments, $this->inventori,
                __NAMESPACE__, 'Calculators', 'calculate');
    }
  }

