<?php

namespace App\Livewire\Admin\PrescribedActivities;

use Livewire\Component;
use App\Models\PrescribedActivity;
use App\Models\PrescribedActivityType;

class EditPrescribedActivity extends Component
{
    public $showModal = true;
    public $prescribedActivity;
    public $prescribedTypes;

    public $activity_type;
    public $prescribed_fee;
    public $is_active = true;
    public $prescribed_activity_type_id;

    public function mount($prescribedActivityId)
    {
        $this->prescribedActivity = PrescribedActivity::findOrFail($prescribedActivityId);
        $this->activity_type = $this->prescribedActivity->activity_type;
        $this->prescribed_fee = $this->prescribedActivity->prescribed_fee;
        $this->is_active = $this->prescribedActivity->is_active;
        $this->prescribed_activity_type_id = $this->prescribedActivity->prescribed_activity_type_id;
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
            'activity_type' => 'required|string|max:255',
            'prescribed_fee' => 'required|numeric|min:0',
            'prescribed_activity_type_id' => 'required|exists:prescribed_activity_types,id',
        ]);

        $this->prescribedActivity->update([
            'activity_type' => $this->activity_type,
            'prescribed_fee' => $this->prescribed_fee,
            'prescribed_activity_type_id' => $this->prescribed_activity_type_id,
            'is_active' => $this->is_active,
        ]);

        $this->closeModal();
        $this->dispatch('activityUpdated', message: "Prescribed activity updated successfully.");
        //session()->flash('message', 'Prescribed Activity updated successfully.');
    }

    public function render()
    {
        return view('livewire.admin.prescribed-activities.edit-prescribed-activity');
    }
}
