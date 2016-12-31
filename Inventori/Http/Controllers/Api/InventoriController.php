<?php

namespace Inventori\Http\Controllers\Api;

use Solumax\PhpHelper\Http\Controllers\ApiBaseV1Controller as Controller;
use Illuminate\Http\Request;
use Inventori\App\Inventori\InventoriModel;
use Inventori\App\Inventori\Transformers\InventoriTransformer;

class InventoriController extends Controller {
    
    

    public function __construct() {

        parent::__construct();
        $this->inventori = new InventoriModel();
        
        $this->transformer = new  InventoriTransformer();
        $this->dataName = 'inventories';
    }
    
    public function index(Request $request) {
        
        $inventori = new InventoriModel();
        $query = $inventori->newQuery();
        
        if ($request->has('nama')) {
            $query->where("nama", "LIKE", "%" . $request->get('nama') . "%");
        }


        $inventoris = $query->paginate(20);
        

        return $this->formatCollection($inventoris, [], $inventoris);
    }
    
    public function get($id, Request $request) {
        
        $inventori = $this->inventori->find($id);
        
        return $this->formatItem($inventori);
    }
    
    public function store(Request $request) {

        $inventori = $this->inventori->assign()->fromRequest($request);

        $validation = $inventori->validate()->onCreate();
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }

        $inventori->save();

        return $this->formatItem($inventori);
    }
    
    public function update($id, Request $request) {
        
        $inventori = $this->inventori->find($id);
        $inventori->assign()->fromRequest($request);
        
        $inventori->save();
        
        return $this->formatItem($inventori);
    }

    public function destroy($id) {

        $inventori = $this->$inventori->find($id);

        $inventori->delete();

        return $this->formatItem($inventori);
    }
}
