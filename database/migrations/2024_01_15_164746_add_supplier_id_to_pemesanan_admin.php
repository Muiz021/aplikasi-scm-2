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
        Schema::table('pemesanan_admin', function (Blueprint $table) {
            $table->dropForeign('pemesanan_admin_supplier_id_foreign');
        });
    }
};
