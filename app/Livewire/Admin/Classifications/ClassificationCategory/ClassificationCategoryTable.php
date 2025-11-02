<?php

namespace App\Livewire\Admin\Classifications\ClassificationCategory;

use App\Models\ClassificationCategory;
use Livewire\Component;
use Livewire\WithPagination;

class ClassificationCategoryTable extends Component
{
    use WithPagination;

    public $search = '';
    public $sortField = 'name';
    public $sortDirection = 'asc';
    public $perPage = 10;
    public $classification_categories;

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $paginateClassificationCategories = ClassificationCategory::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('slug', 'like', '%' . $this->search . '%')
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.admin.classifications.classification-category.classification-category-table',[
            'classification_categories' => $$paginateClassificationCategories,
        ]);
    }
}
