<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use App\Models\User;
use App\Models\DataBarang;
use App\Models\Pembayaran;
use App\Models\JenisBarang;
use App\Models\MerekBarang;
use Illuminate\Http\Request;
use App\Models\PemesananAdmin;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function admin_dashboard(){
        $user = Auth::user();
        $supplier = User::where('roles','supplier')->count();
        $konsumen = User::where('roles','konsumen')->count();
        $pemesanan_barang = PemesananAdmin::count();
        $jumlah_jenis_barang = JenisBarang::count();
        $jumlah_merek_barang = MerekBarang::count();
        $jumlah_data_barang = DataBarang::count();
        $jumlah_pembayaran_selesai = Pembayaran::where('status','selesai')->count();
        $jumlah_pembayaran_proses = Pembayaran::where('status','proses')->count();
        $jumlah_pembayaran_gagal = Pembayaran::where('status','gagal')->count();
        $jumlah_pembayaran_total = Pembayaran::count();
        $barang_masuk = BarangMasuk::count();

        return view('pages.dashboard.dashboard-admin',compact('barang_masuk','jumlah_pembayaran_total','jumlah_pembayaran_gagal','jumlah_pembayaran_proses','jumlah_pembayaran_selesai','jumlah_jenis_barang','jumlah_merek_barang','jumlah_data_barang','supplier','konsumen','pemesanan_barang','user'));
    }

    public function supplier_dashboard(){
        $user = Auth::user();
        $jumlah_jenis_barang = JenisBarang::count();
        $jumlah_merek_barang = MerekBarang::count();
        $jumlah_data_barang = DataBarang::count();

        return view('pages.dashboard.dashboard-supplier',compact('jumlah_jenis_barang','jumlah_merek_barang','jumlah_data_barang','user'));
    }

    public function konsumen_dashboard(){
        $user = Auth::user();

        return view('pages.dashboard.dashboard-konsumen',compact('user'));

    }
}
