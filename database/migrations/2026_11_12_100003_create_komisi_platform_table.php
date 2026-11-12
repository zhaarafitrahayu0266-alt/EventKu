<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('komisi_platform', function (Blueprint $table) {
            $table->id('id_komisi');
            $table->foreignId('id_admin')->constrained('pengelola_platform', 'id_admin');
            $table->decimal('persentase', 5, 2);               // contoh: 10.00
            $table->dateTime('tanggal_berlaku');
            $table->string('keterangan')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('komisi_platform');
    }
};
