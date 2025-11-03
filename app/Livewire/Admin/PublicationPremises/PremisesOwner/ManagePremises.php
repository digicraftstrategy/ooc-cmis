<?php

namespace App\Livewire\Admin\PublicationPremises\PremisesOwner;

use App\Models\PremisesOwner;
use App\Models\PublicationPremises;
use Livewire\Component;

class ManagePremises extends Component
{
    public $premisesOwnerId;
    public $premisesOwner;

    public $premisesCount = 0;

    protected $listeners = [
        'premisesOwnerUpdated' => 'loadPremisesOwner',
        'premisesAdded' => 'loadStatistics',
        'refreshParentComponent' => '$refresh'
    ];

    public function mount($id)
    {
        $this->premisesOwnerId = $id;
        $this->loadPremisesOwner();
        $this->loadStatistics();
    }

    public function loadStatistics()
    {
        // Get all premses associated with this premises owner
        //$this->premisesCount = $this->premisesOwner->publication_premises()->count();

        $premisesIds = PublicationPremises::where('premises_owner_id', $this->premisesOwner->id)
            ->pluck('id');

        $this->premisesCount = $premisesIds->count();
    }

    public function loadPremisesOwner()
    {
        $this->premisesOwner = PremisesOwner::with('premises_type')
            ->where('uuid', $this->premisesOwnerId)->firstOrFail();
    }
    public function render()
    {
        return view('livewire.admin.publication-premises.premises-owner.manage-premises');
    }
}
