<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCheckInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('check_inventories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('reminder_id')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('nama_pic');
            $table->binary('photos')->nullable();
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
        Schema::dropIfExists('check_inventories');
    }
}
