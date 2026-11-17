<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kalender_ketersediaan', function (Blueprint $table) {
            $table->id('id_kalender');
            $table->foreignId('id_vendor')->constrained('vendor', 'id_vendor')->cascadeOnDelete();
            $table->foreignId('id_sub_pesanan')->nullable()->constrained('sub_pesanan', 'id_sub_pesanan')->nullOnDelete();
            $table->date('tanggal');
            $table->string('status', 20)->default('tersedia');         // tersedia | terpesan
            $table->string('keterangan')->nullable();
            $table->unique(['id_vendor', 'tanggal']);                  // satu baris per vendor per tanggal
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kalender_ketersediaan');
    }
};
