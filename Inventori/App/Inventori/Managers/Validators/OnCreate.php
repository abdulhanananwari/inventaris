<?php

namespace Inventori\App\Inventori\Managers\Validators;

use Inventori\App\Inventori\InventoriModel;

class OnCreate{
    
    protected $inventori;
    
    public function __construct(InventoriModel $inventori) {
        $this->inventori = $inventori;
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

      return \Validator::make($this->inventori->toArray(), [
        'nama_inventaris' => 'required',
        "tanggal_pembelian" => 'required'

        ]);

      

    }

    protected function cekNamaMasihBelumDipakai() {

      return InventoriModel::where('nama_inventaris', $this->inventori->nama_inventaris)
        ->where('id', '!=', $this->inventori->id)
        ->count() == 0;

    }
    
}
