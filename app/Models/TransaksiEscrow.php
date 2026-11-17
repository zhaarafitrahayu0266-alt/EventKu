<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiEscrow extends Model
{
    protected $table = 'transaksi_escrow';
    protected $primaryKey = 'id_transaksi_escrow';
    public $timestamps = false;

    protected $fillable = [
        'id_sub_pesanan',
        'id_komisi',
        'nominal_masuk',
        'persentase_komisi',
        'nominal_komisi',
        'nominal_bersih_vendor',
        'status',
        'tanggal_masuk',
    ];

    protected $casts = [
        'nominal_masuk' => 'decimal:2',
        'persentase_komisi' => 'decimal:2',
        'nominal_komisi' => 'decimal:2',
        'nominal_bersih_vendor' => 'decimal:2',
        'tanggal_masuk' => 'datetime',
    ];

    public function subPesanan()
    {
        return $this->belongsTo(SubPesanan::class, 'id_sub_pesanan', 'id_sub_pesanan');
    }

    public function komisi()
    {
        return $this->belongsTo(KomisiPlatform::class, 'id_komisi', 'id_komisi');
    }
}
