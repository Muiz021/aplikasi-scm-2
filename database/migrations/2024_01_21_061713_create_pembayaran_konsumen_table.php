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
        Schema::create('pembayaran_konsumen', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pemesanan_konsumen_id');
            $table->foreign('pemesanan_konsumen_id')->references('id')->on('pemesanan_konsumen')->onDelete('cascade')->onUpdate('cascade');
            $table->string('nama');
            $table->string('kode_pembayaran');
            $table->enum('metode_pembayaran', ['transfer', 'tunai']);
            $table->bigInteger('total');
            $table->date('tanggal');
            $table->longtext('gambar');

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
        Schema::dropIfExists('pembayaran_konsumen');
    }
};
