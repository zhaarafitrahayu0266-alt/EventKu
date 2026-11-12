<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembatalan extends Model
{
    protected $table = 'pembatalan';
    protected $primaryKey = 'id_pembatalan';
    public $timestamps = false;

    protected $fillable = [
        'id_pesanan_induk',
        'id_sub_pesanan',
        'dibatalkan_oleh',
        'alasan',
        'persentase_refund',
        'nominal_refund',
        'waktu_pembatalan',
    ];

    protected $casts = [
        'persentase_refund' => 'decimal:2',
        'nominal_refund' => 'decimal:2',
        'waktu_pembatalan' => 'datetime',
    ];

    public function pesananInduk()
    {
        return $this->belongsTo(PesananInduk::class, 'id_pesanan_induk', 'id_pesanan_induk');
    }

    public function subPesanan()
    {
        return $this->belongsTo(SubPesanan::class, 'id_sub_pesanan', 'id_sub_pesanan');
    }
}
