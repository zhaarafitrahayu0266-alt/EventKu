<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('portofolio_vendor', function (Blueprint $table) {
            $table->id('id_portofolio');
            $table->foreignId('id_vendor')->constrained('vendor', 'id_vendor')->cascadeOnDelete();
            $table->string('url_foto');
            $table->string('keterangan')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('portofolio_vendor');
    }
};
