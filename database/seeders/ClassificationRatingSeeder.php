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
                'description' => 'Suitable for all audiences.',
                'icon_path' => 'ratingicons/g_rating.png',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'rating' => 'Parental Guidance Required (PGR)',
                'slug' => 'parental-guidance-required',
                'description' => 'Some material may not be suitable for children. Parental guidance is required.',
                'icon_path' => 'ratingicons/pgr_rating.png',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'rating' => 'Mature (M)',
                'slug' => 'mature',
                'description' => 'Suitable for mature audiences aged 17 and above.',
                'icon_path' => 'ratingicons/m_rating.png',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'rating' => 'Restricted (R 18+)',
                'slug' => 'restricted',
                'description' => 'Restricted to adults aged 18 and above.',
                'icon_path' => 'ratingicons/r_rating.png',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'rating' => 'Refused Classification (RC)',
                'slug' => 'refused-classification',
                'description' => 'Not approved for public exhibition.',
                'icon_path' => 'ratingicons/rc_rating.png',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'rating' => 'Prohibited (X)',
                'slug' => 'prohibited',
                'is_active' => false,
                'description' => 'Not suitable for public exhibition.',
                'created_at' => now(),
                'updated_at' => now()
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
