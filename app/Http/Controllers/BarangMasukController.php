<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class BarangMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barang_masuk = BarangMasuk::paginate(10);
        return view('pages.barang-masuk.index',compact('barang_masuk'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BarangMasuk  $barangMasuk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $barang_masuk = BarangMasuk::findOrFail($id);
        $data = $request->all();

        $barang_masuk->update($data);

        Alert::success("Sukses", "berhasil memperbarui status barang masuk");
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BarangMasuk  $barangMasuk
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $barang_masuk = BarangMasuk::findOrFail($id);
        $barang_masuk->delete();

        Alert::success("Sukses", "berhasil menghapus barang masuk");
        return redirect()->back();
    }
}
