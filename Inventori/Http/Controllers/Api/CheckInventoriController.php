<?php

namespace Inventori\Http\Controllers\Api;

use Solumax\PhpHelper\Http\Controllers\ApiBaseV1Controller as Controller;
use Illuminate\Http\Request;
use Inventori\App\CheckInventori\CheckInventoriModel;
use Inventori\App\CheckInventori\Transformers\CheckInventoriTransformer;

class CheckInventoriController extends Controller {
    
    protected $checkInventori;

    public function __construct() {

        parent::__construct();
        $this->checkInventori = new CheckInventoriModel();
        
        $this->transformer = new  CheckInventoriTransformer();
        $this->dataName = 'checkInventoris';
    }
    
    public function index(Request $request) {
        
        $query = $this->checkInventori->newQuery();

        if ($request->has('inventori_id')) {
            $query->where('inventori_id', $request->get("inventori_id"));
        }
        
       $checkInventoris = $query->paginate(5);
        
        return $this->formatCollection($checkInventoris, [],$checkInventoris);
    }
    
    public function get($id, Request $request) {
        
        $checkInventori = $this->checkInventori->find($id);
        
        return $this->formatItem($checkInventori);
    }
    
    public function store(Request $request) {

        $checkInventori = $this->checkInventori->assign()->fromRequest($request);

        $validation = $checkInventori->validate()->onCreate();
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }

        $checkInventori->save();

        return $this->formatItem($checkInventori);
    }
    
    public function update($id, Request $request) {
        
        $checkInventori = $this->checkInventori->find($id);
        $checkInventori->assign()->fromRequest($request);
        
        $checkInventori->save();
        
        return $this->formatItem($checkInventori);
    }
}
