<?php

namespace Database\Seeders;

use App\Models\KategoriJasa;
use App\Models\PaketLayanan;
use App\Models\Vendor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class VendorSeeder extends Seeder
{
    public function run(): void
    {
        // kategori => daftar vendor: [nama, kota, deskripsi, [[nama paket, deskripsi, harga], ...]]
        $data = [
            'MUA' => [
                ['Lumi Makeup Studio', 'Banyuwangi', 'Rias pengantin, wisuda, dan acara keluarga.', [
                    ['Paket Wisuda', 'Rias natural untuk wisuda.', 350000],
                    ['Paket Pengantin', 'Rias akad dan resepsi, include touch up.', 2500000],
                ]],
                ['Seruni Bridal', 'Jember', 'Spesialis rias pengantin adat dan modern.', [
                    ['Paket Akad', 'Rias dan busana akad nikah.', 1800000],
                    ['Paket Lengkap', 'Akad, resepsi, dan busana 2 set.', 4500000],
                ]],
                ['Kirana Beauty', 'Surabaya', 'Makeup artist untuk pesta dan pemotretan.', [
                    ['Paket Pesta', 'Rias pesta dan hairdo.', 500000],
                    ['Paket Pemotretan', 'Rias untuk sesi foto, 3 jam.', 900000],
                ]],
            ],
            'Catering' => [
                ['Dapur Nusantara', 'Banyuwangi', 'Katering pernikahan dan syukuran masakan nusantara.', [
                    ['Paket 100 Porsi', 'Menu prasmanan 100 porsi.', 3500000],
                    ['Paket 300 Porsi', 'Menu prasmanan 300 porsi plus dekor meja.', 9500000],
                ]],
                ['Warung Rasa Kita', 'Jember', 'Katering hemat untuk acara kantor dan keluarga.', [
                    ['Nasi Box 50', '50 nasi kotak lengkap.', 1250000],
                    ['Prasmanan 150', 'Prasmanan 150 porsi.', 4800000],
                ]],
                ['Boga Mulia Catering', 'Malang', 'Katering premium dengan chef berpengalaman.', [
                    ['Paket Premium 100', 'Menu premium 100 porsi.', 7000000],
                    ['Paket Premium 250', 'Menu premium 250 porsi plus live cooking.', 16500000],
                ]],
            ],
            'Fotografi' => [
                ['Lensa Senja', 'Banyuwangi', 'Fotografer pernikahan dan acara keluarga.', [
                    ['Paket Foto', 'Dokumentasi foto 6 jam, 150 foto edit.', 2000000],
                    ['Paket Foto + Video', 'Foto dan video sinematik 8 jam.', 4500000],
                ]],
                ['Framely Studio', 'Surabaya', 'Studio foto dan videografi untuk berbagai acara.', [
                    ['Paket Prewedding', 'Sesi prewedding 1 lokasi.', 3000000],
                    ['Paket Full Day', 'Dokumentasi seharian penuh.', 6500000],
                ]],
                ['Jejak Momen', 'Malang', 'Dokumentasi candid yang natural.', [
                    ['Paket Candid', 'Foto candid 5 jam.', 1700000],
                    ['Paket Candid Plus', 'Foto candid 8 jam plus album.', 3200000],
                ]],
            ],
            'MC & Hiburan' => [
                ['Suara Acara', 'Banyuwangi', 'MC profesional untuk pernikahan dan acara kantor.', [
                    ['MC Standar', 'MC 4 jam.', 1200000],
                    ['MC + Sound', 'MC 4 jam plus sound system.', 2800000],
                ]],
                ['Panggung Ceria', 'Jember', 'Hiburan keluarga: MC, badut, dan permainan anak.', [
                    ['Paket Anak', 'MC, permainan, dan badut 3 jam.', 1500000],
                    ['Paket Meriah', 'Paket anak plus panggung kecil.', 3000000],
                ]],
                ['Irama Live Music', 'Surabaya', 'Band akustik dan live music untuk resepsi.', [
                    ['Akustik Duo', 'Duo akustik 2 jam.', 1800000],
                    ['Full Band', 'Band 5 personel 3 jam.', 5500000],
                ]],
            ],
        ];

        foreach ($data as $namaKategori => $daftarVendor) {
            $kategori = KategoriJasa::firstOrCreate(
                ['nama_kategori' => $namaKategori],
                ['status_aktif' => true]
            );

            foreach ($daftarVendor as [$nama, $kota, $deskripsi, $daftarPaket]) {
                $vendor = Vendor::firstOrCreate(
                    ['email' => Str::slug($nama) . '@eventku.test'],
                    [
                        'id_kategori'        => $kategori->id_kategori,
                        'nama_vendor'        => $nama,
                        'password'           => Hash::make('password123'),
                        'no_telp'            => '081234567890',
                        'alamat'             => 'Jl. Contoh No. 1',
                        'kota'               => $kota,
                        'deskripsi'          => $deskripsi,
                        'nama_bank'          => 'BCA',
                        'no_rekening'        => '1234567890',
                        'atas_nama_rekening' => $nama,
                        'status_aktif'       => true,
                    ]
                );

                foreach ($daftarPaket as [$namaPaket, $deskPaket, $harga]) {
                    PaketLayanan::firstOrCreate(
                        ['id_vendor' => $vendor->id_vendor, 'nama_paket' => $namaPaket],
                        ['deskripsi' => $deskPaket, 'harga' => $harga]
                    );
                }
            }
        }
    }
}