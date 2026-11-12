<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PesananInduk extends Model
{
    protected $table = 'pesanan_induk';
    protected $primaryKey = 'id_pesanan_induk';
    public $timestamps = false;

    protected $fillable = [
        'id_acara',
        'total_harga',
        'nominal_dp',
        'nominal_pelunasan',
        'status',
        'tanggal_dibuat',
        'batas_bayar_dp',
        'jatuh_tempo_pelunasan',
        'tanggal_lunas',
    ];

    protected $casts = [
        'total_harga' => 'decimal:2',
        'nominal_dp' => 'decimal:2',
        'nominal_pelunasan' => 'decimal:2',
        'tanggal_dibuat' => 'datetime',
        'batas_bayar_dp' => 'datetime',
        'jatuh_tempo_pelunasan' => 'datetime',
        'tanggal_lunas' => 'datetime',
    ];

    public function acara()
    {
        return $this->belongsTo(Acara::class, 'id_acara', 'id_acara');
    }

    public function subPesanan()
    {
        return $this->hasMany(SubPesanan::class, 'id_pesanan_induk', 'id_pesanan_induk');
    }

    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class, 'id_pesanan_induk', 'id_pesanan_induk');
    }

    public function pembatalan()
    {
        return $this->hasMany(Pembatalan::class, 'id_pesanan_induk', 'id_pesanan_induk');
    }
}
