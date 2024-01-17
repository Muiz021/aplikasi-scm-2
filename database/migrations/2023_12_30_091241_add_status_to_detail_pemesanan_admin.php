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
        Schema::table('detail_pemesanan_admin', function (Blueprint $table) {
            $table->enum('status', ['pending', 'proses','selesai'])->after('jumlah')->nullable();
            $table->unsignedBigInteger('pemesanan_admin_id');
            $table->foreign('pemesanan_admin_id')->references('id')->on('pemesanan_admin')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('detail_pemesanan_admin', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
