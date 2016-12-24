<?php

namespace Inventori\App\Location\Managers\Assigners;

use Inventori\App\Location\LocationModel;

class FromRequest {
    
    protected $location;
    
    public function __construct($location) {
        $this->location = $location;
    }
    
    public function assign(\Illuminate\Http\Request $request) {
        
        $this->location->fill($request->only('id','name'));
        
        return $this->location;
    }
    
}
