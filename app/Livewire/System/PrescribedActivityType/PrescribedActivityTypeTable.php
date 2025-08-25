<?php

namespace App\Livewire\System\PrescribedActivityType;

use Livewire\Component;
use App\Models\PrescribedActivityType;

class PrescribedActivityTypeTable extends Component
{
    public function render()
    {
        return view('livewire.system.prescribed-activity-type.prescribed-activity-type-table', [
            'prescribedActivityTypes' => PrescribedActivityType::paginate(10)
        ]);
    }
}
