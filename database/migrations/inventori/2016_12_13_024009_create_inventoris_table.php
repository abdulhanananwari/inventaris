<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventorisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventoris', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_inventaris');
            $table->string('keterangan');
            $table->string('kondisi');
            $table->date('rencana_tanggal_peremajaan')->nullable();
            $table->binary('photos')->nullable();
            $table->integer('jumlah');
            $table->integer('id_lokasi');
            $table->date('tanggal_pembelian')->nullable();
            $table->string('estimasi_biaya');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventoris');
    }
}
