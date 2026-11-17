<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengelola_platform', function (Blueprint $table) {
            $table->id('id_admin');
            $table->string('nama', 100);
            $table->string('email')->unique();
            $table->string('password');
            $table->string('role_admin', 30)->default('admin');
            $table->rememberToken();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengelola_platform');
    }
};
