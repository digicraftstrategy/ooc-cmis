<?php

namespace App\Livewire\Admin\Classifications\ClassificationRating;

use App\Models\ClassificationRating;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class EditClassificationRating extends Component
{
    use WithFileUploads;

    public $ratingId;
    public $classificationRating;

    public $rating;
    public $slug;
    public $description;
    public $icon;
    public $existingIcon;
    public $is_active;

    protected $rules = [
        'rating' => 'required|string|max:255|unique:classification_ratings,rating,',
        'slug' => 'required|string|max:255|unique:classification_ratings,slug,',
        'description' => 'nullable|string',
        'icon' => 'nullable|image|max:2048',
        'is_active' => 'boolean',
    ];

    public function mount($ratingId)
    {
        $this->ratingId = $ratingId;
        $this->loadRating();
    }

    public function loadRating()
    {
        $this->classificationRating = ClassificationRating::findOrFail($this->ratingId);

        $this->rating = $this->classificationRating->rating;
        $this->slug = $this->classificationRating->slug;
        $this->description = $this->classificationRating->description;
        $this->existingIcon = $this->classificationRating->icon_path;
        $this->is_active = $this->classificationRating->is_active;
    }

    public function updatedRating($value)
    {
        if (empty($this->slug) || $this->slug === $this->classificationRating->slug) {
            $this->slug = Str::slug($value);
        }
    }

    public function generateSlug()
    {
        $this->slug = Str::slug($this->rating);
    }

    public function update()
    {
        // Update the unique validation rules with the current ID
        $this->rules['rating'] .= $this->ratingId;
        $this->rules['slug'] .= $this->ratingId;

        $this->validate();

        try {
            $iconPath = $this->existingIcon;

            if ($this->icon) {
                // Delete old icon if exists
                if ($this->existingIcon && \Storage::disk('public')->exists($this->existingIcon)) {
                    \Storage::disk('public')->delete($this->existingIcon);
                }
                $iconPath = $this->icon->store('classification-ratings', 'public');
            }

            $this->classificationRating->update([
                'rating' => $this->rating,
                'slug' => $this->slug,
                'description' => $this->description,
                'icon_path' => $iconPath,
                'is_active' => $this->is_active,
            ]);

            $this->dispatch('ratingUpdated');

        } catch (\Exception $e) {
            session()->flash('error', 'Failed to update classification rating. Please try again.');
        }
    }

    public function removeIcon()
    {
        if ($this->existingIcon && \Storage::disk('public')->exists($this->existingIcon)) {
            \Storage::disk('public')->delete($this->existingIcon);
        }

        $this->classificationRating->update(['icon_path' => null]);
        $this->existingIcon = null;
        $this->icon = null;

        session()->flash('message', 'Icon removed successfully!');
        $this->loadRating();
    }

    public function closeModal()
    {
        $this->dispatch('closeEditModal');
    }

    public function render()
    {
        return view('livewire.admin.classifications.classification-rating.edit-classification-rating');
    }
}
