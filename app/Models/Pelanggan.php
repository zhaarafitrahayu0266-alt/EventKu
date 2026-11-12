<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Pelanggan extends Authenticatable
{
    protected $table = 'pelanggan';
    protected $primaryKey = 'id_pelanggan';
    public $timestamps = false;

    protected $fillable = [
        'nama',
        'email',
        'password',
        'no_telp',
        'alamat',
        'foto_ktp_url',
        'link_medsos',
        'status_verifikasi',
        'setuju_disclaimer',
        'tanggal_setuju_disclaimer',
        'tanggal_registrasi',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'password' => 'hashed',
        'setuju_disclaimer' => 'boolean',
        'tanggal_setuju_disclaimer' => 'datetime',
        'tanggal_registrasi' => 'datetime',
    ];

    public function acara()
    {
        return $this->hasMany(Acara::class, 'id_pelanggan', 'id_pelanggan');
    }

    public function komplain()
    {
        return $this->hasMany(Komplain::class, 'id_pelanggan', 'id_pelanggan');
    }

    public function notifikasi()
    {
        return $this->hasMany(Notifikasi::class, 'id_pelanggan', 'id_pelanggan');
    }
}
