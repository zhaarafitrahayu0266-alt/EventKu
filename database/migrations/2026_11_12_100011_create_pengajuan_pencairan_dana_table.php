<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengajuan_pencairan_dana', function (Blueprint $table) {
            $table->id('id_pengajuan');
            $table->foreignId('id_vendor')->constrained('vendor', 'id_vendor');
            $table->foreignId('id_admin')->nullable()->constrained('pengelola_platform', 'id_admin');
            $table->decimal('nominal_diajukan', 12, 2);
            $table->string('status', 30)->default('menunggu');         // menunggu | disetujui | ditolak
            $table->string('alasan_penolakan')->nullable();
            $table->string('bukti_transfer_url')->nullable();
            $table->dateTime('tanggal_pengajuan')->useCurrent();
            $table->dateTime('tanggal_diproses')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengajuan_pencairan_dana');
    }
};
