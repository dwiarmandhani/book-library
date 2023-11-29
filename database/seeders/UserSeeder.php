<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@admin.com',
            'password' => Hash::make('@aduhlupa123'), // Hash the password for security
            'is_admin' => true, // Set as admin user
        ]);

        // Create a non-admin user
        User::create([
            'name' => 'Dwi Armandhani',
            'email' => 'dwiar55.arman@gmail.com',
            'password' => Hash::make('@aduhlupa123'), // Hash the password for security
            'is_admin' => false, // Set as non-admin user
        ]);
    }
}
