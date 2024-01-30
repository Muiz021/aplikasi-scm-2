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
        Schema::create('barang_masuk', function (Blueprint $table) {
            $table->id();
            $table->string('kode_barang');
            $table->date('tanggal_masuk');
            $table->bigInteger('jumlah');
            $table->timestamps();
        });

        Schema::create('barang_keluar', function (Blueprint $table) {
            $table->id();
            $table->string('kode_barang');
            $table->date('tanggal_keluar');
            $table->bigInteger('jumlah');
            $table->unsignedBigInteger('konsumen_id')->nullable();
            $table->foreign('konsumen_id')->references('id')->on('konsumens')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('barang_masuk_id')->nullable();
            $table->foreign('barang_masuk_id')->references('id')->on('barang_masuk')->onDelete('cascade')->onUpdate('cascade');
            $table->enum('status', ['perjalanan', 'sampai'])->nullable();
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
        Schema::dropIfExists('barang_masuk');
        Schema::dropIfExists('barang_kelaur');
    }
};
