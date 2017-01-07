<?php

namespace Inventori\Http\Controllers\Api;

use Solumax\PhpHelper\Http\Controllers\ApiBaseV1Controller as Controller;
use Illuminate\Http\Request;
use Inventori\App\MaintenanceInventori\MaintenanceInventoriModel;
use Inventori\App\MaintenanceInventori\Transformers\MaintenanceInventoriTransformer;

class MaintenanceInventoriController extends Controller {
    

    public function __construct() {

        parent::__construct();
        $this->maintenance = new MaintenanceInventoriModel();
        
        $this->transformer = new MaintenanceInventoriTransformer();
        
        $this->dataName = 'maintenance_inventories';
    }
    
    public function index(Request $request) {
        
        $maintenance = new MaintenanceInventoriModel();

        $query = $maintenance->newQuery();

        if ($request->has('inventori_id')) {
            $query->where('inventori_id', $request->get("inventori_id"));
        }
        
        $maintenances = $query->paginate(5);
        
        return $this->formatCollection($maintenances, [], $maintenances);
    }
    
    public function get($id, Request $request) {
        
        $maintenance = $this->maintenance->find($id);

        return $this->formatItem($maintenance);
    }
    
    public function store(Request $request) {
        
        $maintenance = $this->maintenance->assign()->fromRequest($request);

         $validation = $maintenance->validate()->onCreate();
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }

        $maintenance->save();
        
        return $this->formatItem($maintenance);
    }
    
    public function update($id, Request $request) {
        
        $maintenance = $this->maintenance->find($id);
    
        $maintenance->assign()->fromRequest($request);
        
        $maintenance->save();
        
        return $this->formatItem($maintenance);
    }
}
