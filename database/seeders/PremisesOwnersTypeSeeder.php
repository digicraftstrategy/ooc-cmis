<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PremisesOwnersTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('premises_owner_types')->insert([
            [
                'type' => 'Company',
                'description' => 'Premsies owned and operated by company',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'type' => 'Individual',
                'description' => 'Premsies owned and operated by individuals',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'type' => 'Church Organization',
                'description' => 'Premises owned and operated by churches',
                'created_at' => now(),
                'updated_at' => now()
            ]

        ]);
    }
}
