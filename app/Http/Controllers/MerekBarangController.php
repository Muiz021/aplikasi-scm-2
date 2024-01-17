<?php

namespace App\Http\Controllers;

use App\Models\MerekBarang;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class MerekBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $merek_barang = MerekBarang::paginate(10);
        return view('pages.merek-barang.index',compact('merek_barang'));
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

        MerekBarang::create($data);

        Alert::success("Sukses", "berhasil menambahkan merek barang");
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
        $merek_barang = MerekBarang::findOrFail($id);
        $merek_barang->update($data);

        Alert::success("Sukses", "berhasil memperbarui merek barang");
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
        $merek_barang = MerekBarang::findOrFail($id);
        $merek_barang->delete();

        Alert::success("Sukses", "berhasil menghapus merek barang");
        return redirect()->back();
    }
}
