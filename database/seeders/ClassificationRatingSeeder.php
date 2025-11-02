<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassificationRatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed some default classification ratings
        $ratings = [
            [
                'rating' => 'General (G)',
                'slug' => 'general',
                'description' => 'Suitable for all audiences.'
            ],
            [
                'rating' => 'Parental Guidance Required (PGR)',
                'slug' => 'parental-guidance-required',
                'description' => 'Some material may not be suitable for children.'
            ],
            [
                'rating' => 'Mature (M)',
                'slug' => 'mature',
                'description' => 'Suitable for mature audiences aged 17 and above.'
            ],
            [
                'rating' => 'Restricted (R 18+)',
                'slug' => 'restricted',
                'description' => 'Restricted to adults aged 18 and above.'
            ],
            [
                'rating' => 'Refused Classification (RC)',
                'slug' => 'refused-classification',
                'description' => 'Not approved for public exhibition.'
            ],
            [
                'rating' => 'Prohibited (X)',
                'slug' => 'prohibited',
                'description' => 'Not suitable for public exhibition.'
            ],
        ];

        foreach ($ratings as $rating) {
            DB::table('classification_ratings')->updateOrInsert(
                ['slug' => $rating['slug']],
                $rating
            );
        }
    }
}
