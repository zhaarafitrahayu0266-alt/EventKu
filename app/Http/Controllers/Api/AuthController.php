<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // 1. Validasi data yang dikirim dari Postman
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'no_whatsapp' => 'required|string|max:15',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // 2. Simpan data ke database
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'no_whatsapp' => $request->no_whatsapp,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        // 3. Berikan respons sukses
        return response()->json([
            'success' => true,
            'message' => 'Registrasi Berhasil',
            'data' => $user
        ], 201);
    }


    // Register Vendor
    public function registerVendor(Request $request)
    {
        // 1. Validasi Input
        $validator = Validator::make($request->all(), [
            'nama_usaha'      => 'required|string|max:255',
            'id_kategori'     => 'required',
            'deskripsi_usaha' => 'nullable|string',
            'kota'            => 'required|string|max:100',
            'no_telp'         => 'required|string|max:20',
            'alamat'          => 'required|string',
            'email'           => 'required|string|email|max:255|unique:vendor,email',
            'password'        => 'required|string|min:8|confirmed',
            'nama_bank'       => 'required|string|max:100',
            'no_rekening'     => 'required|string|max:50',
            'nama_rekening'   => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // 2. Simpan Data langsung ke tabel vendor
        $vendor = Vendor::create([
            'nama_vendor'        => $request->nama_usaha,
            'id_kategori'        => $request->id_kategori,
            'deskripsi'          => $request->deskripsi_usaha,
            'kota'               => $request->kota,
            'no_telp'            => $request->no_telp,
            'alamat'             => $request->alamat,
            'email'              => $request->email,
            'password'           => Hash::make($request->password),
            'nama_bank'          => $request->nama_bank,
            'no_rekening'        => $request->no_rekening,
            'atas_nama_rekening' => $request->nama_rekening,
            'status_aktif'       => true,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Registrasi Vendor Berhasil',
            'data'    => $vendor
        ], 201);
    }
}