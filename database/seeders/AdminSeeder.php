<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Buat record di tabel User
        $user = User::create([
            'name' => 'Admin Utama',
            'email' => 'admin@resto.com',
            'password' => Hash::make('password'), // Password: password
            'role' => 'admin',
        ]);
        
        // 2. Buat record di tabel Admin
        Admin::create([
            'userId' => $user->userId,
            // employeeId akan terisi otomatis (auto-increment)
        ]);
        
        $this->command->info('Akun Admin telah berhasil dibuat: admin@resto.com / password');
    }
}