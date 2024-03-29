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
            $table->unsignedBigInteger('supplier_id')->after('id')->nullable();
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade')->onUpdate('cascade');
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
        $table->dropForeign('data_barang_supplier_id_foreign');
        });
    }
};
