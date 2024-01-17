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
        Schema::create('detail_pemesanan_admin', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('data_barang_id');
            $table->foreign('data_barang_id')->references('id')->on('data_barang')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('harga');
            $table->bigInteger('jumlah');
            $table->timestamps();
        });

        Schema::create('pemesanan_admin', function (Blueprint $table) {
            $table->id();
            $table->date('waktu_pemesanan');
            $table->bigInteger('total');
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
        Schema::dropIfExists('pemesanan_admin');
        Schema::dropIfExists('detail_pemesanan_admin');
    }
};
