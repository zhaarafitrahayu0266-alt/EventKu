<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class PengelolaPlatform extends Authenticatable
{
    protected $table = 'pengelola_platform';
    protected $primaryKey = 'id_admin';
    public $timestamps = false;

    protected $fillable = [
        'nama',
        'email',
        'password',
        'role_admin',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'password' => 'hashed',
    ];

    public function komisi()
    {
        return $this->hasMany(KomisiPlatform::class, 'id_admin', 'id_admin');
    }

    public function pengajuanPencairan()
    {
        return $this->hasMany(PengajuanPencairanDana::class, 'id_admin', 'id_admin');
    }
}
