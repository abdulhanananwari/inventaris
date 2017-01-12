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
           $query->join('maintenance_inventories', 'inventories.id', '=', 'maintenance_inventories.inventori_id')
                    ->select('inventories.*',
                             'maintenance_inventories.created_at')
                    ->where('inventories.created_at', '>', ' maintenance_inventories.created_at')
                    ->orderBy('maintenance_inventories.created_at', 'desc')->first()
                    ->get();
        }
        


        $inventoris = $query->paginate(20);

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
