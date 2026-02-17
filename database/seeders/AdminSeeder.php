<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Buat user admin (atau update kalau sudah ada)
        $admin = User::updateOrCreate(
            ['email' => 'admin@alumni.com'],
            [
                'name'              => 'Administrator',
                'password'          => Hash::make('admin123'),
                'role'              => 'admin',
                'email_verified_at' => now(),
            ]
        );

        // Assign Spatie role
        $admin->assignRole('admin');

        $this->command->info('✅ Admin created: admin@alumni.com / admin123');
    }
}