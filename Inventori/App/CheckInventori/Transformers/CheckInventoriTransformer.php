<?php

namespace Inventori\App\CheckInventori\Transformers;

use Inventori\App\CheckInventori\CheckInventoriModel;

use League\Fractal;

class CheckInventoriTransformer extends Fractal\TransformerAbstract {
    
    public function transform(CheckInventoriModel $checkInventori) {
        return [
            'id' => (int) $checkInventori->id,
           /* 'reminder_id' => (string) $checkInventori->reminder_id,*/
            'keterangan' => (string) $checkInventori->keterangan,
            'nama_pic' => (string)$checkInventori->nama_pic,
            'photos' => $checkInventori->photos ? json_decode($checkInventori->photos) : [],
            'inventori_id' => (integer) $checkInventori->inventori_id,
        ];
    }
}
