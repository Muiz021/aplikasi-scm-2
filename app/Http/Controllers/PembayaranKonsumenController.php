<?php

namespace App\Http\Controllers;

use App\Models\PembayaranKonsumen;
use App\Models\PemesananKonsumen;
use GuzzleHttp\Client;
use RealRashid\SweetAlert\Facades\Alert;

use Illuminate\Http\Request;

class PembayaranKonsumenController extends Controller
{

    public function get_kode_pembayaran()
    {
        $pembayaran = PembayaranKonsumen::get();
        $jumlah_pembayaran = PembayaranKonsumen::count();

        return response()->json(['pembayaran' => $pembayaran, 'jp' => $jumlah_pembayaran], 200);
    }

    public function store(Request $request)
    {
        //validasi error

        $data = $request->all();
        $request->validate(
            [
                'metode_pembayaran' => 'required',
            ],
            [
                Alert::error("Gagal", "metode pembayaran tidak boleh kosong")
            ]
        );

        $pemesanan_admin = PemesananKonsumen::where('id', $request->pemesanan_konsumen_id)->first();
        $pemesanan_admin->update([
            'status' => 'proses'
        ]);


        $data['total'] = $pemesanan_admin->total;
        $data['nama'] = 'admin';
        $data['status'] = 'proses';
        $data['kode_pembayaran'] = $data['kode_bayar'];

        $pembayaran = PembayaranKonsumen::create($data);

        // notifikasi whatsapps
        $client = new Client();
        $url = "http://47.250.13.56/message";

        $wa = $pemesanan_admin->supplier->nomor_ponsel;
        if ($pembayaran->metode_pembayaran == 'transfer') {
            $message = "Anda sedang memesan barang pada kamu dengan kode pemesanan " . $pemesanan_admin->kode_pemesanan . " dan menggunakan metode pembayaran" . $pembayaran->metode_pembayaran . " silahkan kirim nomor rekening kamu ke whatsapps admin(0813123123)";
        } else {
            $message = "Anda sedang memesan barang pada kamu dengan kode pemesanan " . $pemesanan_admin->kode_pemesanan . " dan menggunakan metode pembayaran" . $pembayaran->metode_pembayaran . " silahkan hubungi whatsapps admin(0813123123) untuk pembayaran yang lebih detail";
        }

        $body = [
            'phoneNumber' => $wa,
            'message' => $message,
        ];

        $client->request('POST', $url, [
            'form_params' => $body,
            'verify'  => false,
        ]);

        Alert::success("Sukses", "berhasil membuat struk pembayaran");
        return redirect()->back();
    }
}
