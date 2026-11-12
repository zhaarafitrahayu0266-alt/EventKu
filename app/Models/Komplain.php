<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Komplain extends Model
{
    protected $table = 'komplain';
    protected $primaryKey = 'id_komplain';
    public $timestamps = false;

    protected $fillable = [
        'id_pesanan_induk',
        'id_sub_pesanan',
        'id_pelanggan',
        'id_vendor',
        'id_admin',
        'dilaporkan_oleh',
        'deskripsi',
        'status',
        'catatan_penyelesaian',
        'tanggal_lapor',
    ];

    protected $casts = [
        'tanggal_lapor' => 'datetime',
    ];

    public function pesananInduk()
    {
        return $this->belongsTo(PesananInduk::class, 'id_pesanan_induk', 'id_pesanan_induk');
    }

    public function subPesanan()
    {
        return $this->belongsTo(SubPesanan::class, 'id_sub_pesanan', 'id_sub_pesanan');
    }

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan', 'id_pelanggan');
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'id_vendor', 'id_vendor');
    }

    public function admin()
    {
        return $this->belongsTo(PengelolaPlatform::class, 'id_admin', 'id_admin');
    }
}
