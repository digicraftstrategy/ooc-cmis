<?php

namespace App\Livewire\Admin\PrescribedActivities;

use App\Models\PrescribedActivity;
use App\Models\PrescribedActivityType;
use Livewire\Component;

class CreatePrescribedActivity extends Component
{
    public $showModal = true;
    public $activity_type;
    public $prescribed_fee;
    public $is_active = true;
    public $prescribed_activity_type_id;

    public $prescribedTypes;

    public function mount()
    {
        $this->prescribedTypes = PrescribedActivityType::orderBy('type')->get();
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->dispatch('closeModal');
    }

    public function save()
    {
        $this->validate([
            'activity_type' => 'required|string|max:255|unique:prescribed_activities,activity_type',
            'prescribed_fee' => 'required|numeric|min:0',
            'prescribed_activity_type_id' => 'required|exists:prescribed_activity_types,id',
        ]);

        PrescribedActivity::create([
            'activity_type' => $this->activity_type,
            'prescribed_fee' => $this->prescribed_fee,
            'prescribed_activity_type_id' => $this->prescribed_activity_type_id,
            'is_active' => $this->is_active,
        ]);

        $this->closeModal();
        $this->dispatch('refreshPrescribedActivities');
        session()->flash('message', 'Prescribed Activity created successfully.');
    }

    public function render()
    {
        return view('livewire.admin.prescribed-activities.create-prescribed-activity');
    }
}
