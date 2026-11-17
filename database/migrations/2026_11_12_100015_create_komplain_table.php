<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('komplain', function (Blueprint $table) {
            $table->id('id_komplain');
            $table->foreignId('id_pesanan_induk')->constrained('pesanan_induk', 'id_pesanan_induk');
            $table->foreignId('id_sub_pesanan')->nullable()->constrained('sub_pesanan', 'id_sub_pesanan');
            $table->foreignId('id_pelanggan')->constrained('pelanggan', 'id_pelanggan');
            $table->foreignId('id_vendor')->constrained('vendor', 'id_vendor');
            $table->foreignId('id_admin')->nullable()->constrained('pengelola_platform', 'id_admin');
            $table->string('dilaporkan_oleh', 20);                     // pelanggan | vendor
            $table->text('deskripsi');
            $table->string('status', 30)->default('diajukan');         // diajukan | diproses | selesai
            $table->text('catatan_penyelesaian')->nullable();
            $table->dateTime('tanggal_lapor')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('komplain');
    }
};
