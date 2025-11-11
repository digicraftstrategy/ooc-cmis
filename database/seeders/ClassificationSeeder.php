<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('classifications')->insert([
            [
                'classifiable_id' => 1,
                'classification_category_id' => 1,
                'classification_rating_id' => 1,
                //'classification_status_id' => 1,
                'owner_id' => 1

            ],
            [
                'classifiable_id' => 2,
                'classification_category_id' => 1,
                'classification_rating_id' => 1,
                //'classification_status_id' => 1,
                'owner_id' => 1
            ]
        ]);
    }
}
