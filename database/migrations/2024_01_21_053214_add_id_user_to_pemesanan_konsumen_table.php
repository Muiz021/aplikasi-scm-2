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
        Schema::table('pemesanan_konsumen', function (Blueprint $table) {
            $table->string('id_user')->nullable()->default(false)->after('barang_masuk_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pemesanan_konsumen', function (Blueprint $table) {
            $table->dropColumn('kode_pemesanan');
        });
    }
};
