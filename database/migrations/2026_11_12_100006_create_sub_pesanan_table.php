<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sub_pesanan', function (Blueprint $table) {
            $table->id('id_sub_pesanan');
            $table->foreignId('id_acara')->constrained('acara', 'id_acara');
            $table->foreignId('id_pesanan_induk')->constrained('pesanan_induk', 'id_pesanan_induk');
            $table->foreignId('id_vendor')->constrained('vendor', 'id_vendor');
            $table->decimal('subtotal', 12, 2)->default(0);
            $table->string('status', 30)->default('menunggu');         // menunggu | diterima | ditolak | kedaluwarsa | dibatalkan | selesai
            $table->dateTime('waktu_diajukan')->useCurrent();
            $table->dateTime('batas_respon_vendor')->nullable();       // waktu_diajukan + 24 jam
            $table->dateTime('waktu_konfirmasi')->nullable();
            $table->dateTime('waktu_update_status')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sub_pesanan');
    }
};
