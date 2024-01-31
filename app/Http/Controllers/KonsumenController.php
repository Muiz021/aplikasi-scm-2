<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Konsumen;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class KonsumenController extends Controller
{
    public function index()
    {
        $konsumen = User::where('roles', 'konsumen')->paginate(10);

        return view('pages.konsumen.index', compact('konsumen'));
    }

    public function konfimasi_konsumen($id)
    {
        $konsumen = User::findOrFail($id);
        $konsumen->update([
            'status' => true
        ]);

        Alert::success("Sukses", "kamu berhasil mengonfirmasi konsumen");
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        // mengambil data berdasarkan id
        $user = User::find($id);
        $konsumen = Konsumen::where('user_id', $user->id)->first();

        $data = $request->all();
        if ($request->hasFile('gambar')) {
            // Check if $konsumen->gambar is not null before calling exists()
            if ($konsumen->gambar && file_exists($konsumen->gambar)) {
                unlink($konsumen->gambar);
            }

            $gambar = $request->file('gambar');
            $penempatan_file = 'img/profile/';
            $baseURL = url('/');
            $nama_konsumen = $baseURL . '/' . $penempatan_file . Str::slug($request->nama, '_') . '_' . Carbon::now()->format('YmdHis') . "." . $gambar->getClientOriginalExtension();
            $gambar->move(public_path($penempatan_file), $nama_konsumen);

            $data['gambar'] = $nama_konsumen;
            $konsumen->update($data);
        } else {
            $konsumen->update($data);
        }

        Alert::success('Sukses', 'kamu berhasil memperbarui konsumen');
        return redirect()->back();
    }

    public function destroy($id)
    {
        $konsumen = User::find($id);

        $baseURL = url('/');
        $file_path = Str::replace($baseURL . '/img/konsumen/', '', public_path() . '/img/konsumen/' . $konsumen->gambar);
        unlink($file_path);

        $konsumen->delete();

        Alert::success('Sukses', 'kamu berhasil menghapus konsumen');
        return redirect()->back();
    }
}
