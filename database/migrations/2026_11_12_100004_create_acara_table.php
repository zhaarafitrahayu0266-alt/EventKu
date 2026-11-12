<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('acara', function (Blueprint $table) {
            $table->id('id_acara');
            $table->foreignId('id_pelanggan')->constrained('pelanggan', 'id_pelanggan');
            $table->string('nama_acara', 150);
            $table->date('tanggal_acara');
            $table->string('lokasi');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('acara');
    }
};
