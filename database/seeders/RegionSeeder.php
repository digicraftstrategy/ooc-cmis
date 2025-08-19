<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('regions')->insert([
            [
                'code' => 'HR',
                'name' => 'Highlands Region',
                'created_at' => now(),
                'updated_at' => now()
            ],
            
            [
                'code' => 'MM',
                'name' => 'Momase Region',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'code' => 'SR',
                'name' => 'Southern Region',
                'created_at' => now(),
                'updated_at' => now()
            ],
            
            [
                'code' => 'NGI',
                'name' => 'New Guinea Islands Region',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
