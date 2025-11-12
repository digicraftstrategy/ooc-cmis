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
                'release_year' => 2008,
                'casts' => 'Bryan Cranston, Aaron Paul',
                'director' => 'Vince Gilligan',
                'producer' => 'Vince Gilligan, Mark Johnson',
                'production_company' => 'Sony Pictures Television',
                'genre' => 'Crime, Drama, Thriller',
                'language' => 'English',
                'has_subtitle' => true,
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
                'release_year' => 2016,
                'casts' => 'Millie Bobby Brown, Finn Wolfhard',
                'director' => 'The Duffer Brothers',
                'producer' => 'The Duffer Brothers, Shawn Levy',
                'production_company' => '21 Laps Entertainment, Monkey Massacre',
                'genre' => 'Drama, Fantasy, Horror',
                'language' => 'English',
                'has_subtitle' => false,
                'theme' => 'A group of kids in a small town uncover supernatural mysteries and government conspiracies.',
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
                'release_year' => 2011,
                'casts' => 'Emilia Clarke, Kit Harington',
                'director' => 'David Benioff, D.B. Weiss',
                'producer' => 'David Benioff, D.B. Weiss, Carolyn Strauss',
                'production_company' => 'HBO Entertainment',
                'genre' => 'Action, Adventure, Drama',
                'language' => 'English',
                'has_subtitle' => false,
                'theme' => 'Noble families vie for control of the Iron Throne while an ancient enemy threatens the realm.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // The Mandalorian
            [
                'tv_series_id' => $tv_serieses['The Mandalorian'],
                'season_title' => 'Season 2',
                'slug' => 'the-mandalorian-season-2',
                'season_number' => 3,
                'season_title' => 'The Search for Grogu',
                'number_of_episodes' => '1-8',
                'duration' => 40,
                'release_year' => 2019,
                'casts' => 'Pedro Pascal, Gina Carano',
                'director' => 'Jon Favreau',
                'producer' => 'Jon Favreau, Dave Filoni',
                'production_company' => 'Lucasfilm Ltd.',
                'genre' => 'Action, Adventure, Sci-Fi',
                'language' => 'English',
                'has_subtitle' => true,
                'theme' => "A lone bounty hunter in the outer reaches of the galaxy protects a mysterious child with extraordinary powers.",
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
                'release_year' => 1994,
                'casts' => 'Jennifer Aniston, Courteney Cox, Lisa Kudrow, Matt LeBlanc, Matthew Perry, David Schwimmer',
                'director' => 'Various Directors',
                'producer' => 'Kevin S. Bright, Marta Kauffman, David Crane',
                'production_company' => 'Bright/Kauffman/Crane Productions, Warner Bros. Television',
                'genre' => 'Comedy, Romance',
                'language' => 'English',
                'has_subtitle' => false,
                'theme' => "Follows the lives, relationships, and comedic adventures of six friends living in New York City.",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // The Friends
            [
                'tv_series_id' => $tv_serieses['Friends'],
                'season_title' => 'The One with the Reunion',
                'slug' => 'friends-the-one-with-the-reunion',
                'season_number' => 10,
                'number_of_episodes' => '1-18',
                'duration' => 22,
                'release_year' => 1994,
                'casts' => 'Jennifer Aniston, Courteney Cox, Lisa Kudrow, Matt LeBlanc, Matthew Perry, David Schwimmer',
                'director' => 'Various Directors',
                'producer' => 'Kevin S. Bright, Marta Kauffman, David Crane',
                'production_company' => 'Bright/Kauffman/Crane Productions, Warner Bros. Television',
                'genre' => 'Comedy, Romance',
                'language' => 'English',
                'has_subtitle' => false,
                'theme' => "Follows the lives, relationships, and comedic adventures of six friends living in New York City.",
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
                'release_year' => 2019,
                'casts' => 'Henry Cavill, Anya Chalotra',
                'director' => 'Lauren Schmidt Hissrich',
                'producer' => 'Lauren Schmidt Hissrich, Sean Daniel',
                'production_company' => 'Netflix, Sean Daniel Company',
                'genre' => 'Action, Adventure, Drama',
                'language' => 'English',
                'has_subtitle' => false,
                'theme' => "A monster hunter navigates a world of magic, political intrigue, and dark forces while protecting those in need.",
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}
