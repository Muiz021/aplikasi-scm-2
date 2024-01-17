<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Konsumen;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public function login()
    {
        return view('pages.auth.login');
    }

    public function login_action(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            if (Auth::user()->roles === 'admin') {
                return redirect()->route('dashboard.admin');
            } else
            if (Auth::user()->roles === 'supplier' && Auth::user()->status == true) {
                return redirect()->route('dashboard.supplier');
            } else
            if (Auth::user()->roles === 'konsumen' && Auth::user()->status == true) {
                return redirect()->route('dashboard.konsumen');
            } else {
                Alert::info("Info", "silahkan tunggu konfirmasi dari admin");
                return redirect()->back();
            }
        } else {
            Alert::error("Gagal", "username atau password kamu salah");
            return redirect()->back();
        }
    }

    public function registrasi()
    {
        return view('pages.auth.registrasi');
    }

    public function registrasi_supplier()
    {
        return view('pages.auth.registrasi-supplier');
    }

    public function registrasi_user()
    {
        return view('pages.auth.registrasi-user');
    }

    public function kode_supplier()
    {
        $supplier = Supplier::get();
        $countSupplier = Supplier::count();

        return Response::json(['supplier' => $supplier, 'countSupplier' => $countSupplier], 200);
    }

    public function registrasi_action_pengguna(Request $request)
    {
        $data = $request->all();
        $data['roles'] = 'konsumen';

        $user = User::create([
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
            'roles' =>  $data['roles']
        ]);

        Konsumen::create([
            'user_id' => $user->id,
            'nama' => $data['nama'],
            'email' => $data['email'],
        ]);

        Alert::success("Sukses", "silahkan tunggu konfirmasi dari admin");
        return redirect()->route('login');
    }
    public function registrasi_action_supplier(Request $request)
    {
        $data = $request->all();
        $data['roles'] = 'supplier';

        $user = User::create([
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
            'roles' =>  $data['roles']
        ]);

        Supplier::create([
            'user_id' => $user->id,
            'kode_supplier' => $data['kode_supplier'],
            'nama' => $data['nama'],
            'email' => $data['email'],
        ]);

        Alert::success("Sukses", "silahkan tunggu konfirmasi dari admin");
        return redirect()->route('login');
    }

    public function registrasi_action()
    {
        //
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
