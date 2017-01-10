<?php

namespace Inventori\Http\Controllers\Api;

use Solumax\PhpHelper\Http\Controllers\ApiBaseV1Controller as Controller;
use Illuminate\Http\Request;
use Inventori\App\Location\LocationModel;
use Inventori\App\Location\Transformers\LocationTransformer;

class LocationController extends Controller {

    //protected $location;

    public function __construct() {

        parent::__construct();
        $this->location = new \Inventori\App\Location\LocationModel();

        $this->transformer = new \Inventori\App\Location\Transformers\LocationTransformer();
        $this->dataName = 'locations';
    }

    public function index(Request $request) {

        $location = new \Inventori\App\Location\LocationModel();
        
        $query = $location->newQuery();

        if ($request->has('name')) {
            $query->where("name", "LIKE", "%" . $request->get('name') . "%");
        }

        $locations = $query->get();

        return $this->formatCollection($locations);
    }

    public function get($id, Request $request) {

        $location = $this->location->find($id);

        return $this->formatItem($location);
    }

    public function store(Request $request) {

        $location = $this->location->assign()->fromRequest($request);

        $validation = $location->validate()->onCreateOrUpdate();
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }

        $location->action()->onCreateOrUpdate();

        return $this->formatItem($location);
    }

    public function update($id, Request $request) {

        $location = $this->location->find($id);
        $location->assign()->fromRequest($request);

        $validation = $location->validate()->onCreateOrUpdate();
        if ($validation !== true) {
            return $this->formatErrors($validation);
        }

        $location->action()->onCreateOrUpdate();

        return $this->formatItem($location);
    }

}
