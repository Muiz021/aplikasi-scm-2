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
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pemesanan_admin_id');
            $table->string('nama');
            $table->string('kode_pembayaran');
            $table->enum('metode_pembayaran', ['transfer', 'tunai']);
            $table->bigInteger('total');
            $table->date('tanggal');
            $table->foreign('pemesanan_admin_id')->references('id')->on('pemesanan_admin')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('pembayarans');
    }
};
