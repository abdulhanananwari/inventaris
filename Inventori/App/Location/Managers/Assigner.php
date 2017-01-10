<?php

namespace Inventori\App\Location\Managers;

use Inventori\App\Location\LocationModel;
use Solumax\PhpHelper\App\ManagerBase as Manager;

class Assigner extends Manager {

    protected $location;

    public function __construct(LocationModel $location) {
        $this->location = $location;
    }

    public function __call($name, $arguments) {
        return $this->managerCaller($name, $arguments, $this->location, __NAMESPACE__, 'Assigners', 'assign');
    }

}
