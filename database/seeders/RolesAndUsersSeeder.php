<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesAndUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create roles
        $adminRole = Role::create(['name' => 'admin']);
        $teacherRole = Role::create(['name' => 'teacher']);
        $guestRole = Role::create(['name' => 'guest']);

        // Create admin user
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
        ]);
        $admin->assignRole($adminRole);

        // Create teacher user
        $teacher = User::create([
            'name' => 'Teacher User',
            'email' => 'teacher@gmail.com',
            'password' => Hash::make('12345678'),
        ]);
        $teacher->assignRole($teacherRole);

        // Create guest user
        $guest = User::create([
            'name' => 'Guest User',
            'email' => 'guest@gmail.com',
            'password' => Hash::make('12345678'),
        ]);
        $guest->assignRole($guestRole);
    }
}
