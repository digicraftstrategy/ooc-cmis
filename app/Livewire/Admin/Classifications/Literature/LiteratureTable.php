<?php

namespace App\Livewire\Admin\Classifications\Literature;

use App\Models\Literature;
use Livewire\Component;
use Livewire\WithPagination;

class LiteratureTable extends Component
{
    use WithPagination;

    public $search = '';
    public $sortField = 'literature_title';
    public $sortDirection = 'asc';
    public $perPage = 10;

    public $showDeleteModal = false;
    public $selectedLiterature = null;

    protected $queryString = [
        'search'        => ['except' => ''],
        'sortField'     => ['except' => 'literature_title'],
        'sortDirection' => ['except' => 'asc'],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField     = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function openDeleteModal($id)
    {
        $this->selectedLiterature = Literature::findOrFail($id);
        $this->showDeleteModal    = true;
    }

    public function closeDeleteModal()
    {
        $this->selectedLiterature = null;
        $this->showDeleteModal    = false;
    }

    public function deleteGame()
    {
        try {
            $this->selectedLiterature->delete();

            $this->closeDeleteModal();
            session()->flash('success', 'Literature deleted successfully.');
        } catch (\Exception $e) {
            session()->flash('error', 'Error deleting literature: ' . $e->getMessage());
        }
    }

    /**
     * Shared base query so table + stats use the same filters.
     */
    protected function getBaseQuery()
    {
        $term = '%' . $this->search . '%';

        return Literature::query()
            ->when($this->search, function ($q) use ($term) {
                $q->where(function ($qq) use ($term) {
                    $qq->where('literature_title', 'like', $term)
                       ->orWhere('author', 'like', $term)
                       ->orWhere('publisher', 'like', $term)
                       ->orWhere('genre', 'like', $term)
                       ->orWhere('summary', 'like', $term);
                });
            });
    }

    public function render()
    {
        $baseQuery = $this->getBaseQuery();

        $literatures = (clone $baseQuery)
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        $stats = [
            'total'        => (clone $baseQuery)->count(),
            'classified'   => (clone $baseQuery)
                ->where('has_classified', true)
                ->count(),
            'unclassified' => (clone $baseQuery)
                ->where(function ($q) {
                    $q->where('has_classified', false)
                      ->orWhereNull('has_classified');
                })
                ->count(),
            'recent'       => (clone $baseQuery)->latest()->first(),
        ];

        return view('livewire.admin.classifications.literature.literature-table', [
            'literatures' => $literatures,
            'stats'       => $stats,
        ]);
    }
}
