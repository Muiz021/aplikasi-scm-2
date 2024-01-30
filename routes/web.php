<?php

use App\Models\PemesananKonsumen;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\KonsumenController;

use App\Http\Controllers\SupplierController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataBarangController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\JenisBarangController;
use App\Http\Controllers\MerekBarangController;
use App\Http\Controllers\PemesananAdminController;
use App\Http\Controllers\PemesananKonsumenController;
use App\Http\Controllers\PembayaranKonsumenController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 * Auth
 */
Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/', [AuthController::class, 'login_action'])->name('login_action');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('registrasi', [AuthController::class, 'registrasi'])->name('registrasi');
Route::get('registrasi/supplier', [AuthController::class, 'registrasi_supplier'])->name('registrasi_supplier');
Route::get('registrasi/user', [AuthController::class, 'registrasi_user'])->name('registrasi_user');
route::get('kode_supplier', [AuthController::class, 'kode_supplier'])->name('kode_supplier');
Route::post('registrasi/supplier', [AuthController::class, 'registrasi_action_supplier'])->name('registrasi_action_supplier');
Route::post('registrasi/user', [AuthController::class, 'registrasi_action_pengguna'])->name('registrasi_action_pengguna');

/**
 * Admin
 */
Route::prefix('admin')->middleware(['auth', 'OnlyAdmin'])->group(function () {
    // dashboard
    Route::get('dashboard', [DashboardController::class, 'admin_dashboard'])->name('dashboard.admin');

    Route::prefix('pengguna')->group(function () {
        // konsumen
        Route::resource('konsumen', KonsumenController::class)->except('create', 'edit', 'show');
        Route::put('konfirmasi-konsumen/{id}', [KonsumenController::class, 'konfimasi_konsumen'])->name('konfimasi_konsumen');

        // supplier
        Route::resource('supplier', SupplierController::class)->except('create', 'store', 'edit', 'show');
        Route::put('konfirmasi-supplier/{id}', [SupplierController::class, 'konfirmasi_supplier'])->name('konfirmasi_supplier');
    });

    // data transaksi
    Route::prefix('data-transaksi')->group(function () {
        // pemesanan barang ke supplier
        Route::resource('pemesanan-barang', PemesananAdminController::class);
        Route::get('get_supplier_data_barang', [PemesananAdminController::class, 'get_supplier_data_barang'])->name('get_supplier_data_barang');
        Route::get('get_pemesanan_admin', [PemesananAdminController::class, 'get_pemesanan_admin'])->name('get_pemesanan_admin');

        // detail pemesanan barang ke supplier
        Route::get('data-barang/{id}', [PemesananAdminController::class, 'get_data_barang_per_id'])->name('pemesanan_barang.get_per_id');
        Route::post('store-data-barang', [PemesananAdminController::class, 'store_detail_pemesanan'])->name('detail_pemesanan_barang.store');
        Route::delete('delete-data-barang/{id}', [PemesananAdminController::class, 'destroy_detail_pemesanan'])->name('destroy_detail_pemesanan');

        // barang masuk
        Route::resource('barang_masuk', BarangMasukController::class)->except('create','store', 'edit', 'show');
        // pembayaran
        Route::resource('pembayaran', PembayaranController::class);
        Route::get('get_kode_pembayaran', [PembayaranController::class, 'get_kode_pembayaran'])->name('get_kode_pembayaran');
        Route::put('upload_struk_pembayaran/{id}', [PembayaranController::class, 'upload_struk_pembayaran'])->name('upload_struk_pembayaran');
    });

    Route::prefix('master')->group(function () {
        // jenis barang
        Route::resource('/jenis_barang', JenisBarangController::class)->except('create', 'store', 'update', 'destroy', 'edit', 'show')->names(
            [
                'index' => 'admin.jenis_barang.index',
                'show' => 'admin.jenis_barang.show',
            ]
        );

        // merek barang
        Route::resource('/merek_barang', MerekBarangController::class)->except('create', 'store', 'update', 'destroy', 'edit', 'show')->names(
            [
                'index' => 'admin.merek_barang.index',
                'show' => 'admin.merek_barang.show',
            ]
        );

        // data barang
        Route::resource('data_barang', DataBarangController::class)->except('create', 'store', 'update', 'destroy', 'edit', 'show')->names(
            [
                'index' => 'admin.data_barang.index',
                'show' => 'admin.data_barang.show',
            ]
        );
    });
});

/**
 * Supplier
 */
Route::prefix('supplier')->middleware(['auth', 'OnlySupplier'])->group(function () {
    // dashboard
    Route::get('dashboard', [DashboardController::class, 'supplier_dashboard'])->name('dashboard.supplier');
    Route::put('profil/{id}', [SupplierController::class, 'update'])->name('profil-supplier.update');


    // jenis barang
    Route::resource('/jenis_barang', JenisBarangController::class)->except('create', 'edit', 'show');

    // merek barang
    Route::resource('/merek_barang', MerekBarangController::class)->except('create', 'edit', 'show');

    // data barang
    Route::resource('data_barang', DataBarangController::class)->except('create', 'edit', 'show');
    Route::get('get-count', [DataBarangController::class, 'getCount']);

    // pembayaran
    Route::get('pembayaran', [PembayaranController::class, 'index'])->name('admin.pembayaran.index');
    Route::put('update_status_pembayaran/{id}', [PembayaranController::class, 'update_status_pembayaran'])->name('update_status_pembayaran');
});

/**
 * Konsumen
 */

Route::prefix('konsumen')->middleware(['auth', 'OnlyKosumen'])->group(function () {
    // dashboard
    Route::put('profil/{id}', [KonsumenController::class, 'update'])->name('profil-konsumen.update');

    Route::get('dashboard', [DashboardController::class, 'konsumen_dashboard'])->name('dashboard.konsumen');

    Route::prefix('data-transaksi')->group(function () {
        Route::resource('pemesanan-barang-konsumen', PemesananKonsumenController::class);

        // Perbaikan nama route dan controller method
        Route::get('get_barang_masuk_by_supplier', [PemesananKonsumenController::class, 'get_barang_masuk_by_supplier'])->name('get_barang_masuk_by_supplier');

        Route::get('get_pemesanan_konsumen', [PemesananKonsumenController::class, 'get_pemesanan_konsumen'])->name('get_pemesanan_konsumen');

        Route::get('get_barang_masuk', [PemesananKonsumenController::class, 'getBarangMasuk'])->name('get_barang_masuk');
        Route::get('barang-masuk/{id}', [PemesananKonsumenController::class, 'get_barang_masuk_per_id']);

        Route::resource('pembayaran-konsumen', PembayaranKonsumenController::class);
        Route::get('get_kode_pembayaran', [PembayaranKonsumenController::class, 'get_kode_pembayaran'])->name('konsumen.get_kode_pembayaran');
        Route::put('upload_struk_pembayaran/{id}', [PembayaranKonsumenController::class, 'upload_struk_pembayaran'])->name('konsumen.upload_struk_pembayaran');
    });
});
