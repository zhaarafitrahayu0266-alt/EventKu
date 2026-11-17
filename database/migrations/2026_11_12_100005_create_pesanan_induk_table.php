<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pesanan_induk', function (Blueprint $table) {
            $table->id('id_pesanan_induk');
            $table->foreignId('id_acara')->constrained('acara', 'id_acara');
            $table->decimal('total_harga', 12, 2)->default(0);
            $table->decimal('nominal_dp', 12, 2)->default(0);          // 30% dari total_harga
            $table->decimal('nominal_pelunasan', 12, 2)->default(0);
            $table->string('status', 30)->default('draft');            // draft | menunggu_dp | dp_dibayar | lunas | selesai | dibatalkan
            $table->dateTime('tanggal_dibuat')->useCurrent();
            $table->dateTime('batas_bayar_dp')->nullable();
            $table->dateTime('jatuh_tempo_pelunasan')->nullable();
            $table->dateTime('tanggal_lunas')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pesanan_induk');
    }
};
