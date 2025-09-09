<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'uuid' => User::generateUniqueUuid(),
                'name' => 'Super Admin',
                'email' => 'superadmin@yumicode.tech',
                'phone' => '1234567890',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'), // Use secure password
                'role_id' => 1, // Assuming 1 is Super Admin in roles table
                'account_status_id' => 1, // Assuming 1 is Active in account_statuses table
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
                'user_type_id' => 1
            ],
            [
                'uuid' => User::generateUniqueUuid(),
                'name' => 'Eugene Pande',
                'email' => 'eugene.pande@yumicode.tech',
                'phone' => '1234567890',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'), // Use secure password
                'role_id' => 1, // Assuming 1 is Super Admin in roles table
                'account_status_id' => 1, // Assuming 1 is Active in account_statuses table
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
                'user_type_id' => 1
            ],
        ];
        // Create each user individually
        foreach ($users as $userData) {
            User::create($userData);
        }
    }
}
