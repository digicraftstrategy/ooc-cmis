<?php

namespace App\Livewire\Admin\Province;

use App\Models\Province;
use Livewire\Component;

class ViewProvince extends Component
{
    public $province;
    public $showModal = true;

    public function mount($provinceId)
    {
        $this->province = Province::with('region')->findOrFail($provinceId);
    }

    public function closeModal()
    {
        $this->dispatch('closeModal');
    }

    public function render()
    {
        return view('livewire.admin.province.view-province');
    }
}
