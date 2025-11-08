<?php

namespace App\Livewire\Admin\Classifications\ClassificationRating;

use App\Models\ClassificationRating;
use Livewire\Component;

class ViewClassificationRating extends Component
{
    public $ratingId;
    public $classificationRating;

    public function mount($ratingId)
    {
        $this->ratingId = $ratingId;
        $this->loadRating();
    }

    public function loadRating()
    {
        $this->classificationRating = ClassificationRating::findOrFail($this->ratingId);
    }

    public function closeModal()
    {
        $this->dispatch('closeViewModal');
    }

    public function editRating()
    {
        $this->dispatch('editRating', id: $this->ratingId);
    }

    public function render()
    {
        return view('livewire.admin.classifications.classification-rating.view-classification-rating');
    }
}
