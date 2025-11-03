<?php

namespace App\Livewire\Admin\PrescribedActivities;

use App\Models\PrescribedActivity;
use App\Models\PrescribedActivityType;
use Livewire\Component;
use Livewire\WithPagination;

class PrescribedActivityTable extends Component
{
    use WithPagination;

    public $search = '';
    public $prescribedTypeFilter = '';
    public $sortField = 'activity_type';
    public $sortDirection = 'asc';
    public $perPage = 10;
    public $prescribedTypes;

    public $showCreateModal = false;
    public $showDeleteModal = false;
    public $prescribedActivityIdBeingEdited = null;
    public $prescribedActivityIdBeingViewed = null;
    public $prescribedActivityIdBeingDeleted = null;

    public $message = '';

    protected $listeners = [
        'closeModal',
        'refreshPrescribedActivities' => 'refreshActivities',
        'activityCreated' => 'handleActivityCreated',
        'activityDeleted' => 'handleActivityDeleted',
        'activityUpdated' => 'handleActivityUpdated',
    ];

    public function mount()
    {
        $this->prescribedTypes = PrescribedActivityType::orderBy('type')->get();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }
    // Handling create messages
    public function handleActivityCreated($message)
    {
        $this->message = $message;
        $this->refreshActivities();

        // Auto-clear message after 5 seconds
        $this->dispatch('clear-message');
    }

    // Handling delete messages
    public function handleActivityDeleted($message)
    {
        $this->message = $message;
        $this->refreshActivities();

        // Auto-clear message after 5 seconds
        $this->dispatch('clear-message');
    }

    public function handleActivityUpdated($message)
    {
        $this->message = $message;
        $this->refreshActivities();

        // Auto-clear message after 5 seconds
        $this->dispatch('clear-message');
    }


    public function refreshActivities()
    {
        $this->resetPage();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function UpdatingprescribedTypeFilter()
    {
        $this->resetPage();
    }

    public function openCreateModal()
    {
        $this->showCreateModal = true;
    }

    public function openEditModal($prescribedActivityId)
    {
        $this->prescribedActivityIdBeingEdited = $prescribedActivityId;
    }

    public function openViewModal($prescribedActivityId)
    {
        $this->prescribedActivityIdBeingViewed = $prescribedActivityId;
    }

    public function openDeleteModal($prescribedActivityId)
    {
        $this->prescribedActivityIdBeingDeleted = $prescribedActivityId;
        $this->showDeleteModal = true;
    }

    public function closeModal()
    {
        $this->showDeleteModal = false;
        $this->showCreateModal = false;
        $this->prescribedActivityIdBeingDeleted = null;
        $this->prescribedActivityIdBeingViewed = null;
    }

    public function deletePrescribedActivity()
    {
        $prescribedActivity = PrescribedActivity::findOrFail($this->prescribedActivityIdBeingDeleted);
        $activityType = $prescribedActivity->activity_type; // store for message
        $prescribedActivity->delete();

        $this->closeModal();

        // Use event to notify deletion
        $this->dispatch('activityDeleted', message: "Prescribed activity '{$activityType}' deleted successfully.");
    }

    public function clearMessage()
    {
        $this->message = '';
    }

    public function render()
    {
        $prescribedActivities = PrescribedActivity::query()
            ->with('prescribedType')
            ->when($this->search, function ($query) {
                $query->where('activity_type', 'like', '%' . $this->search . '%');
            })
            ->when($this->prescribedTypeFilter, function ($query) {
                $query->where('prescribed_activity_type_id', $this->prescribedTypeFilter);
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.admin.prescribed-activities.prescribed-activity-table', [
            'prescribedActivities' => $prescribedActivities,
        ]);
    }
}
