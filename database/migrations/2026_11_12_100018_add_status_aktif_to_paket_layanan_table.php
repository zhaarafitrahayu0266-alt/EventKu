<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // ERD: PAKET_LAYANAN punya status_aktif
        if (! Schema::hasColumn('paket_layanan', 'status_aktif')) {
            Schema::table('paket_layanan', function (Blueprint $table) {
                $table->boolean('status_aktif')->default(true);
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('paket_layanan', 'status_aktif')) {
            Schema::table('paket_layanan', function (Blueprint $table) {
                $table->dropColumn('status_aktif');
            });
        }
    }
};
