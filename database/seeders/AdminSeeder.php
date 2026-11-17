<?php

namespace Database\Seeders;

use App\Models\PengelolaPlatform;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $email = env('ADMIN_EMAIL');
        $password = env('ADMIN_PASSWORD');

        if (! $email || ! $password) {
            throw new \RuntimeException('Isi ADMIN_EMAIL dan ADMIN_PASSWORD di file .env dulu.');
        }

        // Password di-hash otomatis oleh cast 'hashed' pada model PengelolaPlatform.
        PengelolaPlatform::updateOrCreate(
            ['email' => $email],
            [
                'nama'       => 'Admin EventKu',
                'password'   => $password,
                'role_admin' => 'super_admin',
            ]
        );
    }
}