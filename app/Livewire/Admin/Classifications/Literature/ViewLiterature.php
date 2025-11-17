<?php

namespace App\Livewire\Admin\Classifications\Literature;

use App\Models\Literature;
use Livewire\Component;

class ViewLiterature extends Component
{
    public Literature $literature;

    public function mount(Literature $literature)
    {
        // Route model binding using {literature:slug}
        $this->literature = $literature;
    }

    public function render()
    {
        return view('livewire.admin.classifications.literature.view-literature');
    }
}
