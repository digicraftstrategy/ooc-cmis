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
    public $advertisementTitleFilter = '';
    public $sortField = 'advertising_matter';
    public $sortDirection = 'asc';
    public $perPage = 10;

    public $showEditModal = false;
    public $showDeleteModal = false;
    public $showViewModal = false;

    public $selectedAdvertisement = null;
    protected $queryString = [
        'search' => ['except' => ''],
        'advertisementTitleFilter' => ['except' => ''],
        'sortField' => ['except' => 'advertising_matter'],
        'sortDirection' => ['except' => 'asc'],
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
            // Delete associated file if exists
            if ($this->selectedAdvertisement->submission_file_path && Storage::exists($this->selectedAdvertisement->submission_file_path)) {
                Storage::delete($this->selectedAdvertisement->submission_file_path);
            }

            $this->selectedAdvertisement->delete();

            $this->closeDeleteModal();
            session()->flash('success', 'Advertisement deleted successfully.');
        } catch (\Exception $e) {
            session()->flash('error', 'Error deleting advertisement: ' . $e->getMessage());
        }
    }
    /*public function getBaseQuery()
        {
            return AdvertisementMatter::query()
                ->when($this->search, function ($query) {
                    $query->where('advertising_matter', 'like', '%' . $this->search . '%')
                        ->orWhere('director', 'like', '%' . $this->search . '%')
                        ->orWhere('producer', 'like', '%' . $this->search . '%');
                });
        }*/
    public function render()
    {
        $term = '%'.$this->search.'%';
         $advertisements = AdvertisementMatter::query()
            //->with('seasons') // eager load seasons
            ->when($this->search, function ($q) use ($term) {
                $q->where(function ($qq) use ($term) {
                    $qq->where('advertising_matter', 'like', $term)
                       ->orWhere('main_actor_actress', 'like', $term)
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
            })
            // you can sort by any of these fields (UI should call sortBy on their <th>)
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        // Stats cards (simple example — mirror FilmTable feel)
        $stats = [
            'total'        => AdvertisementMatter::count(),
            'classified'   => AdvertisementMatter::whereHas('classification')->count(),
            'unclassified' => AdvertisementMatter::whereDoesntHave('classification')->count(),
            'recent'       => AdvertisementMatter::latest()->first(),
        ];
        return view('livewire.admin.classifications.advertisement.advertisement-table', [
            'films' => $advertisements,
            'stats' => $stats,
            //'filmTypes' => FilmType::all(),
        ]);
    }
}
