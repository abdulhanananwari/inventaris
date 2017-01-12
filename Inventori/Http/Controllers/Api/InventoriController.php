<?php

namespace Inventori\Http\Controllers\Api;

use Solumax\PhpHelper\Http\Controllers\ApiBaseV1Controller as Controller;
use Illuminate\Http\Request;
use Inventori\App\Inventori\InventoriModel;
use Inventori\App\Inventori\Transformers\InventoriTransformer;

class InventoriController extends Controller {

    protected $inventori;

    public function __construct() {

        parent::__construct();
        $this->inventori = new InventoriModel();

        $this->transformer = new InventoriTransformer();
        $this->dataName = 'inventories';
    }

    public function index(Request $request) {

        $inventori = new InventoriModel();
        $query = $inventori->newQuery();

        if ($request->has('nama')) {
            $query->where("nama", "LIKE", "%" . $request->get('nama') . "%");
        }
        
        if ($request->has('maintenance_pending')){
            
            $query
                    ->leftJoin(
                            \DB::raw('(SELECT inventori_id, created_at FROM maintenance_inventories GROUP BY inventori_id, created_at ORDER BY id DESC LIMIT 1) as last_maintenance_inventories'),
                            'inventories.id', '=', 'last_maintenance_inventories.inventori_id')
//                    ->where(function($q) {
//                        $q->where(\DB::raw('DATEDIFF(NOW(),maintenance_inventories.created_at)'), '>', 'inventories.jadwal_maintenance_inventori');
////                                ->or;
//                    })
//                    ->where(function($q) {
//                        
//                        $q->where(function($q) {
//                            $q->whereNotNull('last_maintenance_inventories.created_at')
//                                ->where(\DB::raw('DATEDIFF(NOW(),last_maintenance_inventories.created_at)'), '>', 'inventories.jadwal_maintenance_inventori');
//                        })
//                        ->orWhere(\DB::raw('DATEDIFF(NOW(),inventories.created_at)'), '>', 'inventories.jadwal_maintenance_inventori');
//                    })
                                ->where(\DB::raw('DATEDIFF(NOW(),last_maintenance_inventories.created_at)'), '>', 'inventories.jadwal_maintenance_inventori')
                      ->orWhere(function($q) {
                            $q->whereNull('last_maintenance_inventories.created_at')
                                    ->where(\DB::raw('DATEDIFF(NOW(),inventories.created_at)'), '>', 'inventories.jadwal_maintenance_inventori');
                    })
                    ->select('inventories.*');
                    
                    
                    
//                    ->join('maintenance_inventories', 'inventories.id', '=', 'maintenance_inventories.inventori_id')
//                    ->select('inventories.*')
//                    ->where(function($q) {
//                        
//                    });
//                    ->where('inventories.created_at', '>', ' maintenance_inventories.created_at');
        }
        
        
//        exit($query->toSql());


        $inventoris = $query->paginate(20);
        
//        $inventories = $query->get();

        return $this->formatCollection($inventoris, [], $inventoris);
    }

    public function generate($id, Request $request) {

        $inventori = $this->inventori->find($id);

        $inventori->action()->onGenerateUuidAndQrCode();


        return $this->formatItem($inventori);
    }

    public function get($id, Request $request) {
        
        $inventori = $this->inventori->find($id);

        return $this->formatItem($inventori);
    }

    public function store(Request $request) {

        $inventori = $this->inventori->assign()->fromRequest($request);

        $validation = $inventori->validate()->onCreateAndUpdate();
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }
        
        $inventori->action()->onCreateAndUpdate();
        $inventori->action()->onGenerateUuidAndQrCode();

        return $this->formatItem($inventori);
    }

    public function update($id, Request $request) {

        $inventori = $this->inventori->find($id);
        $inventori->assign()->fromRequest($request);

        $validation = $inventori->validate()->onCreateAndUpdate();
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }

        $inventori->action()->onCreateAndUpdate();

        return $this->formatItem($inventori);
    }

}
