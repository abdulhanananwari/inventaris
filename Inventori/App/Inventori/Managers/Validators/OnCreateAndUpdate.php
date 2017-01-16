<?php

namespace Inventori\App\Inventori\Managers\Validators;

use Inventori\App\Inventori\InventoriModel;

class OnCreateAndUpdate {

    protected $inventori;

    public function __construct(InventoriModel $inventori) {
        $this->inventori = $inventori;
    }

    public function validate() {

        $attributeValidation = $this->validateAttributes();
        if ($attributeValidation->fails()) {
            return $attributeValidation->errors()->all();
        }

        return true;
    }

    protected function validateAttributes() {

        return \Validator::make($this->inventori->toArray(), [
                    'nama' => 'required',/*
                    "tanggal_pembelian" => 'required',*/
                    "jumlah" => 'required|numeric',
                    /*"estimasi_biaya" => 'required|numeric',*/
                    /*"id_lokasi" => 'required',*/
        ]);
    }

}
