<?php

namespace Inventori\App\Inventori\Managers;

use Inventori\App\Inventori\InventoriModel;
use Solumax\PhpHelper\App\ManagerBase as Manager;

class Actioner extends Manager {

    protected $inventori;

    public function __construct(InventoriModel $inventori) {
        $this->inventori = $inventori;
    }

    public function __call($name, $arguments) {
        return $this->managerCaller($name, $arguments, $this->inventori, __NAMESPACE__, 'Actioners', 'action');
    }

}
