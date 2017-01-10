<?php

namespace Inventori\App\CheckInventori\Managers\Validators;

use Inventori\App\CheckInventori\CheckInventoriModel;

class OnCreate {

    protected $checkInventori;

    public function __construct(CheckInventoriModel $checkInventori) {
        $this->checkInventori = $checkInventori;
    }

    public function validate() {

        $attributeValidation = $this->validateAttributes();
        if ($attributeValidation->fails()) {
            return $attributeValidation->errors()->all();
        }
        return true;
    }

    protected function validateAttributes() {

        return \Validator::make($this->checkInventori->toArray(), [
                    /* 'reminder_id' => 'required', */
                    'keterangan' => 'required',
        ]);

        // |unique:locations,name,' . $this->location->id
    }

}
