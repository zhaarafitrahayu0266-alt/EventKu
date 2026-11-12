<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'pembayaran';
    protected $primaryKey = 'id_pembayaran';
    public $timestamps = false;

    protected $fillable = [
        'id_pesanan_induk',
        'id_pembatalan',
        'jenis_pembayaran',
        'nominal',
        'metode_pembayaran',
        'status_pembayaran',
        'referensi_gateway',
        'waktu_pembayaran',
    ];

    protected $casts = [
        'nominal' => 'decimal:2',
        'waktu_pembayaran' => 'datetime',
    ];

    public function pesananInduk()
    {
        return $this->belongsTo(PesananInduk::class, 'id_pesanan_induk', 'id_pesanan_induk');
    }

    public function pembatalan()
    {
        return $this->belongsTo(Pembatalan::class, 'id_pembatalan', 'id_pembatalan');
    }
}
