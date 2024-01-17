<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Pembayaran;
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
            $pemesanan_admin = PemesananAdmin::where('status', 'proses')->orWhere('status', 'selesai')->paginate(10);
        } else {
            $pemesanan_admin = PemesananAdmin::paginate(10);
        }
        return view('pages.pembayaran-admin.index', compact('pemesanan_admin'));
    }
    public function get_kode_pembayaran()
    {
        $pembayaran = Pembayaran::get();
        $jumlah_pembayaran = Pembayaran::count();

        return Response::json(['pembayaran' => $pembayaran, 'jp' => $jumlah_pembayaran], 200);
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
        $data['kode_pembayaran'] = $data['kode_bayar'];

        Pembayaran::create($data);

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
        $data = $request->all();

        $gambar = $request->file('gambar');
        $penempatan_file = 'img/struk/';
        $baseURL = url('/');
        $nama_pembayaran = $baseURL . '/' . $penempatan_file . Str::slug($pembayaran->kode_pembayaran, '_') . '_' . Carbon::now()->format('YmdHis') . "." . $gambar->getClientOriginalExtension();
        $gambar->move(public_path($penempatan_file), $nama_pembayaran);

        $data['gambar'] = $nama_pembayaran;

        $pembayaran->update($data);

        Alert::success("Sukses", "berhasil mengupload struk pembayaran");
        return redirect()->back();
    }

    public function update_status_pembayaran(Request $request, $id)
    {
        $pemesanan_admin = PemesananAdmin::findOrFail($id);
        $pembayaran = Pembayaran::where('pemesanan_admin_id', $pemesanan_admin->id)->first();
        $data = $request->all();

        $pemesanan_admin->update($data);
        $pembayaran->update($data);

        Alert::success("Sukses", "berhasil memperbarui status pembayaran");
        return redirect()->back();
    }
}
