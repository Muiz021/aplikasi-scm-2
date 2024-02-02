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
            $table->longText('deskripsi')->nullable()->after('nama_barang');
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
            $table->dropColumn('deskripsi');
        });
    }
};
