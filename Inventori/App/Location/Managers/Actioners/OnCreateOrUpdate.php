<?php

namespace Inventori\App\Location\Managers\Actioners;

use Inventori\App\Location\LocationModel;

class OnCreateOrUpdate {

    protected $location;

    public function __construct(LocationModel $location) {
        $this->location = $location;
    }

    public function action() {

        $this->location->save();
    }

}
