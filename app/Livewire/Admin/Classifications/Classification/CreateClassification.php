<?php

namespace App\Livewire\Admin\Classifications\Classification;

use Livewire\Component;
use App\Models\Classification;
use App\Models\Film;
use App\Models\TvSeriesSeason;
use App\Models\Literature;
use App\Models\AdvertisementMatter;
use App\Models\Audio;
use App\Models\ClassificationRating;
use App\Models\ClassificationCategory;
use App\Models\VideoGaming;

class CreateClassification extends Component
{
    public $classification_reason;
    public $classification_date;
    public $viewed_by;
    public $is_second_opinion = false;
    public $second_opinion_by;
    public $classification_status = 'Approved';
    public $notes;

    public $classifiable_type = '';
    public $classifiable_id;

    public $classification_rating_id;
    public $classification_category_id;

    // For dropdowns
    public $mediaTypes = [];
    public $items = [];
    public $ratings = [];
    public $categories = [];

    public function mount()
    {
        // Options for the "type" dropdown
        $this->mediaTypes = [
            'film'                 => 'Film',
            'season'               => 'TV Series',
            'literature'           => 'Literature',
            'advertisement_matter' => 'Advertisement',
            'audio'                => 'Audio',
            'video_gaming'         => 'Video Gaming',
        ];

        $this->ratings    = ClassificationRating::where('is_active', true)->orderBy('rating')->get();
        $this->categories = ClassificationCategory::orderBy('name')->get();

        // Default classification date to today
        $this->classification_date = now()->toDateString();
    }

    protected function rules()
    {
        return [
            'classifiable_type'           => 'required|string',
            'classifiable_id'             => 'required|integer',
            'classification_rating_id'    => 'required|exists:classification_ratings,id',
            'classification_category_id'  => 'required|exists:classification_categories,id',
            'classification_reason'       => 'nullable|string',
            'classification_date'         => 'nullable|date',
            'viewed_by'                   => 'nullable|string|max:255',
            'is_second_opinion'           => 'boolean',
            'second_opinion_by'           => 'nullable|string|max:255',
            'classification_status'       => 'required|in:Approved,Rejected',
            'notes'                       => 'nullable|string',
        ];
    }

    /**
     * When the user changes the type dropdown, reload the list of items.
     */
    public function updatedClassifiableType($value)
    {
        $this->classifiable_id = null;
        $this->items = $this->loadItemsForType($value);
    }

    /**
     * Reset second opinion fields when checkbox is unchecked.
     */
    public function updatedIsSecondOpinion($value)
    {
        if (! $value) {
            $this->second_opinion_by = null;
        }
    }

    /**
     * Load ONLY unclassified items for the selected type.
     */
    protected function loadItemsForType(string $type)
    {
        $class = $this->resolveClassFromType($type);

        if (! $class) {
            return collect();
        }

        // Expect each model to have: public function classification(): MorphOne
        // This ensures items that already have a classification are NOT shown.
        return $class::whereDoesntHave('classification')
            ->orderBy('id', 'desc')
            ->get();
    }

    /**
     * Map the simple type string to the actual model class.
     */
    protected function resolveClassFromType(?string $type): ?string
    {
        return match ($type) {
            'film'                 => Film::class,
            'season'               => TvSeriesSeason::class,
            'literature'           => Literature::class,
            'advertisement_matter' => AdvertisementMatter::class,
            'audio'                => Audio::class,
            'video_gaming'         => VideoGaming::class,
            default                => null,
        };
    }

    public function save()
    {
        $this->validate();

        $class = $this->resolveClassFromType($this->classifiable_type);

        if (! $class) {
            $this->addError('classifiable_type', 'Invalid classified item type selected.');
            return;
        }

        $classification = Classification::updateOrCreate(
            [
                'classifiable_id'   => $this->classifiable_id,
                'classifiable_type' => $class,
            ],
            [
                'classification_reason'      => $this->classification_reason,
                'classification_date'        => $this->classification_date ?? now(),
                'viewed_by'                  => $this->viewed_by,
                'is_second_opinion'          => $this->is_second_opinion,
                'second_opinion_by'          => $this->second_opinion_by,
                'classification_status'      => $this->classification_status,
                'notes'                      => $this->notes,
                'classification_rating_id'   => $this->classification_rating_id,
                'classification_category_id' => $this->classification_category_id,
            ]
        );

        session()->flash(
            'message',
            $classification->wasRecentlyCreated
                ? 'Classification created successfully.'
                : 'Classification updated successfully.'
        );

        // Reset form fields and item list
        $this->reset([
            'classification_reason',
            'classification_date',
            'viewed_by',
            'is_second_opinion',
            'second_opinion_by',
            'classification_status',
            'notes',
            'classifiable_type',
            'classifiable_id',
            'classification_rating_id',
            'classification_category_id',
            'items',
        ]);

        // Optional: re-set default status/date
        $this->classification_status = 'Approved';
        $this->classification_date   = now()->toDateString();
    }

    public function render()
    {
        // Ensure these are always Collections for the Blade helpers (firstWhere, etc.)
        if (! $this->items instanceof \Illuminate\Support\Collection) {
            $this->items = collect($this->items);
        }

        if (! $this->ratings instanceof \Illuminate\Support\Collection) {
            $this->ratings = collect($this->ratings);
        }

        if (! $this->categories instanceof \Illuminate\Support\Collection) {
            $this->categories = collect($this->categories);
        }
        return view('livewire.admin.classifications.classification.create-classification', [
            'mediaTypes' => $this->mediaTypes,
            'items'      => $this->items,
            'ratings'    => $this->ratings,
            'categories' => $this->categories,
        ]);
    }
}
