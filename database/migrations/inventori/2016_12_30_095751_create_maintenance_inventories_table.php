<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaintenanceInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maintenance_inventories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('reminder_id');
            $table->string('nama_maintenance');
            $table->string('keterangan')->nullable();
            $table->string('biaya');
            $table->binary('photos')->nullable();
            $table->string('nama_pic');
            $table->integer('inventori_id')->unsigned();
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
        Schema::dropIfExists('maintenance_inventories');
    }
}
