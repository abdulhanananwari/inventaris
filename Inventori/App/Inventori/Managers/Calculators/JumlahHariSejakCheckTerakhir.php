<?php

namespace Inventori\App\Inventori\Managers\Calculators;

use Inventori\App\Inventori\InventoriModel;

/**
 *
 */
class JumlahHariSejakCheckTerakhir {

    protected $inventori;

    public function __construct(InventoriModel $inventori) {
        $this->inventori = $inventori;
    }

    public function calculate() {

        $pengecekanInventoriTerakhir = $this->inventori->checkInventori()
                        ->orderBy('created_at', 'desc')->first();

        if (empty($pengecekanInventoriTerakhir)) {
            return $this->inventori->created_at->diffInDays();
        }

        return $pengecekanInventoriTerakhir->created_at->diffInDays();
    }

}
