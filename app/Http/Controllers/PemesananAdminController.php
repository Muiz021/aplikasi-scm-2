<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Supplier;
use App\Models\DataBarang;
use Illuminate\Http\Request;
use App\Models\PemesananAdmin;
use Illuminate\Support\Facades\Response;
use RealRashid\SweetAlert\Facades\Alert;

class PemesananAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pemesanan_admin = PemesananAdmin::where('status', null)->paginate(10);
        return view('pages.order-admin.index', compact('pemesanan_admin'));
    }

    public function create()
    {
        $supplier = Supplier::get();
        return view('pages.order-admin.create', compact('supplier'));
    }

    public function store(Request $request)
    {
         // mengambil semua data
         $data = $request->all();
         $today = Carbon::now()->format('Y-m-d');
         $total = $data['harga'] * $data['jumlah'];
         
        // validasi stok_barang apabila kosong
        if($data['stok_barang'] == 0){
        Alert::info("Peringatan", "stok barang tidak ada");
        return redirect()->back();
        }

        // membuat pemesanan admin
        PemesananAdmin::create([
            'supplier_id' => $data['supplier_id'],
            'data_barang_id' => $data['data_barang_id'],
            'waktu_pemesanan' => $today,
            'kode_pemesanan' => $data['kode_pesan'],
            'jumlah' => $data['jumlah'],
            'total' => $total
        ]);

        Alert::success("Sukses", "berhasil menambah pemesanan admin");
        return redirect()->route('pemesanan-barang.index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PemesananAdmin  $pemesananAdmin
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pemesanan_admin = PemesananAdmin::find($id);
        $pemesanan_admin->delete();

        Alert::success("Sukses", "berhasil menghapus pemesanan admin");
        return redirect()->back();
    }

    public function get_supplier_data_barang(Request $request)
    {
        try {
            $supplier_id = $request->supplier_id;
            // Ambil informasi barang berdasarkan ID
            $data = DataBarang::where('supplier_id', $supplier_id)->get();

            if (!$data) {
                return response()->json(['error' => 'Barang tidak ditemukan'], 404);
            }
            return Response::json($data, 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Terjadi kesalahan server'], 500);
        }
    }

    public function get_data_barang_per_id($id)
    {
        try {
            // Ambil informasi barang berdasarkan ID
            $data = DataBarang::findOrFail($id);

            if (!$data) {
                return response()->json(['error' => 'Barang tidak ditemukan'], 404);
            }
            return Response::json($data, 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Terjadi kesalahan server'], 500);
        }
    }

    public function get_pemesanan_admin()
    {
        $pemesanan_admin = PemesananAdmin::get();
        $jumlah_pemesanan_admin = PemesananAdmin::count();

        return Response::json(['jpa' => $jumlah_pemesanan_admin, 'pa' => $pemesanan_admin], 200);
    }
}
