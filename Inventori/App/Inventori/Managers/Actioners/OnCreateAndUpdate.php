<?php

namespace Inventori\App\Inventori\Managers\Actioners;

use Inventori\App\Inventori\InventoriModel;

class OnCreateAndUpdate {

    protected $inventori;

    public function __construct(InventoriModel $inventori) {
        $this->inventori = $inventori;
    }

    public function action() {


    	\DB::transaction (function($inventori){

    	$this->inventori->save();
        \SolLog::write('Inventori', $this->inventori->id, 'Inventori save', $this->inventori->toArray());

    	});

       
    }

}
