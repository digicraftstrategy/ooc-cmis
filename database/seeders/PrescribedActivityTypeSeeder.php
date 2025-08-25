<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrescribedActivityTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('prescribed_activity_types')->insert([
            [
                'type' => 'Classification of Films & Publications',
                'description' => 'Activities relating to Classification of Films and Publications.',
                'created_at'=> now(),
                'updated_at' => now()
            ],
            [
                'type' => 'Registration of Publication Premises',
                'description' => 'Activities relating to Registration of Publication Premises.',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
