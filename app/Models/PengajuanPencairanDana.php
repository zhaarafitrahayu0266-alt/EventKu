<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengajuanPencairanDana extends Model
{
    protected $table = 'pengajuan_pencairan_dana';
    protected $primaryKey = 'id_pengajuan';
    public $timestamps = false;

    protected $fillable = [
        'id_vendor',
        'id_admin',
        'nominal_diajukan',
        'status',
        'alasan_penolakan',
        'bukti_transfer_url',
        'tanggal_pengajuan',
        'tanggal_diproses',
    ];

    protected $casts = [
        'nominal_diajukan' => 'decimal:2',
        'tanggal_pengajuan' => 'datetime',
        'tanggal_diproses' => 'datetime',
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'id_vendor', 'id_vendor');
    }

    public function admin()
    {
        return $this->belongsTo(PengelolaPlatform::class, 'id_admin', 'id_admin');
    }
}
