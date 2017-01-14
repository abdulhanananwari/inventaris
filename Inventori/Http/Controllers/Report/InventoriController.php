<?php

namespace Inventori\Http\Controllers\Report;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

use Solumax\PhpHelper\Http\ControllerExtensions\CsvParseAndCreate;

class InventoriController extends Controller {
    
    use CsvParseAndCreate;
    
    public function __construct() {
        $this->inventori = new \Inventori\App\Inventori\InventoriModel();
    }
    
    public function index(Request $request) {
        
        $query = $this->inventori->newQuery();
        
        $query->leftJoin(\DB::raw('(SELECT t1.inventori_id, MAX(t1.created_at) AS last_maintenance_at FROM (SELECT * FROM maintenance_inventories ORDER BY id DESC) AS t1 GROUP BY t1.inventori_id) as last_maintenance_inventories'),
                            'inventories.id', '=', 'last_maintenance_inventories.inventori_id')
                ->leftJoin(\DB::raw('(SELECT t1.inventori_id, MAX(t1.created_at) AS last_check_inventori_at FROM (SELECT * FROM check_inventories ORDER BY id DESC) AS t1 GROUP BY t1.inventori_id) as last_check_inventories'),'inventories.id', '=', 'last_check_inventories.inventori_id');
                    
        $query->select('inventories.*', 'last_maintenance_inventories.*', 'last_check_inventories.*');
        
        $inventoris = $query->get();
        
        $inventoris->each(function($inventori) {
            $inventori->url = url('redirect-angular/inventori/' . $inventori->id);
        });
        
        return $this->createCsv($inventoris->toArray(), 'inventori');
    }
}
