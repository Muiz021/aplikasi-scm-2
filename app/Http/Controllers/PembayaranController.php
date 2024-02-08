<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use GuzzleHttp\Client;
use App\Models\DataBarang;
use App\Models\Pembayaran;
use App\Models\BarangMasuk;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PemesananAdmin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use RealRashid\SweetAlert\Facades\Alert;

class PembayaranController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        if ($user->roles == 'admin') {
            $pemesanan_admin = PemesananAdmin::paginate(10);
        } else {
            $pemesanan_admin = PemesananAdmin::where('status', 'proses')->orWhere('status', 'selesai')->paginate(10);
        }
        return view('pages.pembayaran-admin.index', compact('pemesanan_admin'));
    }
    public function get_kode_pembayaran()
    {
        $latest_pembayaran = Pembayaran::latest('kode_pembayaran')->first();
        if ($latest_pembayaran) {
            $angkaData = intval(preg_replace('/[^0-9]/', '', $latest_pembayaran->kode_pembayaran));
            $kode_pembayaran = 'KPBA' . str_pad($angkaData + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $kode_pembayaran = 'KPBA001';
        }

        return response()->json(['kode_pembayaran' => $kode_pembayaran], 200);
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
            ]
        );

        $pemesanan_admin = PemesananAdmin::where('id', $request->pemesanan_admin_id)->first();
        $pemesanan_admin->update([
            'status' => 'proses'
        ]);

        $data = $request->all();

        $data['total'] = $pemesanan_admin->total;
        $data['nama'] = 'admin';
        $data['status'] = 'proses';

        $pembayaran = Pembayaran::create($data);

        // notifikasi whatsapps
        $client = new Client();
        $url = "http://47.250.13.56/message";

        $wa = $pemesanan_admin->supplier->nomor_ponsel;
        if ($pembayaran->metode_pembayaran == 'transfer') {
            $message = "Admin sedang memesan barang pada kamu dengan kode pemesanan " . $pemesanan_admin->kode_pemesanan . " dan menggunakan metode pembayaran " . $pembayaran->metode_pembayaran . " silahkan kirim nomor rekening kamu ke whatsapps admin(0813123123)";
        } else {
            $message = "Admin sedang memesan barang pada kamu dengan kode pemesanan " . $pemesanan_admin->kode_pemesanan . " dan menggunakan metode pembayaran " . $pembayaran->metode_pembayaran . " silahkan hubungi whatsapps admin(0813123123) untuk pembayaran yang lebih detail";
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

        $pembayaran = Pembayaran::findOrFail($id);
        $data_barang = DataBarang::where('id',$pembayaran->pemesanan_admin->data_barang->id)->first();
        if ($data_barang->stok_barang < $pembayaran->pemesanan_admin->jumlah) {
            Alert::error("Gagal", "Stok yang dimiliki supplier tidak cukup");
            return redirect()->back();
        }
        $data = $request->all();

        $gambar = $request->file('gambar');
        $penempatan_file = 'img/struk/';
        $baseURL = url('/');
        $nama_pembayaran = $baseURL . '/' . $penempatan_file . Str::slug($pembayaran->kode_pembayaran, '_') . '_' . Carbon::now()->format('YmdHis') . "." . $gambar->getClientOriginalExtension();
        $gambar->move(public_path($penempatan_file), $nama_pembayaran);

        $data['gambar'] = $nama_pembayaran;

        $pembayaran->update($data);

        $stok_barang_baru = $data_barang->stok_barang - $pembayaran->pemesanan_admin->jumlah;
        $data_barang->update([
            'stok_barang' => $stok_barang_baru
        ]);

        // notifikasi whatsapps
        $client = new Client();
        $url = "http://47.250.13.56/message";

        $wa = $pembayaran->pemesanan_admin->supplier->nomor_ponsel;
        $message = "Admin sudah mengirim bukti transaksi pembayaran silahkan *cek dan ubah status pembayaran*";


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

    public function update_status_pembayaran(Request $request, $id)
    {
        // mengambil pemesanan admin dan pembayaran
        $pemesanan_admin = PemesananAdmin::findOrFail($id);
        $pembayaran = Pembayaran::where('pemesanan_admin_id', $pemesanan_admin->id)->first();
        $data = $request->all();

        // memperbarui status pemesanan admin dan pembayaran
        $pemesanan_admin->update($data);
        $pembayaran->update($data);

        // membuat data barang masuk
        $item = [
            "supplier_id" => $pembayaran->pemesanan_admin->supplier->id,
            "data_barang_id" => $pembayaran->pemesanan_admin->data_barang->id,
            "kode_barang" => $pembayaran->pemesanan_admin->data_barang->kode_barang,
            "nama_barang" => $pembayaran->pemesanan_admin->data_barang->nama,
            "jenis_barang" => $pembayaran->pemesanan_admin->data_barang->jenis,
            "tanggal_masuk" => Carbon::now()->format('Y-m-d'),
            "jumlah" => $pembayaran->pemesanan_admin->jumlah,
            "status" => "perjalanan"
        ];
        BarangMasuk::create($item);


        // notifikasi whatsapps
        $client = new Client();
        $url = "http://47.250.13.56/message";

        $wa = "081343671284";
        if ($pembayaran->status == 'selesai') {
            $message = "*Supplier " . $pembayaran->pemesanan_admin->supplier->nama . "* sudah menerima pembayaran anda silahkan tunggu sampai barangnya sampai";
        } else {
            $message = "*Supplier " . $pembayaran->pemesanan_admin->supplier->nama . "* membatalkan pesanan anda";
        }

        $body = [
            'phoneNumber' => $wa,
            'message' => $message,
        ];

        $client->request('POST', $url, [
            'form_params' => $body,
            'verify'  => false,
        ]);


        Alert::success("Sukses", "berhasil memperbarui status pembayaran");
        return redirect()->back();
    }

    public function destroy($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->delete();

        Alert::success("Success", "Kamu berhasi menghapus struk pembayaran");
        return redirect()->back();
    }
}
