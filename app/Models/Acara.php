<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Acara extends Model
{
    protected $table = 'acara';
    protected $primaryKey = 'id_acara';
    public $timestamps = false;

    protected $fillable = [
        'id_pelanggan',
        'nama_acara',
        'tanggal_acara',
        'lokasi',
    ];

    protected $casts = [
        'tanggal_acara' => 'date',
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan', 'id_pelanggan');
    }

    public function pesananInduk()
    {
        return $this->hasOne(PesananInduk::class, 'id_acara', 'id_acara');
    }

    public function subPesanan()
    {
        return $this->hasMany(SubPesanan::class, 'id_acara', 'id_acara');
    }
}
