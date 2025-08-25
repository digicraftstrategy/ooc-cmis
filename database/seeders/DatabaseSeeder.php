<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RegionSeeder::class,
            ProvinceSeeder::class,
            AccountStatusSeeder::class,
            UserTypeSeeder::class,
            RoleSeeder::class,
            PermissionSeeder::class,
            RolePermissionSeeder::class,
            UserSeeder::class,
            PrescribedActivityTypeSeeder::class,
            PrescribedActivitySeeder::class,
        ]);
    }
}
