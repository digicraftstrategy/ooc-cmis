<?php

namespace App\Livewire\Admin\Classifications\Advertisement;

use Livewire\Component;
use App\Models\AdvertisementMatter;

class ViewAdvertisement extends Component
{
    public $advertisement;

    public function mount($id)
    {
        // Load advertisement by id
        $this->advertisement = AdvertisementMatter::where('id', $id)->firstOrFail();
    }

    public function render()
    {
        return view('livewire.admin.classifications.advertisement.view-advertisement', [
            'advertisement' => $this->advertisement
        ]);
    }
}
