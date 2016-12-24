<?php


namespace Inventori\App\CheckInventori\Managers\Assigners;

use Inventori\App\CheckInventori\CheckInventoriModel;

class FromRequest {
    
    protected $checkInventori;
    
    public function __construct($checkInventori) {
        $this->checkInventori = $checkInventori;
    }
    
    public function assign(\Illuminate\Http\Request $request) {
        
        $this->checkInventori->fill($request->only('id','reminder_id','keterangan', 'photos', 'inventori_id'));
        
        $this->checkInventori->nama_pic = \ParsedJwt::getByKey('name');

        return $this->checkInventori;
    }
    
}
