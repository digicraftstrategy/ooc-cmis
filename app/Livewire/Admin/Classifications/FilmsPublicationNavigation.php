<?php

namespace App\Livewire\Admin\Classifications;

use Livewire\Component;

class FilmsPublicationNavigation extends Component
{
    public $currentRoute;

    public function mount()
    {
        $this->currentRoute = request()->route()->getName();
    }

    public function isActive($routePattern)
    {
        return str_contains($this->currentRoute, $routePattern);
    }

    public function render()
    {
        return view('livewire.admin.classifications.films-publication-navigation');
    }
}
