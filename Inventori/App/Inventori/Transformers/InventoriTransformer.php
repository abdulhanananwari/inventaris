<?php

namespace Inventori\App\Inventori\Transformers;

use Inventori\App\Inventori\InventoriModel;


use League\Fractal;

class InventoriTransformer extends Fractal\TransformerAbstract {
    
    public function transform(InventoriModel $inventori) {
        return [
            'id' => (int) $inventori->id,
            'nama_inventaris' => (string) $inventori->nama_inventaris,
            'keterangan' => (string) $inventori->keterangan,
            'kondisi' => (string) $inventori->kondisi,
            'rencana_tanggal_peremajaan' => $inventori->rencana_tanggal_peremajaan,
            'photos' => (binary)$inventori->photos,
            'jumlah' => (integer) $inventori->jumlah,
            'id_lokasi' => (integer) $inventori->id_lokasi,
            'tanggal_pembelian' =>$inventori->tanggal_pembelian,
            'estimasi_biaya' => (string) $inventori->estimasi_biaya,
            'check_inventori' => (string) $inventori->check_inventori,
            'maintenance_inventori' => (string) $inventori->maintenance_inventori,
            

            'jumlah_hari_sejak_pengecekan_inventori_terakhir' => $inventori->calculate()->jumlahHariSejakCheckTerakhir(),//menghitung jumlah hari setelah dilakukan pengencekan barang inventaris terakhir

            'jumlah_hari_sejak_maintenance_inventori_terakhir' => $inventori->calculate()->jumlahHariSejakMaintenanceTerakhir(),
            //menghitung jumlah hari setelah dilakukan maintenance barang inventaris terakhir
            'pic' => $inventori->pic ? json_decode($inventori->pic, true):[],
        ];
    }
}
