<?php

namespace App\Http\Controllers;

use App\Models\BarangKeluar;
use GuzzleHttp\Client;
use App\Models\User;
use App\Http\Requests\StoreBarangKeluarRequest;
use App\Http\Requests\UpdateBarangKeluarRequest;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BarangKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->roles == 'admin') {
            $barang = BarangKeluar::where('status', 'perjalanan')->orWhere('status', 'sampai')->paginate(10);
        } else {
            $barang = BarangKeluar::paginate(10);
        }
        return view('pages.barang-keluar.index', compact('barang'));
    }


    public function update_status(Request $request, $id)
    {
        $pembayaran = barangKeluar::findOrFail($id);
        $data = $request->all();

        $pembayaran->update($data);

        $client = new Client();
        $url = "http://47.250.13.56/message";

        $admin = User::where('roles', 'admin')->first();
        $wa = $admin->nomor_ponsel;
        $message = "pesanan konsumen telah sampai";


        $body = [
            'phoneNumber' => $wa,
            'message' => $message,
        ];

        $client->request('POST', $url, [
            'form_params' => $body,
            'verify'  => false,
        ]);


        Alert::success("Sukses", "berhasil mengupload struk pembayaran");
        return redirect()->back();
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBarangKeluarRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBarangKeluarRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BarangKeluar  $barangKeluar
     * @return \Illuminate\Http\Response
     */
    public function show(BarangKeluar $barangKeluar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BarangKeluar  $barangKeluar
     * @return \Illuminate\Http\Response
     */
    public function edit(BarangKeluar $barangKeluar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBarangKeluarRequest  $request
     * @param  \App\Models\BarangKeluar  $barangKeluar
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBarangKeluarRequest $request, BarangKeluar $barangKeluar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BarangKeluar  $barangKeluar
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $barang_keluar = barangkeluar::find($id);
        $barang_keluar->delete();
        return redirect()->back();
    }
}
