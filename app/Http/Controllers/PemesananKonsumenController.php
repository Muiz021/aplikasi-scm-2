<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\DataBarang;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;
use App\Models\PemesananKonsumen;
use App\Models\DataBarang;
use App\Models\PemesananKonsumenDetail;
use App\Models\User;
use Illuminate\Support\Facades\Response;
use RealRashid\SweetAlert\Facades\Alert;

class PemesananKonsumenController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        $konsumen = $user->konsumen->id;
        $pemesanan_konsumen =
            PemesananKonsumen::where('status', null)->where('konsumen_id', $konsumen)->paginate(10);
        return view('pages.order-konsumen.index', compact('pemesanan_konsumen'));
    }

    public function list_items()
    {

        $data_barang = BarangMasuk::all();

        return view('pages.order-konsumen.list-item', compact('data_barang'));
    }

    public function order($id)
    {
        $data_barang = BarangMasuk::find($id);
        return view('pages.order-konsumen.detail-item', compact('data_barang'));
    }

    public function create()
    {
        $barangMasuk = BarangMasuk::where('status', 'sampai')->where('jumlah','>','0')->get();
        return view('pages.order-konsumen.create', compact('barangMasuk'));
    }

    public function detail_item($id)
    {
        $barangMasuk = BarangMasuk::find($id);
        return view('pages.order-konsumen.detail-item',compact('barangMasuk'));
    }

    public function store(Request $request)
    {
        // mengambil semua data
        $data = $request->all();
        $barangMasuk = BarangMasuk::where('id', $request->id)->first();

        $today = Carbon::now()->format('Y-m-d');
        $user = Auth::user();
        $konsumen = $user->konsumen;
        $konsumen_id = $konsumen->id;

        // Validation rules
        $rules = [
            'barang_masuk_id' => 'required',
            'harga' => 'required|numeric',
            'nama_barang' => 'required',
            'jumlah' => 'required|numeric|min:1', // Make sure it's a positive number
            'kode_pesan' => 'required',
        ];

        // Custom error messages
        $messages = [
            'jumlah.min' => 'The quantity must be at least 1.',
        ];

        // Validate the request
        $request->validate($rules, $messages);

        // Check if the quantity is greater than available stock
        $stokBarang = BarangMasuk::find($data['barang_masuk_id'])->jumlah;
        if ($data['jumlah'] > $stokBarang) {
            return redirect()->back()->with('error', 'Error: Stok barang tidak cukup.')->withInput();
        }

        // Calculate total
        $total = $data['harga'] * $data['jumlah'];

        // Create the record
        PemesananKonsumen::create([
            'barang_masuk_id' => $data['barang_masuk_id'],
            'harga_barang' => $data['harga'],
            'nama_barang' => $data['nama_barang'],
            'konsumen_id' => $konsumen_id,
            'waktu_pemesanan' => $today,
            'kode_pemesanan' => $data['kode_pesan'],
            'jumlah' => $data['jumlah'],
            'total' => $total
        ]);

        return redirect()->route('pemesanan-barang-konsumen.index');
    }

    public function destroy($id)
    {
        $pemesanan_konsumen = PemesananKonsumen::find($id);
        $pemesanan_konsumen->delete();

        Alert::success("Success", "Kamu berhasi menghapus pesanan");
        return redirect()->back();
    }

    public function get_barang_masuk_per_id($id)
    {
        try {
            // Ambil informasi barang berdasarkan ID
            $data = BarangMasuk::findOrFail($id);
            $data_barang = DataBarang::where('id', $data->data_barang_id)->first();

            if (!$data) {
                return response()->json(['error' => 'Barang tidak ditemukan'], 404);
            }
            return Response::json(['data' => $data, 'data_barang' => $data_barang], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Terjadi kesalahan server'], 500);
        }
    }

}
