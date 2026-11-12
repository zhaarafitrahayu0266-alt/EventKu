<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubPesanan extends Model
{
    protected $table = 'sub_pesanan';
    protected $primaryKey = 'id_sub_pesanan';
    public $timestamps = false;

    protected $fillable = [
        'id_acara',
        'id_pesanan_induk',
        'id_vendor',
        'subtotal',
        'status',
        'waktu_diajukan',
        'batas_respon_vendor',
        'waktu_konfirmasi',
        'waktu_update_status',
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'waktu_diajukan' => 'datetime',
        'batas_respon_vendor' => 'datetime',
        'waktu_konfirmasi' => 'datetime',
        'waktu_update_status' => 'datetime',
    ];

    public function acara()
    {
        return $this->belongsTo(Acara::class, 'id_acara', 'id_acara');
    }

    public function pesananInduk()
    {
        return $this->belongsTo(PesananInduk::class, 'id_pesanan_induk', 'id_pesanan_induk');
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'id_vendor', 'id_vendor');
    }

    public function item()
    {
        return $this->hasMany(ItemSubPesanan::class, 'id_sub_pesanan', 'id_sub_pesanan');
    }

    public function ulasan()
    {
        return $this->hasOne(Ulasan::class, 'id_sub_pesanan', 'id_sub_pesanan');
    }

    public function escrow()
    {
        return $this->hasOne(TransaksiEscrow::class, 'id_sub_pesanan', 'id_sub_pesanan');
    }
}
