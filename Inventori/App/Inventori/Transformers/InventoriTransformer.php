<?php

namespace Inventori\App\Inventori\Transformers;

use Inventori\App\Inventori\InventoriModel;


use League\Fractal;

class InventoriTransformer extends Fractal\TransformerAbstract {
    
    public function transform(InventoriModel $inventori) {
        return [
            'id' => (int) $inventori->id,
            'nama' => (string) $inventori->nama,
            'keterangan' => (string) $inventori->keterangan,
            'kondisi' => (string) $inventori->kondisi,
            'rencana_tanggal_peremajaan' => $inventori->rencana_tanggal_peremajaan,
            'photos' => $inventori->photos ? json_decode($inventori->photos):[],
            'jumlah' => (integer) $inventori->jumlah,
            'id_lokasi' => (integer) $inventori->id_lokasi,
            'nama_lokasi' => $inventori->id_lokasi ? $inventori->location->name : null,
            'tanggal_pembelian' =>$inventori->tanggal_pembelian,
            'estimasi_biaya' => (integer) $inventori->estimasi_biaya,
            'jadwal_check_inventori' => $inventori->jadwal_check_inventori ? (int) $inventori->jadwal_check_inventori : NULL,
            'jadwal_maintenance_inventori' =>  $inventori->jadwal_maintenance_inventori ? (int) $inventori->jadwal_maintenance_inventori : NULL,

            'jumlah_hari_sejak_pengecekan_inventori_terakhir' => $inventori->calculate()->jumlahHariSejakCheckTerakhir(),//menghitung jumlah hari setelah dilakukan pengencekan barang inventaris terakhir

            'jumlah_hari_sejak_maintenance_inventori_terakhir' => $inventori->calculate()->jumlahHariSejakMaintenanceTerakhir(),
            //menghitung jumlah hari setelah dilakukan maintenance barang inventaris terakhir
            'pic' => $inventori->pic ? json_decode($inventori->pic, true):[],
            'uuid' => $inventori->uuid,
            'url_qrcode' => $inventori->url_qrcode,
        ];
    }
}
