<?php

namespace Inventori\App\Inventori\Managers\Actioners;

use Inventori\App\Inventori\InventoriModel;

class OnCreateAndUpdate {

    protected $inventori;

    public function __construct(InventoriModel $inventori) {
        $this->inventori = $inventori;
    }

    public function action() {

    	$inventori = $this->inventori;

    	\DB::transaction function($inventori){

    	$inventori->save();
        \SolLog::write('Inventori', $inventori->id, 'Inventori save', $inventori->toArray());

    	}

       
    }

}
