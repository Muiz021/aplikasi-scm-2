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
        $pemesanan_konsumen =
            PemesananKonsumen::where('status', null)->paginate(10);
        return view('pages.order-konsumen.index', compact('pemesanan_konsumen'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $barangMasuk = BarangMasuk::get();
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
        $total = $data['harga'] * $data['jumlah'];

        $user_id = Auth::user()->id;
        // membuat pemesanan admin
        $pemesanan_admin = PemesananKonsumen::create([
            'barang_masuk_id' => $data['barang_masuk_id'],
            'harga_barang' => $data['harga'],
            'nama_barang' => $data['nama_barang'],
            'id_user' => $user_id,
            'waktu_pemesanan' => $today,
            'kode_pemesanan' => $data['kode_pesan'],
            'jumlah' => $data['jumlah'],
            'total' => $total
        ]);

        return redirect()->route('pemesanan-barang-konsumen.index');
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
        //
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

    public function getBarangMasuk()
    {
        try {
            // Ambil data barang masuk yang tersedia
            $barangMasuk = BarangMasuk::all();
            return response()->json($barangMasuk, 200);
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
