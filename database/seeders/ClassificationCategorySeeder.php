<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassificationCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $classificarionCategories = [
            [
                'name' => 'Film',
                'slug' => 'film',
                'description' => 'Classification category for films.'
            ],
            [
                'name' => 'TV Series',
                'slug' => 'tv-series',
                'description' => 'Classification category for television series.'
            ],
            [
                'name' => 'Video Game',
                'slug' => 'video-game',
                'description' => 'Classification category for video games.'
            ],
            [
                'name' => 'Literature',
                'slug' => 'literature',
                'description' => 'Classification category for literature.'
            ],
            [
                'name' => 'Audio',
                'slug' => 'audio',
                'description' => 'Classification category for music.'
            ],
            [
                'name' => 'Advertisement Matterial',
                'slug' => 'advertisement-material',
                'description' => 'Classification category for advertisement materials.'
            ]
        ];
        foreach ($classificarionCategories as $category) {
            \Illuminate\Support\Facades\DB::table('classification_categories')->updateOrInsert(
                ['slug' => $category['slug']],
                $category
            );
        }
    }
}
