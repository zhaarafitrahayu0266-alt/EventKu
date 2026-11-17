<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    private const GUARDS = ['pelanggan', 'vendor', 'admin'];

    public function create()
    {
        return view('masuk');
    }

    public function proses(Request $request)
    {
        $data = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
            'peran'    => ['required', 'in:pelanggan,vendor,admin'],
        ]);

        $peran = $data['peran'];

        // Tiap peran punya tabel dan guard sendiri, jadi akun pelanggan
        // otomatis tidak bisa masuk lewat tab Vendor atau Admin.
        $kredensial = ['email' => $data['email'], 'password' => $data['password']];

        if ($peran === 'vendor') {
            $kredensial['status_aktif'] = true;   // hanya vendor aktif
            $ingat = false;                       // tabel vendor tidak punya remember_token
        } else {
            $ingat = $request->boolean('ingat');
        }

        if (! Auth::guard($peran)->attempt($kredensial, $ingat)) {
            // Pesan sengaja sama, supaya tidak membocorkan akun mana yang ada
            return back()->withErrors(['email' => 'Email atau password salah.'])->onlyInput('email', 'peran');
        }

        // Pastikan hanya satu guard yang login pada satu waktu
        foreach (self::GUARDS as $guard) {
            if ($guard !== $peran) {
                Auth::guard($guard)->logout();
            }
        }

        $request->session()->regenerate();

        $tujuan = match ($peran) {
            'vendor' => route('vendor.pengajuan'),
            'admin'  => '/admin',
            default  => '/',
        };

        return redirect()->intended($tujuan);
    }

    public function keluar(Request $request)
    {
        foreach (self::GUARDS as $guard) {
            Auth::guard($guard)->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('masuk');
    }
}