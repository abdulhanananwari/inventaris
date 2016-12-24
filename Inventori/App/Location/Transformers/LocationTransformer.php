<?php

namespace Inventori\App\Location\Transformers;

use Inventori\App\Location\LocationModel;

use League\Fractal;

class LocationTransformer extends Fractal\TransformerAbstract {
    
    public function transform(LocationModel $location) {
        return [
            'id' => (int) $location->id,
            'name' => (string) $location->name,
        ];
    }
}
