<?php

namespace Inventori\App\MaintenanceInventori\Transformers;

use Inventori\App\MaintenanceInventori\MaintenanceInventoriModel;

use League\Fractal;

class MaintenanceInventoriTransformer extends Fractal\TransformerAbstract {
    
    public function transform(MaintenanceInventoriModel $maintenance) {
        return [
            'id' => (int) $maintenance->id,
           /* 'reminder_id' => (string) $maintenance->reminder_id,*/
            'nama_maintenance' => (string) $maintenance->nama_maintenance,
            'keterangan' => (string) $maintenance->keterangan,
            'biaya' => (integer) $maintenance->biaya,
            'photos' => $maintenance->photos ? json_decode($maintenance->photos):[],
            'nama_pic' => (string)$maintenance->nama_pic,
            'inventori_id' =>(integer)$maintenance->inventori_id,
        ];
    }
}
