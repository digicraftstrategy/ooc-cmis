<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LiteratureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('literatures')->insert([
            [
                'literature_title'  => 'Guardians of the Coral Sea',
                'slug'              => 'guardians-of-the-coral-sea',
                'author'            => 'Maria Sungi',
                'publisher'         => 'Pacific Horizon Press',
                'publication_year'  => 2018,
                'pages'             => 312,
                'genre'             => 'Environmental Fiction',
                'summary'           => 'A coastal village in Papua New Guinea fights to protect its reef and culture as foreign mining interests move in.',
                'cover_art_path'    => 'literatures/covers/guardians-of-the-coral-sea.jpg',
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'literature_title'  => 'Voices from the Highlands',
                'slug'              => 'voices-from-the-highlands',
                'author'            => 'Peter Wari',
                'publisher'         => 'Kumul Story House',
                'publication_year'  => 2015,
                'pages'             => 248,
                'genre'             => 'Short Stories',
                'summary'           => 'An anthology of interconnected short stories capturing humour, conflict and change in the PNG Highlands.',
                'cover_art_path'    => 'literatures/covers/voices-from-the-highlands.jpg',
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'literature_title'  => 'The Last Canoe Builder',
                'slug'              => 'the-last-canoe-builder',
                'author'            => 'Kelvin Nali',
                'publisher'         => 'Island Vision Publishing',
                'publication_year'  => 2020,
                'pages'             => 196,
                'genre'             => 'Historical Fiction',
                'summary'           => 'A young man must choose between modern education and the ancient craft of war canoe building in the islands.',
                'cover_art_path'    => 'literatures/covers/the-last-canoe-builder.jpg',
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'literature_title'  => 'Smoke Over Waigani',
                'slug'              => 'smoke-over-waigani',
                'author'            => 'Angela Ramo',
                'publisher'         => 'Morauta Street Books',
                'publication_year'  => 2019,
                'pages'             => 334,
                'genre'             => 'Political Thriller',
                'summary'           => 'A junior policy officer uncovers a conspiracy that links street crime, resource deals and the corridors of power.',
                'cover_art_path'    => 'literatures/covers/smoke-over-waigani.jpg',
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'literature_title'  => 'Tides of the Sepik',
                'slug'              => 'tides-of-the-sepik',
                'author'            => 'Lucy Aihi',
                'publisher'         => 'Riverbend Publications',
                'publication_year'  => 2012,
                'pages'             => 280,
                'genre'             => 'Literary Fiction',
                'summary'           => 'Following three generations along the Sepik River as they navigate colonialism, independence and modern trade.',
                'cover_art_path'    => 'literatures/covers/tides-of-the-sepik.jpg',
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'literature_title'  => 'City of Betelnut Lights',
                'slug'              => 'city-of-betelnut-lights',
                'author'            => 'Henry Garo',
                'publisher'         => 'Port Moresby Creative Press',
                'publication_year'  => 2021,
                'pages'             => 223,
                'genre'             => 'Urban Drama',
                'summary'           => 'A group of young friends hustling in downtown Port Moresby face choices that will define their futures.',
                'cover_art_path'    => 'literatures/covers/city-of-betelnut-lights.jpg',
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'literature_title'  => 'Drums of the Cloud Forest',
                'slug'              => 'drums-of-the-cloud-forest',
                'author'            => 'Rita Dom',
                'publisher'         => 'Highlands Ridge Press',
                'publication_year'  => 2010,
                'pages'             => 261,
                'genre'             => 'Adventure',
                'summary'           => 'Two siblings trek into the cloud forests to retrieve a stolen clan drum and restore peace to their village.',
                'cover_art_path'    => 'literatures/covers/drums-of-the-cloud-forest.jpg',
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'literature_title'  => 'Shell Money & Smartphones',
                'slug'              => 'shell-money-and-smartphones',
                'author'            => 'Linda Pange',
                'publisher'         => 'New Pacific Essays',
                'publication_year'  => 2017,
                'pages'             => 189,
                'genre'             => 'Essays',
                'summary'           => 'A collection of essays exploring culture, technology and identity in a rapidly changing Melanesia.',
                'cover_art_path'    => 'literatures/covers/shell-money-and-smartphones.jpg',
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'literature_title'  => 'The Sky Road to Hela',
                'slug'              => 'the-sky-road-to-hela',
                'author'            => 'Simon Koivi',
                'publisher'         => 'Southern Highlands Press',
                'publication_year'  => 2014,
                'pages'             => 305,
                'genre'             => 'Road Novel',
                'summary'           => 'A long, dangerous road trip from Lae to Hela becomes a journey of reconciliation for a divided family.',
                'cover_art_path'    => 'literatures/covers/the-sky-road-to-hela.jpg',
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'literature_title'  => 'Moonlight over Kokoda Ridge',
                'slug'              => 'moonlight-over-kokoda-ridge',
                'author'            => 'John Kila',
                'publisher'         => 'Coral Reef Publishing',
                'publication_year'  => 2016,
                'pages'             => 274,
                'genre'             => 'War Memoir',
                'summary'           => 'Interwoven memories of a PNG veteran and an Australian trekker retracing the Kokoda Track decades later.',
                'cover_art_path'    => 'literatures/covers/moonlight-over-kokoda-ridge.jpg',
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
        ]);
    }
}
