<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaksi_escrow', function (Blueprint $table) {
            $table->id('id_transaksi_escrow');
            $table->foreignId('id_sub_pesanan')->constrained('sub_pesanan', 'id_sub_pesanan');
            $table->foreignId('id_komisi')->constrained('komisi_platform', 'id_komisi');
            $table->decimal('nominal_masuk', 12, 2);
            $table->decimal('persentase_komisi', 5, 2);
            $table->decimal('nominal_komisi', 12, 2);
            $table->decimal('nominal_bersih_vendor', 12, 2);
            $table->string('status', 30)->default('ditahan');          // ditahan | dapat_dicairkan | dicairkan | dikembalikan
            $table->dateTime('tanggal_masuk')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksi_escrow');
    }
};
