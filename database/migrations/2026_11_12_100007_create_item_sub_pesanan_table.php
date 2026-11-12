<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('item_sub_pesanan', function (Blueprint $table) {
            $table->id('id_item');
            $table->foreignId('id_sub_pesanan')->constrained('sub_pesanan', 'id_sub_pesanan')->cascadeOnDelete();
            $table->foreignId('id_paket')->constrained('paket_layanan', 'id_paket');
            $table->unsignedInteger('jumlah')->default(1);
            $table->decimal('harga_satuan', 12, 2);                    // salinan harga paket saat dipesan
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('item_sub_pesanan');
    }
};
