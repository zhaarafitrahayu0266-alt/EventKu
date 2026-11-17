<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KomisiPlatform extends Model
{
    protected $table = 'komisi_platform';
    protected $primaryKey = 'id_komisi';
    public $timestamps = false;

    protected $fillable = [
        'id_admin',
        'persentase',
        'tanggal_berlaku',
        'keterangan',
    ];

    protected $casts = [
        'persentase' => 'decimal:2',
        'tanggal_berlaku' => 'datetime',
    ];

    public function admin()
    {
        return $this->belongsTo(PengelolaPlatform::class, 'id_admin', 'id_admin');
    }
}
