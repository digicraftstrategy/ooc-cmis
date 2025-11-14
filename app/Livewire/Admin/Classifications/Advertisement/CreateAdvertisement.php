<?php

namespace App\Livewire\Admin\Classifications\Advertisement;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\AdvertisementMatter;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class CreateAdvertisement extends Component
{
    use WithFileUploads;

    // FORM FIELDS
    public $advertising_matter;
    public $casts;
    public $director;
    public $producer;
    public $production_company;
    public $client_company;
    public $release_year;
    public $duration;
    public $genre;
    public $language;
    public $has_subtitle = false;
    public $brand_promoted;
    public $product_promoted;
    public $theme;
    public $poster_path;
    public $slug;

    public bool $autoSlug = true;

    /**
     * YEAR LIMITS
     */
    public function getReleaseYearConstraints()
    {
        $currentYear = date('Y');

        return [
            'maxYear' => $currentYear + 1,
            'minYear' => 1980, // advertisements rarely pre-1980
        ];
    }

    /**
     * VALIDATION RULES
     */
    protected function rules()
    {
        $years = $this->getReleaseYearConstraints();

        return [
            'advertising_matter' => 'required|string|max:255',
            'casts' => 'nullable|string|max:255',
            'director' => 'nullable|string|max:255',
            'producer' => 'nullable|string|max:255',
            'production_company' => 'nullable|string|max:255',
            'client_company' => 'nullable|string|max:255',

            'release_year' => 'nullable|integer|min:' . $years['minYear'] . '|max:' . $years['maxYear'],
            'duration' => 'nullable|integer|min:1|max:600', // ad content but can go long (10 mins)
            'genre' => 'nullable|string|max:255',
            'language' => 'nullable|string|max:255',

            'has_subtitle' => 'boolean',

            'brand_promoted' => 'nullable|string|max:255',
            'product_promoted' => 'nullable|string|max:255',
            'theme' => 'nullable|string',

            'poster_path' => 'nullable|mimes:pdf,mp4,mov,m4v,avi,mkv,jpeg,png|max:51200', // 50MB max

            'slug' => ['required', 'string', 'max:255', Rule::unique('advertisement_matters', 'slug')],
        ];
    }

    /**
     * CUSTOM ERROR MESSAGES
     */
    protected function messages()
    {
        $years = $this->getReleaseYearConstraints();

        return [
            'release_year.min' => "Release year cannot be earlier than {$years['minYear']}.",
            'release_year.max' => "Release year must not exceed {$years['maxYear']}.",

            'submission_file.mimes' => 'Accepted file types: PDF, MP4, MOV, M4V, AVI, MKV, JPEG, PNG.',
            'submission_file.max' => 'The uploaded file must not exceed 50MB.',

            'slug.unique' => 'This slug already exists. Please choose another.',
        ];
    }

    /**
     * AUTO-SLUG HANDLERS
     */
    public function updatedAdvertisingMatter($value)
    {
        if ($this->autoSlug) {
            $this->slug = Str::slug($value);
        }
    }

    public function updatedAutoSlug($value)
    {
        if ($value && $this->advertising_matter) {
            $this->slug = Str::slug($this->advertising_matter);
        }
    }

    public function updatedSlug($value)
    {
        if ($this->autoSlug && $value !== Str::slug($this->advertising_matter)) {
            $this->autoSlug = false;
        }
    }

    /**
     * SAVE ADVERTISEMENT MATTER
     */
    public function save()
    {
        $this->validate();

        try {
            $ad = new AdvertisementMatter();
            $ad->advertising_matter = $this->advertising_matter;
            $ad->main_actor_actress = $this->main_actor_actress;
            $ad->director = $this->director;
            $ad->producer = $this->producer;
            $ad->production_company = $this->production_company;
            $ad->client_company = $this->client_company;

            $ad->release_year = $this->release_year;
            $ad->duration = $this->duration;
            $ad->genre = $this->genre;
            $ad->language = $this->language;

            $ad->has_subtitle = $this->has_subtitle;
            $ad->brand_promoted = $this->brand_promoted;
            $ad->product_promoted = $this->product_promoted;
            $ad->theme = $this->theme;

            $ad->slug = $this->slug;

            // FILE UPLOAD
            if ($this->sposter_path) {
                $path = $this->poster_path->store('advertisements/submissions', 'public');
                $ad->poster_path_path = $path;
            }

            $ad->save();

            session()->flash('success', 'Advertisement registered successfully.');
            return redirect()->route('admin.classifications.advertisements');

        } catch (\Exception $e) {
            session()->flash('error', 'Error creating advertisement: ' . $e->getMessage());
        }
    }

    /**
     * RESET FORM
     */
    public function resetForm()
    {
        $this->reset();
        $this->resetValidation();
        $this->autoSlug = true;
    }

    /**
     * RENDER VIEW
     */
    public function render()
    {
        // Release years: from current year → 1980
        $currentYear = date('Y');
        $years = range($currentYear, 1980);

        // You may add predefined values later if needed
        $languages = config('filmvariables.languages');
        $genres = config('filmvariables.genres', []);

        return view('livewire.admin.classifications.advertisement.create-advertisement', [
            'years' => $years,
            'languages' => $languages,
            'genres' => $genres,
        ]);
    }
}
