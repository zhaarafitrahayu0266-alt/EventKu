<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    protected $table = 'ulasan';
    protected $primaryKey = 'id_ulasan';
    public $timestamps = false;

    protected $fillable = [
        'id_sub_pesanan',
        'rating',
        'komentar',
        'tanggal_ulasan',
        'balasan_vendor',
        'tanggal_balasan',
    ];

    protected $casts = [
        'tanggal_ulasan' => 'datetime',
        'tanggal_balasan' => 'datetime',
        'rating' => 'integer',
    ];

    public function subPesanan()
    {
        return $this->belongsTo(SubPesanan::class, 'id_sub_pesanan', 'id_sub_pesanan');
    }
}
