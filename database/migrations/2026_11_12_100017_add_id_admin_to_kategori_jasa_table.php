<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // ERD: KATEGORI_JASA punya id_admin (admin yang mengelola kategori)
        if (! Schema::hasColumn('kategori_jasa', 'id_admin')) {
            Schema::table('kategori_jasa', function (Blueprint $table) {
                $table->foreignId('id_admin')->nullable()->constrained('pengelola_platform', 'id_admin');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('kategori_jasa', 'id_admin')) {
            Schema::table('kategori_jasa', function (Blueprint $table) {
                $table->dropConstrainedForeignId('id_admin');
            });
        }
    }
};
