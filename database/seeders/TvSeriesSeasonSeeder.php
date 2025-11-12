<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TvSeriesSeasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tv_serieses = DB::table('tv_serieses')->pluck('id', 'tv_series_title');

        DB::table('seasons')->insert([
            // Breaking Bad
            [
                'tv_series_id' => $tv_serieses['Breaking Bad'],
                'season_title' => 'Final Season',
                'slug' => 'breaking-bad-final-season',
                'season_number' => 5,
                'number_of_episodes' => '1-16',
                'duration' => 47,
                'theme' => 'A high school chemistry teacher turned methamphetamine manufacturer navigates the dangers of the drug trade.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Stranger Things
            [
                'tv_series_id' => $tv_serieses['Stranger Things'],
                'season_title' => 'The Upside Down',
                'slug' => 'stranger-things-the-upside-down',
                'season_number' => 4,
                'number_of_episodes' => '1-9',
                'duration' => 45,
                'theme' => 'A small town in the middle of the woods is stalked by a group of supernatural creatures.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Game of Thrones
            [
                'tv_series_id' => $tv_serieses['Game of Thrones'],
                'season_title' => 'The Iron Throne',
                'slug' => 'game-of-thrones-the-iron-throne',
                'season_number' => 8,
                'number_of_episodes' => '1-8',
                'duration' => 50,
                'theme' => 'A war for control over the Seven Kingdoms begins.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // The Mandalorian
            [
                'tv_series_id' => $tv_serieses['The Mandalorian'],
                'season_title' => 'Season 2',
                'slug' => 'the-mandalorian-season-2',
                'season_number' => 2,
                'number_of_episodes' => '1-8',
                'duration' => 45,
                'theme' => 'A bounty hunter and a bounty hunter\'s son search for a legendary relic that has the power to change people\'s destiny.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // The Crown
            [
                'tv_series_id' => $tv_serieses['The Crown'],
                'season_title' => 'Season 5',
                'slug' => 'the-crown-season-5',
                'season_number' => 5,
                'number_of_episodes' => '1-8',
                'duration' => 50,
                'theme' => 'The political world of England during the reign of Elizabeth I.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // The Friends
            [
                'tv_series_id' => $tv_serieses['Friends'],
                'season_title' => 'Season 10',
                'slug' => 'friends-season-10',
                'season_number' => 10,
                'number_of_episodes' => '1-18',
                'duration' => 45,
                'theme' => 'A group of friends go through life together.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // The Witcher
            [
                'tv_series_id' => $tv_serieses['The Witcher'],
                'season_title' => 'Season 3',
                'slug' => 'the-witcher-season-3',
                'season_number' => 3,
                'number_of_episodes' => '1-8',
                'duration' => 45,
                'theme' => 'A young witch goes on a quest to find the origin of a legendary family curse.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}
