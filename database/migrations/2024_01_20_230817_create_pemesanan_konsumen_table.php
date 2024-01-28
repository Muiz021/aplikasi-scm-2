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
        Schema::create('pemesanan_konsumen', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('barang_masuk_id');
            $table->foreign('barang_masuk_id')->references('id')->on('barang_masuk')->onDelete('cascade')->onUpdate('cascade');
            $table->date('waktu_pemesanan');
            $table->bigInteger('jumlah');
            $table->bigInteger('total');
            $table->enum('status', ['selesai', 'proses', 'gagal'])->nullable();
            $table->unsignedBigInteger('konsumen_id')->nullable();
            $table->foreign('konsumen_id')->references('id')->on('konsumens')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('pemesanan_konsumen');
    }
};
