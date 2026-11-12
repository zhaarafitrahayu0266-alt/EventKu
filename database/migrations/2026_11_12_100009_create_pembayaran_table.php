<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id('id_pembayaran');
            $table->foreignId('id_pesanan_induk')->constrained('pesanan_induk', 'id_pesanan_induk');
            $table->foreignId('id_pembatalan')->nullable()->constrained('pembatalan', 'id_pembatalan');   // terisi bila ini refund
            $table->string('jenis_pembayaran', 20);                    // dp | pelunasan | refund
            $table->decimal('nominal', 12, 2);
            $table->string('metode_pembayaran', 50)->nullable();
            $table->string('status_pembayaran', 30)->default('pending');   // pending | berhasil | gagal | kedaluwarsa
            $table->string('referensi_gateway')->nullable();           // order_id / transaction_id dari payment gateway
            $table->dateTime('waktu_pembayaran')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
