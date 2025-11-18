<?php

namespace App\Livewire\Admin\Classifications\Advertisement;

use App\Models\AdvertisementMatter;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;

class AdvertisementTable extends Component
{
    use WithPagination;

    public $search = '';
    public $advertisementTitleFilter = ''; // (not used yet, but kept)
    public $sortField = 'advertising_matter';
    public $sortDirection = 'asc';
    public $perPage = 10;

    public $showEditModal = false;
    public $showDeleteModal = false;
    public $showViewModal = false;

    public $selectedAdvertisement = null;

    protected $queryString = [
        'search'                  => ['except' => ''],
        'advertisementTitleFilter'=> ['except' => ''],
        'sortField'               => ['except' => 'advertising_matter'],
        'sortDirection'           => ['except' => 'asc'],
    ];

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }

    public function openDeleteModal($advertisementId)
    {
        $this->selectedAdvertisement = AdvertisementMatter::findOrFail($advertisementId);
        $this->showDeleteModal = true;
    }

    public function closeDeleteModal()
    {
        $this->selectedAdvertisement = null;
        $this->showDeleteModal = false;
    }

    public function deleteAdvertisement()
    {
        try {
            if (
                $this->selectedAdvertisement->submission_file_path &&
                Storage::exists($this->selectedAdvertisement->submission_file_path)
            ) {
                Storage::delete($this->selectedAdvertisement->submission_file_path);
            }

            $this->selectedAdvertisement->delete();

            $this->closeDeleteModal();
            session()->flash('success', 'Advertisement deleted successfully.');
        } catch (\Exception $e) {
            session()->flash('error', 'Error deleting advertisement: ' . $e->getMessage());
        }
    }

    /**
     * Base query so table and stats share same filters.
     */
    protected function getBaseQuery()
    {
        $term = '%'.$this->search.'%';

        return AdvertisementMatter::query()
            ->when($this->search, function ($q) use ($term) {
                $q->where(function ($qq) use ($term) {
                    $qq->where('advertising_matter', 'like', $term)
                       ->orWhere('casts', 'like', $term)
                       ->orWhere('director', 'like', $term)
                       ->orWhere('producer', 'like', $term)
                       ->orWhere('production_company', 'like', $term)
                       ->orWhere('client_company', 'like', $term)
                       ->orWhere('release_year', 'like', $term)
                       ->orWhere('duration', 'like', $term)
                       ->orWhere('genre', 'like', $term)
                       ->orWhere('language', 'like', $term)
                       ->orWhere('has_subtitle', 'like', $term)
                       ->orWhere('brand_promoted', 'like', $term)
                       ->orWhere('product_promoted', 'like', $term)
                       ->orWhere('theme', 'like', $term);
                });
            });
    }

    public function render()
    {
        $baseQuery = $this->getBaseQuery();

        $advertisements = (clone $baseQuery)
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        $stats = [
            'total'        => (clone $baseQuery)->count(),

            // Use has_classified just like Films / Video Games / Seasons
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

        return view('livewire.admin.classifications.advertisement.advertisement-table', [
            'films' => $advertisements, // keeping your existing var name
            'stats' => $stats,
        ]);
    }
}
