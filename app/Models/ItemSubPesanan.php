<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemSubPesanan extends Model
{
    protected $table = 'item_sub_pesanan';
    protected $primaryKey = 'id_item';
    public $timestamps = false;

    protected $fillable = [
        'id_sub_pesanan',
        'id_paket',
        'jumlah',
        'harga_satuan',
    ];

    protected $casts = [
        'harga_satuan' => 'decimal:2',
    ];

    public function subPesanan()
    {
        return $this->belongsTo(SubPesanan::class, 'id_sub_pesanan', 'id_sub_pesanan');
    }

    public function paket()
    {
        return $this->belongsTo(PaketLayanan::class, 'id_paket', 'id_paket');
    }
}
