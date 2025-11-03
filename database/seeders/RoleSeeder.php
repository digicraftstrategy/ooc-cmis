<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            [
                'name' => 'Super Admin',
                'role_group' => 'System',
                'slug' => 'super-admin',
                'description' => 'Full system access with all permissions for managing the entire platform',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'System Admin',
                'role_group' => 'System',
                'slug' => 'system-admin',
                'description' => 'Full system access with all permissions for managing the entire platform',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Platform Administrator',
                'role_group' => 'System',
                'slug' => 'platform-administrator',
                'description' => 'Administrator with elevated access to configure settings and manage users',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Site Manager',
                'role_group' => 'Client',
                'slug' => 'site-manager',
                'description' => 'Manager with the ability to oversee specific Sites or Business and manage teams',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Billing Manager',
                'role_group' => 'Client',
                'slug' => 'billing-manager',
                'description' => 'Responsible for handling invoicing, payments, and financial records',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Clients Manager',
                'role_group' => 'Client',
                'slug' => 'clients-manager',
                'description' => 'Manages client relationships, contracts, and service agreements',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],          
        ]);
    }
}
