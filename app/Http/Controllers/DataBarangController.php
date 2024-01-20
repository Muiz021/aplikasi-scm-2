<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\DataBarang;
use App\Models\JenisBarang;
use App\Models\MerekBarang;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class DataBarangController extends Controller
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
        $user = Auth::user();
        if ($user->roles == 'supplier') {
            $data_barang = DataBarang::where('supplier_id', $user->supplier->id)->paginate(10);
        } else {
            $data_barang = DataBarang::paginate(10);
        }
        $total_barang = DataBarang::count();
        $jenis_barang = JenisBarang::get();
        $merek_barang = MerekBarang::get();

        // dd($data_barang);
        return view('pages.data-barang.index', compact('data_barang', 'total_barang', 'jenis_barang', 'merek_barang'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $data = $request->all();
        $data['supplier_id'] = $user->supplier->id;
        if ($request->foto_barang) {
            $foto_barang = $request->file('foto_barang');
            $penempatan_file = 'img/barang/';
            $baseURL = url('/');
            $nama_barang = $baseURL . "/" . $penempatan_file . Str::slug($request->nama_barang, '_') . "_" . Carbon::now()->format('YmdHis') . "." . $foto_barang->getClientOriginalExtension();
            $foto_barang->move(public_path($penempatan_file), $nama_barang);
            $data['foto_barang'] = $nama_barang;
        }

        DataBarang::create($data);

        Alert::success("Sukses", "berhasil menambah data barang");
        return redirect()->back();
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
        // mengambil data berdasarkan id
        $data_barang = DataBarang::find($id);

        $data = $request->all();

        if ($request->foto_barang) {
            $baseURL = url('/');
            $file_path = Str::replace($baseURL . '/img/barang/', '', public_path() . '/img/barang/' . $data_barang->foto_barang);
            if (file_exists($file_path)) {
                unlink($file_path);
            }

            $foto_barang = $request->file('foto_barang');
            $penempatan_file = 'img/barang/';
            $baseURL = url('/');
            $nama_barang = $baseURL . "/" . $penempatan_file . Str::slug($request->nama_barang, '_') . "_" . Carbon::now()->format('YmdHis') . "." . $foto_barang->getClientOriginalExtension();
            $foto_barang->move(public_path($penempatan_file), $nama_barang);

            $data['foto_barang'] = $nama_barang;
            $data_barang->update($data);
        }

        Alert::success("Sukses", "berhasil memperbarui data barang");
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // mengambil data berdasarkan id
        $data_barang = DataBarang::find($id);

        // hapus gambar pada path
        $baseURL = url('/');
        $file_path = Str::replace($baseURL . '/img/barang/', '', public_path() . '/img/barang/' . $data_barang->foto_barang);
        if (file_exists($file_path)) {
            unlink($file_path);
        }

        // delete data pada database
        $data_barang->delete();

        Alert::success("Sukses", "berhasil menghapus data barang");
        return redirect()->back();
    }

    public function getCount()
    {
        $data_barang = DataBarang::get();
        $countKodeBarang = DataBarang::count();

        return response()->json(['count' => $countKodeBarang, 'data' => $data_barang]);
    }
}
