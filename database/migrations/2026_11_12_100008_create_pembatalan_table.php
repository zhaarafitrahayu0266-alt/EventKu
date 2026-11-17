<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembatalan', function (Blueprint $table) {
            $table->id('id_pembatalan');
            $table->foreignId('id_pesanan_induk')->constrained('pesanan_induk', 'id_pesanan_induk');
            $table->foreignId('id_sub_pesanan')->nullable()->constrained('sub_pesanan', 'id_sub_pesanan');
            $table->string('dibatalkan_oleh', 20);                     // pelanggan | vendor
            $table->string('alasan')->nullable();
            $table->decimal('persentase_refund', 5, 2)->default(0);    // pelanggan 30, vendor 100
            $table->decimal('nominal_refund', 12, 2)->default(0);
            $table->dateTime('waktu_pembatalan')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembatalan');
    }
};
