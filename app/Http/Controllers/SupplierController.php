<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supplier = User::where('roles','supplier')->paginate(10);
        return view('pages.supplier.index',compact('supplier'));
    }

    public function konfirmasi_supplier($id)
    {
        $supplier = User::findOrFail($id);
        $supplier->update([
            'status' => 1
        ]);

        Alert::success("Sukses", "kamu berhasil mengonfirmasi supplier");
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        // mengambil user berdasarkan id
        $user = User::findOrFail($id);

        // mengambil semua request
        $data = $request->all();

        $dataUser = [
            'username' => $data['username'],
        ];
        if ($request->filled('password')) {
            $dataUser['password'] = Hash::make($data['password']);
        }

        // update data user
        $user->update($dataUser);

        // mengambil data supplier berdasarkan id user
        $supplier = Supplier::where('user_id',$user->id)->first();
        // update data supplier
        $supplier->update([
            'nama' => $data['nama'],
            'email' => $data['email'],
            'nomor_ponsel' => $data['nomor_ponsel'],
            'alamat' => $data['alamat'],
        ]);

        // status setelah memperbarui profil
        if (Auth::user()->roles == 'admin') {
            Alert::success("Sukses", "kamu berhasil memperbarui supplier");
        }else{
            Alert::success("Sukses", "kamu berhasil memperbarui profil");
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supplier = User::findOrfail($id);
        $supplier->delete();

        Alert::success('Sukses', 'kamu berhasil menghapus supplier');
        return redirect()->back();
    }
}
