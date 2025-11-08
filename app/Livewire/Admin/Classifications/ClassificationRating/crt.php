<?php

namespace App\Livewire\Admin\Classifications\ClassificationRating;

use App\Models\ClassificationRating;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class ClassificationRatingTable extends Component
{
    use WithPagination;

    public $search = '';
    public $sortField = 'rating';
    public $sortDirection = 'asc';
    public $activeFilter = 'all';

    // Delete modal properties
    public $showDeleteModal = false;
    public $ratingToDelete = null;
    public $ratingToDeleteName = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'sortField' => ['except' => 'rating'],
        'sortDirection' => ['except' => 'asc'],
        'activeFilter' => ['except' => 'all'],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingActiveFilter()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }

    public function openCreateModal()
    {
        $this->dispatch('openCreateModal');
    }

    public function openViewModal($id)
    {
        $this->dispatch('openViewModal', id: $id);
    }

    public function openEditModal($id)
    {
        $this->dispatch('openEditModal', id: $id);
    }

    public function openDeleteModal($id)
    {
        $rating = ClassificationRating::findOrFail($id);
        $this->ratingToDelete = $rating->id;
        $this->ratingToDeleteName = $rating->rating;
        $this->showDeleteModal = true;
    }

    public function closeDeleteModal()
    {
        $this->showDeleteModal = false;
        $this->ratingToDelete = null;
        $this->ratingToDeleteName = '';
    }

    public function deleteRating()
    {
        try {
            $rating = ClassificationRating::findOrFail($this->ratingToDelete);
            $ratingName = $rating->rating;

            // Check if rating can be deleted (no associated films)
            if (!$rating->canBeDeleted()) {
                session()->flash('error', "Cannot delete {$ratingName} because it is being used by films.");
                $this->closeDeleteModal();
                return;
            }

            $rating->delete();

            session()->flash('message', "Rating {$ratingName} has been deleted successfully!");
            $this->closeDeleteModal();

            // Reset page if we're on the last page and it becomes empty
            if ($this->classificationRatings->isEmpty() && $this->page > 1) {
                $this->page = max(1, $this->page - 1);
            }

        } catch (\Exception $e) {
            session()->flash('error', 'Failed to delete rating. Please try again.');
            $this->closeDeleteModal();
        }
    }

    public function toggleActive($id)
    {
        $rating = ClassificationRating::findOrFail($id);
        $rating->update(['is_active' => !$rating->is_active]);

        $this->dispatch('notify', [
            'type' => 'success',
            'message' => "Rating {$rating->rating} " . ($rating->is_active ? 'activated' : 'deactivated') . ' successfully!'
        ]);
    }

    public function render()
    {
        $query = ClassificationRating::when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('rating', 'like', '%' . $this->search . '%')
                      ->orWhere('slug', 'like', '%' . $this->search . '%')
                      ->orWhere('description', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->activeFilter !== 'all', function ($query) {
                $query->where('is_active', $this->activeFilter === 'active');
            });

        $classificationRatings = $query->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

        // Stats for the cards
        $stats = [
            'total' => ClassificationRating::count(),
            'active' => ClassificationRating::active()->count(),
            'inactive' => ClassificationRating::where('is_active', false)->count(),
            'recent' => ClassificationRating::latest()->first(),
        ];

        return view('livewire.admin.classifications.classification-rating.classification-rating-table', [
            'classificationRatings' => $classificationRatings,
            'stats' => $stats,
        ]);
    }
}
