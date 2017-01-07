<?php

namespace Inventori\App\Location\Managers\Validators;

use Inventori\App\Location\LocationModel;

class OnCreateOrUpdate {

    protected $location;

    public function __construct(LocationModel $location) {
        $this->location = $location;
    }

    public function validate() {

        $attributeValidation = $this->validateAttributes();
        if ($attributeValidation->fails()) {
            return $attributeValidation->errors()->all();
        }

        if (!$this->cekNamaMasihBelumDipakai()) {
            return ['Nama sudah dipakai'];
        }

        return true;
    }

    protected function validateAttributes() {

        return \Validator::make($this->location->toArray(), [
                    'name' => 'required',
        ]);
    }

    protected function cekNamaMasihBelumDipakai() {

        return LocationModel::where('name', $this->location->name)
                        ->where('id', '!=', $this->location->id)
                        ->count() == 0;
    }

}
