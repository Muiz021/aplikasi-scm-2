<?php

namespace App\Http\Controllers;

use App\Models\JenisBarang;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class JenisBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jenis_barang = JenisBarang::paginate(10);
        return view('pages.jenis-barang.index',compact('jenis_barang'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        JenisBarang::create($data);

        Alert::success("Sukses", "berhasil menambahkan jenis barang");
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
        $data = $request->all();

        $jenis_barang = JenisBarang::find($id);
        $jenis_barang->update($data);

        Alert::success("Sukses", "berhasil mengedit jenis barang");
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
        $jenis_barang = JenisBarang::findOrFail($id);
        $jenis_barang->delete();

        Alert::success("Sukses", "berhasil menghapus jenis barang");
        return redirect()->back();
    }
}
