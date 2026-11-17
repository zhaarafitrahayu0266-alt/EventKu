<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KalenderKetersediaan extends Model
{
    protected $table = 'kalender_ketersediaan';
    protected $primaryKey = 'id_kalender';
    public $timestamps = false;

    protected $fillable = [
        'id_vendor',
        'id_sub_pesanan',
        'tanggal',
        'status',
        'keterangan',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'id_vendor', 'id_vendor');
    }

    public function subPesanan()
    {
        return $this->belongsTo(SubPesanan::class, 'id_sub_pesanan', 'id_sub_pesanan');
    }
}
