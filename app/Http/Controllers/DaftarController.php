<?php

namespace App\Http\Controllers;

use App\Http\Requests\DaftarRequest;
use App\Models\Pelanggan;
use Illuminate\Support\Facades\Auth;

class DaftarController extends Controller
{
    public function create()
    {
        return view('auth.daftar');
    }

    public function store(DaftarRequest $request)
    {
        // Registrasi publik HANYA untuk pelanggan (tabel `pelanggan` sesuai ERD).
        // Password di-hash otomatis oleh cast 'hashed' pada model Pelanggan.
        // Data diri lengkap (KTP, medsos, disclaimer) diisi nanti sebelum bayar DP.
        $pelanggan = Pelanggan::create([
            'nama'     => $request->name,
            'email'    => $request->email,
            'no_telp'  => $request->phone,
            'password' => $request->password,
        ]);

        Auth::guard('pelanggan')->login($pelanggan);
        $request->session()->regenerate();

        return redirect()->intended('/')->with('success', 'Akun berhasil dibuat. Selamat datang di EventKu!');
    }
}