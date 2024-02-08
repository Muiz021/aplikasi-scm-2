<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\DataBarang;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;
use App\Models\PemesananKonsumen;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use RealRashid\SweetAlert\Facades\Alert;

class PemesananKonsumenController extends Controller
{

    public function index()
    {
        $pemesanan_konsumen =
            PemesananKonsumen::where('status', null)->paginate(10);
        return view('pages.order-konsumen.index', compact('pemesanan_konsumen'));
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
        $data = $request->all();
        $barangMasuk = BarangMasuk::where('id', $request->id)->first();

        $today = Carbon::now()->format('Y-m-d');
        $user = Auth::user();
        $konsumen = $user->konsumen;
        $konsumen_id = $konsumen->id;

        // Check if 'jumlah' exists in $data
        if (!isset($data['jumlah'])) {
            return redirect()->back()->with('error', 'Error: Invalid quantity.')->withInput();
        }

        if ($data['jumlah'] > $barangMasuk->jumlah) {
            return redirect()->back()->with('error', 'Error: Insufficient stock.')->withInput();
        }

        // Calculate total
        $total =  $data['jumlah'] * $barangMasuk->data_barang->harga_barang;

        $latest_pemesanankonsumen = PemesananKonsumen::latest('kode_pemesanan')->first();
        if ($latest_pemesanankonsumen) {
            $angkaData = intval(preg_replace('/[^0-9]/', '', $latest_pemesanankonsumen->kode_konsumen));
            $kode_konsumen = 'KPK' . str_pad($angkaData + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $kode_konsumen = 'KPK001';
        }

        // Create the record
        PemesananKonsumen::create([
            'barang_masuk_id' => $barangMasuk->id,
            'harga_barang' => $barangMasuk->data_barang->harga_barang,
            'nama_barang' => $barangMasuk->data_barang->nama_barang,
            'konsumen_id' => $konsumen_id,
            'waktu_pemesanan' => $today,
            'kode_pemesanan' => $kode_konsumen,
            'jumlah' => $data['jumlah'],
            'total' => $total
        ]);

        Alert::success("Success", "Kamu berhasi membuat pesanan");
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
