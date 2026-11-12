<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PortofolioVendor extends Model
{
    protected $table = 'portofolio_vendor';
    protected $primaryKey = 'id_portofolio';
    public $timestamps = false;

    protected $fillable = [
        'id_vendor',
        'url_foto',
        'keterangan',
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'id_vendor', 'id_vendor');
    }
}
