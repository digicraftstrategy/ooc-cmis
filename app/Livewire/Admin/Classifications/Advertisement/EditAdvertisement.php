<?php

namespace App\Livewire\Admin\Classifications\Advertisement;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\AdvertisementMatter;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class EditAdvertisement extends Component
{
    use WithFileUploads;

    /** @var \App\Models\AdvertisementMatter */
    public $advertisement;

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
    public $slug;

    // Multi-attachments (Option A — one field)
    public $poster_path = []; // array of UploadedFile instances

    public bool $autoSlug = true;

    /**
     * YEAR LIMITS
     */
    public function getReleaseYearConstraints()
    {
        $currentYear = date('Y');

        return [
            'maxYear' => $currentYear + 1,
            'minYear' => 1980,
        ];
    }

    /**
     * MOUNT WITH ROUTE PARAM
     */
    public function mount($id)
    {
        $this->advertisement = AdvertisementMatter::findOrFail($id);

        // Prefill fields from model
        $this->advertising_matter = $this->advertisement->advertising_matter;
        $this->casts              = $this->advertisement->casts;
        $this->director           = $this->advertisement->director;
        $this->producer           = $this->advertisement->producer;
        $this->production_company = $this->advertisement->production_company;
        $this->client_company     = $this->advertisement->client_company;

        $this->release_year       = $this->advertisement->release_year;
        $this->duration           = $this->advertisement->duration;
        $this->genre              = $this->advertisement->genre;
        $this->language           = $this->advertisement->language;

        $this->has_subtitle       = (bool) $this->advertisement->has_subtitle;
        $this->brand_promoted     = $this->advertisement->brand_promoted;
        $this->product_promoted   = $this->advertisement->product_promoted;
        $this->theme              = $this->advertisement->theme;

        $this->slug               = $this->advertisement->slug;

        // Editing existing record – don’t auto-overwrite slug unless user turns it on
        $this->autoSlug = false;
    }

    /**
     * VALIDATION RULES
     */
    protected function rules()
    {
        $years = $this->getReleaseYearConstraints();

        return [
            'advertising_matter' => 'required|string|max:255',
            'casts'              => 'nullable|string|max:255',
            'director'           => 'nullable|string|max:255',
            'producer'           => 'nullable|string|max:255',
            'production_company' => 'nullable|string|max:255',
            'client_company'     => 'nullable|string|max:255',

            'release_year'       => 'nullable|integer|min:' . $years['minYear'] . '|max:' . $years['maxYear'],
            'duration'           => 'nullable|integer|min:1|max:600',
            'genre'              => 'nullable|string|max:255',
            'language'           => 'nullable|string|max:255',

            'has_subtitle'       => 'boolean',

            'brand_promoted'     => 'nullable|string|max:255',
            'product_promoted'   => 'nullable|string|max:255',
            'theme'              => 'nullable|string',

            // Option A — one multi-upload field
            'poster_path.*'      => 'nullable|mimes:pdf,mp4,mov,m4v,avi,mkv,jpeg,jpg,png|max:51200',

            'slug'               => [
                'required',
                'string',
                'max:255',
                Rule::unique('advertisement_matters', 'slug')->ignore($this->advertisement->id),
            ],
        ];
    }

    /**
     * CUSTOM MESSAGES
     */
    protected function messages()
    {
        $years = $this->getReleaseYearConstraints();

        return [
            'release_year.min'      => "Release year cannot be earlier than {$years['minYear']}.",
            'release_year.max'      => "Release year must not exceed {$years['maxYear']}.",

            'poster_path.*.mimes'   => 'Accepted file types: PDF, MP4, MOV, M4V, AVI, MKV, JPEG, JPG, PNG.',
            'poster_path.*.max'     => 'Each uploaded file must not exceed 50MB.',

            'slug.unique'           => 'This slug already exists. Please choose another.',
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
     * UPDATE ADVERTISEMENT MATTER
     */
    public function save()
    {
        $this->validate();

        try {
            $ad = $this->advertisement;

            $ad->advertising_matter = $this->advertising_matter;
            $ad->casts              = $this->casts;
            $ad->director           = $this->director;
            $ad->producer           = $this->producer;
            $ad->production_company = $this->production_company;
            $ad->client_company     = $this->client_company;

            $ad->release_year       = $this->release_year;
            $ad->duration           = $this->duration;
            $ad->genre              = $this->genre;
            $ad->language           = $this->language;

            $ad->has_subtitle       = $this->has_subtitle;
            $ad->brand_promoted     = $this->brand_promoted;
            $ad->product_promoted   = $this->product_promoted;
            $ad->theme              = $this->theme;

            $ad->slug               = $this->slug;

            // HANDLE NEW ATTACHMENTS (Option A)
            if (!empty($this->poster_path)) {
                // If you are storing only one main file path in DB, replace it with the first uploaded file
                if ($ad->poster_path && Storage::disk('public')->exists($ad->poster_path)) {
                    Storage::disk('public')->delete($ad->poster_path);
                }

                // Store the first file as the primary poster_path
                $firstFile = $this->poster_path[0];
                $stored    = $firstFile->store('advertisements/submissions', 'public');
                $ad->poster_path = $stored;

                // If you later add an attachments table, you could loop through all files here
            }

            $ad->save();

            session()->flash('success', 'Advertisement updated successfully.');
            return redirect()->route('admin.classifications.advertisements');

        } catch (\Exception $e) {
            session()->flash('error', 'Error updating advertisement: ' . $e->getMessage());
        }
    }

    /**
     * RESET FORM (rarely used on edit, but handy)
     */
    public function resetForm()
    {
        $this->resetValidation();
        $this->mount($this->advertisement->id); // reload from DB
        $this->poster_path = [];
        $this->autoSlug = false;
    }

    /**
     * RENDER VIEW
     */
    public function render()
    {
        $currentYear = date('Y');
        $years = range($currentYear, 1980);

        $languages = config('filmvariables.languages');
        $genres    = config('filmvariables.genres', []);

        return view('livewire.admin.classifications.advertisement.edit-advertisement', [
            'years'     => $years,
            'languages' => $languages,
            'genres'    => $genres,
        ]);
    }
}
