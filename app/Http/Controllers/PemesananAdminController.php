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

    public function index()
    {
        $pemesanan_admin = PemesananAdmin::where('status', null)->paginate(10);
        return view('pages.order-admin.index', compact('pemesanan_admin'));
    }

    public function create()
    {
        $supplier = Supplier::paginate(10);
        return view('pages.order-admin.create', compact('supplier'));
    }

    public function list_items($id)
    {
        $supplier = Supplier::find($id);
        $data_barang = DataBarang::where('supplier_id', $supplier->id)->get();

        return view('pages.order-admin.list-item', compact('data_barang'));
    }

    public function order($id)
    {
        $data_barang = DataBarang::find($id);
        return view('pages.order-admin.detail-item', compact('data_barang'));
    }

    public function store(Request $request)
    {
        // mengambil semua data
        $data = $request->all();
        $today = Carbon::now()->format('Y-m-d');

        $data_barang = DataBarang::find($data['id']);

        $latest_pemesanan = PemesananAdmin::latest('kode_pemesanan')->first();
        if ($latest_pemesanan) {
            $angkaData = intval(preg_replace('/[^0-9]/', '', $latest_pemesanan->kode_pemesanan));
            $kode_pemesanan = 'KPA' . str_pad($angkaData + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $kode_pemesanan = 'KPA001';
        }

        $total = $data['jumlah'] * $data_barang->harga_barang;

        // validasi stok_barang apabila kosong
        if ($data_barang->stok_barang == 0) {
            Alert::info("Peringatan", "stok barang tidak ada");
            return redirect()->back();
        } else {

            // membuat pemesanan admin
            PemesananAdmin::create([
                'supplier_id' => $data_barang->supplier_id,
                'data_barang_id' => $data_barang->id,
                'waktu_pemesanan' => $today,
                'kode_pemesanan' => $kode_pemesanan,
                'jumlah' => $data['jumlah'],
                'total' => $total
            ]);

            Alert::success("Sukses", "berhasil menambah pemesanan admin");
            return redirect()->route('pemesanan-barang.index');
        }
    }

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
}
