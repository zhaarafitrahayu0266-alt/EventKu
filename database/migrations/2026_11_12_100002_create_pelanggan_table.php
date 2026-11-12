<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pelanggan', function (Blueprint $table) {
            $table->id('id_pelanggan');
            $table->string('nama', 100);
            $table->string('email')->unique();
            $table->string('password');
            $table->string('no_telp', 15);
            $table->string('alamat')->nullable();
            $table->string('foto_ktp_url')->nullable();        // diisi saat melengkapi data diri
            $table->string('link_medsos')->nullable();
            $table->string('status_verifikasi', 30)->default('belum');
            $table->boolean('setuju_disclaimer')->default(false);
            $table->dateTime('tanggal_setuju_disclaimer')->nullable();
            $table->dateTime('tanggal_registrasi')->useCurrent();
            $table->rememberToken();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pelanggan');
    }
};
