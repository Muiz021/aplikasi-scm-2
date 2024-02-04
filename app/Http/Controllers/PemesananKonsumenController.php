<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\PemesananKonsumen;
use App\Models\DataBarang;
use App\Models\PemesananKonsumenDetail;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Response;

class PemesananKonsumenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $barangMasuk = BarangMasuk::where('status', 'sampai')->get();
        return view('pages.order-konsumen.create', compact('barangMasuk'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // mengambil semua data
        $data = $request->all();
        $today = Carbon::now()->format('Y-m-d');
        $user = Auth::user();
        $konsumen = $user->konsumen->id;
        $data_barang = BarangMasuk::find($data['id']);

        $latest_pemesanan = PemesananKonsumen::latest('kode_pemesanan')->first();
        if ($latest_pemesanan) {
            $angkaData = intval(preg_replace('/[^0-9]/', '', $latest_pemesanan->kode_pemesanan));
            $kode_pemesanan = 'KPK' . str_pad($angkaData + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $kode_pemesanan = 'KPK001';
        }

        $total = $data['jumlah'] * $data_barang->data_barang->harga_barang;

        // validasi stok_barang apabila kosong
        if ($data_barang->jumlah == 0) {
            Alert::info("Peringatan", "stok barang tidak ada");
            return redirect()->back();
        } else {

            // membuat pemesanan admin
            PemesananKonsumen::create([
                'barang_masuk_id' => $data_barang->id,
                'nama_barang' => $data_barang->data_barang->harga_barang,
                'harga_barang' => $data_barang->data_barang->stok_barang,
                'waktu_pemesanan' => $today,
                'kode_pemesanan' => $kode_pemesanan,
                'jumlah' => $data['jumlah'],
                'konsumen_id' => $konsumen,
                'total' => $total
            ]);

            Alert::success("Sukses", "berhasil menambah pemesanan konsumen");
            return redirect()->route('pemesanan-barang-konsumen.index');
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pemesanan_konsumen = PemesananKonsumen::find($id);


        $pemesanan_konsumen->delete();

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

    public function get_pemesanan_konsumen()
    {
        $pemesanan_konsumen = PemesananKonsumen::get();
        $jumlah_pemesanan_konsumen = PemesananKonsumen::count();

        return Response::json(['jpa' => $jumlah_pemesanan_konsumen, 'pa' => $pemesanan_konsumen], 200);
    }
}
