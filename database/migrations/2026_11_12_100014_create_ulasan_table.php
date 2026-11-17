<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ulasan', function (Blueprint $table) {
            $table->id('id_ulasan');
            $table->foreignId('id_sub_pesanan')->unique()->constrained('sub_pesanan', 'id_sub_pesanan');   // satu ulasan per sub-pesanan
            $table->unsignedTinyInteger('rating');                     // 1-5
            $table->text('komentar')->nullable();
            $table->dateTime('tanggal_ulasan')->useCurrent();
            $table->text('balasan_vendor')->nullable();
            $table->dateTime('tanggal_balasan')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ulasan');
    }
};
