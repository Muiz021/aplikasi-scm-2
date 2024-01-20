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
        Schema::table('barang_masuk', function (Blueprint $table) {
            $table->unsignedBigInteger('supplier_id')->after('id')->nullable();
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::table('barang_masuk', function (Blueprint $table) {
            $table->dropForeign('barang_masuk_supplier_id_foreign');
            $table->dropForeign('barang_masuk_data_barang_id_foreign');
        });
    }
};
