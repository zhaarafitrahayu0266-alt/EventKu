<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notifikasi', function (Blueprint $table) {
            $table->id('id_notifikasi');
            $table->foreignId('id_pelanggan')->nullable()->constrained('pelanggan', 'id_pelanggan')->nullOnDelete();
            $table->foreignId('id_vendor')->nullable()->constrained('vendor', 'id_vendor')->nullOnDelete();
            $table->foreignId('id_pesanan_induk')->nullable()->constrained('pesanan_induk', 'id_pesanan_induk')->nullOnDelete();
            $table->foreignId('id_sub_pesanan')->nullable()->constrained('sub_pesanan', 'id_sub_pesanan')->nullOnDelete();
            $table->string('jenis', 50);                               // pengingat_dp | pengingat_pelunasan | pengajuan_baru | dll
            $table->string('saluran', 30)->default('web');             // web | email | whatsapp
            $table->text('isi');
            $table->string('status_kirim', 30)->default('menunggu');
            $table->dateTime('waktu_kirim')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notifikasi');
    }
};
