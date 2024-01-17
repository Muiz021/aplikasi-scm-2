<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('data_barang', function (Blueprint $table) {
            $table->unsignedBigInteger('jenis_barang_id')->after('id');
            $table->unsignedBigInteger('merek_barang_id')->after('jenis_barang_id');
            $table->foreign('jenis_barang_id')->references('id')->on('jenis_barang')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('merek_barang_id')->references('id')->on('merek_barang')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('data_barang', function (Blueprint $table) {
            // 
        });
    }
};
