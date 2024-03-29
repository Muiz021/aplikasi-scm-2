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
        Schema::table('pemesanan_admin', function (Blueprint $table) {
            $table->unsignedBigInteger('data_barang_id')->after('supplier_id')->nullable();
            $table->foreign('data_barang_id')->references('id')->on('data_barang')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pemesanan_admin', function (Blueprint $table) {
            $table->dropForeign('pemesanan_admin_data_barang_id_foreign');
        });
    }
};
