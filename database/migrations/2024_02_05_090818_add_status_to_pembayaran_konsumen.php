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
        Schema::table('pembayaran_konsumen', function (Blueprint $table) {
            $table->enum('status', ['selesai', 'proses','gagal'])->nullable()->after('gambar');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pembayaran_konsumen', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
