<?php

namespace App\Http\Controllers;

use App\Models\PembayaranKonsumen;
use App\Models\PemesananKonsumen;
use GuzzleHttp\Client;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class PembayaranKonsumenController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        if ($user->roles == 'konsumen') {
            $pemesanan_konsumen = pemesananKonsumen::where('status', 'proses')->orWhere('status', 'selesai')->paginate(10);
        } else {
            $pemesanan_konsumen = pemesananKonsumen::paginate(10);
        }
        return view('pages.pembayaran-konsumen.index', compact('pemesanan_konsumen'));
    }

    public function get_kode_pembayaran()
    {
        $pembayaran = PembayaranKonsumen::get();
        $jumlah_pembayaran = PembayaranKonsumen::count();

        return response()->json(['pembayaran' => $pembayaran, 'jp' => $jumlah_pembayaran], 200);
    }

    public function store(Request $request)
    {
        //validasi error
        $request->validate(
            [
                'metode_pembayaran' => 'required',

            ],
            [
                Alert::error("Gagal", "metode pembayaran tidak boleh kosong")

            ],

        );

        $pemesanan_konsumen = PemesananKonsumen::where('id', $request->pemesanan_konsumen_id)->first();
        $pemesanan_konsumen->update([
            'status' => 'proses'
        ]);

        $data = $request->all();

        $data['total'] = $pemesanan_konsumen->total;
        $data['nama'] = 'konsumen';
        $data['status'] = 'proses';
        $data['kode_pembayaran'] = $data['kode_bayar'];

        $pembayaran = PembayaranKonsumen::create($data);

        // notifikasi whatsapps
        $client = new Client();
        $url = "http://47.250.13.56/message";

        $wa = $pemesanan_konsumen->konsumen->nomor_ponsel;

        if ($pembayaran->metode_pembayaran == 'transfer') {
            $message = "Admin sedang memesan barang pada kamu dengan kode pemesanan " . $pemesanan_konsumen->kode_pemesanan . " dan menggunakan metode pembayaran " . $pembayaran->metode_pembayaran . ". Silahkan kirim nomor rekening kamu ke WhatsApp admin (0813123123)";
        } elseif ($pembayaran->metode_pembayaran == 'tunai') {
            $message = "Admin sedang memesan barang pada kamu dengan kode pemesanan " . $pemesanan_konsumen->kode_pemesanan . " dan menggunakan metode pembayaran " . $pembayaran->metode_pembayaran . ". Silahkan hubungi WhatsApp admin (0813123123) untuk pembayaran yang lebih detail";
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

    public function upload_struk_pembayaran(Request $request, $id)
    {
        $request->validate(
            [
                'gambar' => 'required',
            ],
            [
                Alert::error("Gagal", "gambar tidak boleh kosong")
            ]
        );

        $pembayaran = PembayaranKonsumen::findOrFail($id);
        $data = $request->all();

        $gambar = $request->file('gambar');
        $penempatan_file = 'img/struk/';
        $baseURL = url('/');
        $nama_pembayaran = $baseURL . '/' . $penempatan_file . Str::slug($pembayaran->kode_pembayaran, '_') . '_' . Carbon::now()->format('YmdHis') . "." . $gambar->getClientOriginalExtension();
        $gambar->move(public_path($penempatan_file), $nama_pembayaran);

        $data['gambar'] = $nama_pembayaran;

        $pembayaran->update($data);

        // notifikasi whatsapps
        $client = new Client();
        $url = "http://47.250.13.56/message";

        $admin = User::where('roles', 'admin')->first();

        $wa = $admin->nomor_ponsel;
        $message = "Konsumen sudah mengirim bukti transaksi pembayaran silahkan *cek dan ubah status pembayaran*";

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
}
