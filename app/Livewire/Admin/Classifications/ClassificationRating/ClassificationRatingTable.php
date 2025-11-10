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

    // Modal properties
    public $showViewModal = false;
    public $showCreateModal = false;
    public $showEditModal = false;

    public $viewRatingId = null;
    public $editRatingId = null;

    // Delete modal properties
    public $ratingToDelete = null;
    public $ratingToDeleteName = '';

    protected $listeners = [
        'closeViewModal' => 'closeViewModal',
        'closeCreateModal' => 'closeCreateModal',
        'closeEditModal' => 'closeEditModal',
        'editRating' => 'editRating',
        'ratingCreated' => 'handleRatingCreated',
        'ratingUpdated' => 'handleRatingUpdated',
    ];

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

    // View Modal Methods
    public function openViewModal($id)
    {
        $this->viewRatingId = $id;
        $this->showViewModal = true;
    }

    public function closeViewModal()
    {
        $this->showViewModal = false;
        $this->viewRatingId = null;
    }

    // Create Modal Methods
    public function openCreateModal()
    {
        $this->showCreateModal = true;
    }

    public function closeCreateModal()
    {
        $this->showCreateModal = false;
    }

    // Edit Modal Methods
    public function openEditModal($id)
    {
        $this->editRatingId = $id;
        $this->showEditModal = true;
    }

    public function closeEditModal()
    {
        $this->showEditModal = false;
        $this->editRatingId = null;
    }

    public function editRating($id)
    {
        $this->closeViewModal();
        $this->openEditModal($id);
    }

    // Handle successful operations
    public function handleRatingCreated()
    {
        $this->closeCreateModal();
        session()->flash('message', 'Classification rating created successfully!');
    }

    public function handleRatingUpdated()
    {
        $this->closeEditModal();
        session()->flash('message', 'Classification rating updated successfully!');
    }

    // Delete Modal Methods
    public function openDeleteModal($id)
    {
        $rating = ClassificationRating::findOrFail($id);
        $this->ratingToDelete = $rating->id;
        $this->ratingToDeleteName = $rating->rating;
        $this->dispatch('open-delete-modal');
    }

    public function closeDeleteModal()
    {
        $this->ratingToDelete = null;
        $this->ratingToDeleteName = '';
        $this->dispatch('close-delete-modal');
    }

    public function deleteRating()
    {
        try {
            $rating = ClassificationRating::findOrFail($this->ratingToDelete);
            $ratingName = $rating->rating;

            $rating->delete();

            session()->flash('message', "Rating {$ratingName} has been deleted successfully!");
            $this->closeDeleteModal();

        } catch (\Exception $e) {
            \Log::error('Failed to delete rating: ' . $e->getMessage());
            session()->flash('error', 'Failed to delete rating. Please try again.');
            $this->closeDeleteModal();
        }
    }

    public function toggleActive($id)
    {
        try {
            $rating = ClassificationRating::findOrFail($id);
            $rating->update(['is_active' => !$rating->is_active]);

            session()->flash('message', "Rating {$rating->rating} " . ($rating->is_active ? 'activated' : 'deactivated') . ' successfully!');
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to update rating status. Please try again.');
        }
    }

    public function render()
    {
        $query = ClassificationRating::when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('rating', 'like', '%' . $this->search . '%')
                      ->orWhere('slug', 'like', '%' . $this->search . '%');
                      //->orWhere('description', 'like', '%' . $this->search . '%');
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
            //'recent' => ClassificationRating::latest()->first(),
        ];

        return view('livewire.admin.classifications.classification-rating.classification-rating-table', [
            'classificationRatings' => $classificationRatings,
            'stats' => $stats,
        ]);
    }
}
