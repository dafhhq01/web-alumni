<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {

        // Di dalam file seeder baru atau gabung di AdminSeeder
        $superAdmin = User::updateOrCreate(
            ['email' => 'superadmin@alumni.com'],
            [
                'name'              => 'Super Administrator',
                'password'          => Hash::make('super123'),
                'role'              => 'super-admin', // Pastikan di database enum/string ini diizinkan
                'email_verified_at' => now(),
            ]
        );
        $superAdmin->assignRole('super-admin');

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

        $this->command->info('✅ Super admin created: superadmin@alumni.com / super123');
        $this->command->info('✅ Admin created: admin@alumni.com / admin123');
    }
}
