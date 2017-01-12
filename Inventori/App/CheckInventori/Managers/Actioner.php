<?php

namespace Inventori\App\CheckInventori\Managers;

use Inventori\App\Inventori\CheckInventoriModel;
use Solumax\PhpHelper\App\ManagerBase as Manager;

class Actioner extends Manager {

    protected $checkInventori;

    public function __construct(CheckInventoriModel $checkInventori) {
        $this->checkInventori = $checkInventori;
    }

    public function __call($name, $arguments) {
        return $this->managerCaller($name, $arguments, $this->checkInventori, __NAMESPACE__, 'Actioners', 'action');
    }

}