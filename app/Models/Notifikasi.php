<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    protected $table = 'notifikasi';
    protected $primaryKey = 'id_notifikasi';
    public $timestamps = false;

    protected $fillable = [
        'id_pelanggan',
        'id_vendor',
        'id_pesanan_induk',
        'id_sub_pesanan',
        'jenis',
        'saluran',
        'isi',
        'status_kirim',
        'waktu_kirim',
    ];

    protected $casts = [
        'waktu_kirim' => 'datetime',
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan', 'id_pelanggan');
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'id_vendor', 'id_vendor');
    }

    public function pesananInduk()
    {
        return $this->belongsTo(PesananInduk::class, 'id_pesanan_induk', 'id_pesanan_induk');
    }

    public function subPesanan()
    {
        return $this->belongsTo(SubPesanan::class, 'id_sub_pesanan', 'id_sub_pesanan');
    }
}
