<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama');
            $table->string('keterangan')->nullable();
            $table->string('kondisi');
            $table->date('rencana_tanggal_peremajaan')->nullable();
            $table->binary('photos')->nullable();
            $table->integer('jumlah')->unsigned()->nullable()->default(1);
            $table->integer('id_lokasi')->unsigned()->nullable();
            $table->date('tanggal_pembelian')->nullable();
            $table->integer('estimasi_biaya')->unsigned()->nullable();
            $table->binary('pic')->nullable();
            $table->string('keterangan_check')->nullable();
            $table->string('keterangan_maintenance')->nullable();
            $table->integer('jadwal_check_inventori')->unsigned()->nullable();
            $table->integer('jadwal_maintenance_inventori')->unsigned()->nullable();
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
        Schema::dropIfExists('inventories');
    }
}
