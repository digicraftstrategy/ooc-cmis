<?php

namespace App\Livewire\Admin\Classifications\ClassificationRating;

use App\Models\ClassificationRating;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class CreateClassificationRating extends Component
{
    use WithFileUploads;

    public $rating;
    public $slug;
    public $description;
    public $icon_path;
    public $is_active = true;

    protected $rules = [
        'rating' => 'required|string|max:255|unique:classification_ratings,rating',
        'slug' => 'nullable|string|max:255|unique:classification_ratings,slug',
        'description' => 'nullable|string',
        'icon_path' => 'nullable|image|max:2048',
        'is_active' => 'boolean',
    ];

    public function updatedRating($value)
    {
        if (empty($this->slug)) {
            $this->slug = Str::slug($value);
        }
    }

    public function generateSlug()
    {
        $this->slug = Str::slug($this->rating);
    }

    public function save()
    {
        $this->validate();

        try {
            $iconPath = null;
            if ($this->icon_path) {
                $iconPath = $this->icon_path->store('ratingicons', 'public');
            }

            ClassificationRating::create([
                'rating' => $this->rating,
                'slug' => $this->slug,
                'description' => $this->description,
                'icon_path' => $iconPath,
                'is_active' => $this->is_active,
            ]);

            $this->reset();
            $this->dispatch('ratingCreated');

        } catch (\Exception $e) {
            session()->flash('error', 'Failed to create classification rating. Please try again.');
        }
    }

    public function closeModal()
    {
        $this->dispatch('closeCreateModal');
    }

    public function render()
    {
        return view('livewire.admin.classifications.classification-rating.create-classification-rating');
    }
}
