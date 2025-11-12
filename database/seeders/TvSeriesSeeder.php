<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TvSeriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tv_serieses')->insert([
            [
                'tv_series_title' => 'Breaking Bad',
                'slug' => 'breaking-bad',
                /*'season_number' => 5,
                'season_title' => 'Final Season',
                'number_of_episodes' => '1-16',
                'duration' => 47,
                'casts' => 'Bryan Cranston, Aaron Paul',
                'director' => 'Vince Gilligan',
                'producer' => 'Vince Gilligan, Mark Johnson',
                'production_company' => 'Sony Pictures Television',
                'language' => 'English',
                'theme' => 'A high school chemistry teacher turned methamphetamine manufacturer navigates the dangers of the drug trade.',
                'release_year' => 2008,
                'genre' => 'Crime, Drama, Thriller',*/
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tv_series_title' => 'Stranger Things',
                'slug' => 'stranger-things',
                /*'season_number' => 4,
                'season_title' => 'The Upside Down',
                'number_of_episodes' => '1-9',
                'duration' => 50,
                'casts' => 'Millie Bobby Brown, Finn Wolfhard',
                'director' => 'The Duffer Brothers',
                'producer' => 'The Duffer Brothers, Shawn Levy',
                'production_company' => '21 Laps Entertainment, Monkey Massacre',
                'language' => 'English',
                'theme' => 'A group of kids in a small town uncover supernatural mysteries and government conspiracies.',
                'release_year' => 2016,
                'genre' => 'Drama, Fantasy, Horror',*/
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tv_series_title' => 'Game of Thrones',
                'slug' => 'game-of-thrones',
                /*'season_number' => 8,
                'season_title' => 'The Final Battle',
                'number_of_episodes' => '1-6',
                'duration' => 57,
                'casts' => 'Emilia Clarke, Kit Harington',
                'director' => 'David Benioff, D.B. Weiss',
                'producer' => 'David Benioff, D.B. Weiss, Carolyn Strauss',
                'production_company' => 'HBO Entertainment',
                'language' => 'English',
                'theme' => 'Noble families vie for control of the Iron Throne while an ancient enemy threatens the realm.',
                'release_year' => 2011,
                'genre' => 'Action, Adventure, Drama',*/
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tv_series_title' => 'The Mandalorian',
                'slug' => 'the-mandalorian',
                //'season_number' => 3,
                //'season_title' => 'The Search for Grogu',
                //'number_of_episodes' => '1-8',
                /*'duration' => 40,
                'casts' => 'Pedro Pascal, Gina Carano',
                'director' => 'Jon Favreau',
                'producer' => 'Jon Favreau, Dave Filoni',
                'production_company' => 'Lucasfilm Ltd.',
                'language' => 'English',
                'theme' => "A lone bounty hunter in the outer reaches of the galaxy protects a mysterious child with extraordinary powers.",
                'release_year' => 2019,
                'genre' => 'Action, Adventure, Sci-Fi',*/
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tv_series_title' => 'The Crown',
                'slug' => 'the-crown',
                /*'season_number' => 5,
                'season_title' => 'New Beginnings',
                'number_of_episodes' => '1-10',
                'duration' => 58,
                'casts' => 'Olivia Colman, Tobias Menzies',
                'director' => 'Peter Morgan',
                'producer' => 'Peter Morgan, Suzanne Mackie',
                'production_company' => 'Left Bank Pictures',
                'language' => 'English',
                'theme' => "A dramatized history of the reign of Queen Elizabeth II, exploring political and personal events.",
                'release_year' => 2016,
                'genre' => 'Biography, Drama, History',*/
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tv_series_title' => 'Friends',
                'slug' => 'friends',
                /*'season_number' => 10,
                'season_title' => 'The One with the Reunion',
                'number_of_episodes' => '1-18',
                'duration' => 22,
                'casts' => 'Jennifer Aniston, Courteney Cox, Lisa Kudrow, Matt LeBlanc, Matthew Perry, David Schwimmer',
                'director' => 'Various Directors',
                'producer' => 'Kevin S. Bright, Marta Kauffman, David Crane',
                'production_company' => 'Bright/Kauffman/Crane Productions, Warner Bros. Television',
                'language' => 'English',
                'theme' => "Follows the lives, relationships, and comedic adventures of six friends living in New York City.",
                'release_year' => 1994,
                'genre' => 'Comedy, Romance',*/
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tv_series_title' => 'The Witcher',
                'slug' => 'the-witcher',
                //'season_number' => 3,
                //'season_title' => 'Blood Origin',
                //'number_of_episodes' => '1-8',
                //'duration' => 60,
                /*'casts' => 'Henry Cavill, Anya Chalotra',
                'director' => 'Lauren Schmidt Hissrich',
                'producer' => 'Lauren Schmidt Hissrich, Sean Daniel',
                'production_company' => 'Netflix, Sean Daniel Company',
                'language' => 'English',
                'theme' => "A monster hunter navigates a world of magic, political intrigue, and dark forces while protecting those in need.",
                'release_year' => 2019,
                'genre' => 'Action, Adventure, Drama',*/
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
