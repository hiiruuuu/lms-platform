<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class RoleAndUserSeeder extends Seeder
{
    public function run(): void
    {
        // Buat Roles
        $adminRole = Role::create(['name' => 'admin']);
        $instructorRole = Role::create(['name' => 'instructor']);
        $studentRole = Role::create(['name' => 'student']);

        // Akun Admin
        $admin = User::create([
            'name' => 'Administrator',
            'email' => 'admin@lms.com',
            'password' => Hash::make('password'),
        ]);
        $admin->assignRole($adminRole);

        // Akun Instruktur
        $instructor = User::create([
            'name' => 'Ahmad Instruktur',
            'email' => 'instructor@lms.com',
            'password' => Hash::make('password'),
        ]);
        $instructor->assignRole($instructorRole);

        // Akun Siswa
        $student = User::create([
            'name' => 'Siswa Belajar',
            'email' => 'student@lms.com',
            'password' => Hash::make('password'),
        ]);
        $student->assignRole($studentRole);
    }
}
