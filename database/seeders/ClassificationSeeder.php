<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Classification;
use App\Models\Film;
use App\Models\TvSeriesSeason;
use App\Models\Literature;
use App\Models\AdvertisementMatter;
use App\Models\Audio;
use App\Models\ClassificationRating;
use App\Models\ClassificationCategory;
use App\Models\TvSeries;

class ClassificationSeeder extends Seeder
{
    public function run(): void
    {
        // Get some rating & category (assumes their seeders ran first)
        $rating  = ClassificationRating::first();     // e.g. "PG", "M", etc.
        $category = ClassificationCategory::first();  // e.g. "Film", "TV Series", etc.

        if (! $rating || ! $category) {
            // Avoid crashing if those tables are empty
            return;
        }

        // Example 1: classify a Film
        if ($film = Film::first()) {
            Classification::create([
                'classification_reason'        => 'Mild violence, thematic elements',
                'classification_date'          => now(),
                'viewed_by'                    => 'Classification Officer 1',
                'second_opinion_by'            => 'Senior Officer',
                'notes'                        => 'Suitable for older children with parental guidance.',
                'classifiable_id'              => $film->id,
                'classifiable_type'            => Film::class,
                'classification_rating_id'     => $rating->id,
                'classification_category_id'   => $category->id,
            ]);
        }

        // Example 2: classify a Season (for TV series)
        if ($season = TvSeriesSeason::first()) {
            Classification::create([
                'classification_reason'        => 'Frequent violence and strong language',
                'classification_date'          => now(),
                'viewed_by'                    => 'Classification Officer 2',
                'second_opinion_by'            => null,
                'notes'                        => 'Restricted to adults only.',
                'classifiable_id'              => $season->id,
                'classifiable_type'            => TvSeriesSeason::class,
                'classification_rating_id'     => $rating->id,
                'classification_category_id'   => $category->id,
            ]);
        }

        // Example 3: classify a Literature
        if ($literature = Literature::first()) {
            Classification::create([
                'classification_reason'        => 'Mature themes and references',
                'classification_date'          => now(),
                'viewed_by'                    => 'Classification Officer 3',
                'second_opinion_by'            => null,
                'notes'                        => 'Recommended for mature readers.',
                'classifiable_id'              => $literature->id,
                'classifiable_type'            => Literature::class,
                'classification_rating_id'     => $rating->id,
                'classification_category_id'   => $category->id,
            ]);
        }

        // Example 4: classify an AdvertisementMatter
        if ($ad = AdvertisementMatter::first()) {
            Classification::create([
                'classification_reason'        => 'Promotional material with mild suggestive content',
                'classification_date'          => now(),
                'viewed_by'                    => 'Ads Classification Officer',
                'second_opinion_by'            => null,
                'notes'                        => 'Approved with time-of-day restrictions.',
                'classifiable_id'              => $ad->id,
                'classifiable_type'            => AdvertisementMatter::class,
                'classification_rating_id'     => $rating->id,
                'classification_category_id'   => $category->id,
            ]);
        }

        // Example 5: classify an Audio
        if ($audio = Audio::first()) {
            Classification::create([
                'classification_reason'        => 'Explicit lyrics',
                'classification_date'          => now(),
                'viewed_by'                    => 'Music Classification Officer',
                'second_opinion_by'            => null,
                'notes'                        => 'Label must display explicit-content warning.',
                'classifiable_id'              => $audio->id,
                'classifiable_type'            => Audio::class,
                'classification_rating_id'     => $rating->id,
                'classification_category_id'   => $category->id,
            ]);
        }
    }
}
