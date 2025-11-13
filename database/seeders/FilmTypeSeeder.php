<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FilmTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB:: table('film_types')->insert(
            [
                [
                    'type' => 'Single',
                    'slug' => 'single',
                    'description' => 'A film released as a standalone production.',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'type' => 'Sequel',
                    'slug' => 'sequel',
                    'description' => 'A film that continues the story or expands upon the original film.',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],/*
                [
                    'type' => 'Feature Film',
                    'slug' => 'feature-film',
                    'description' => 'A full-length film intended as the main attraction of a cinema program.',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'type' => 'Short Film',
                    'slug' => 'short-film',
                    'description' => 'A film that is shorter in length than a feature film, typically under 40 minutes.',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'type' => 'Documentary',
                    'slug' => 'documentary',
                    'description' => 'A non-fictional film intended to document reality for instruction, education, or maintaining a historical record.',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'type' => 'Animated Film',
                    'slug' => 'animated-film',
                    'description' => 'A film created using animation techniques, often aimed at children but also enjoyed by adults.',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],*/
        ]);
    }
}
