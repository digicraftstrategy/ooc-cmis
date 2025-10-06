<?php

namespace App\Livewire\Admin\PublicationPremises\PublicationPremises;

use App\Models\PrescribedActivity;
use App\Models\PublicationPremises;
use Livewire\Component;

class EditPublicationPremises extends Component
{
    public $premise;

    // Form fields
    public $premises_name;
    public $business_registration_no;
    public $address;
    public $location;
    public $contact_person;
    public $telephone;
    public $premises_owner_id;
    public $province_id;
    public $prescribed_activity_id;
    public $status;

    public $showAddActivityModal = false; // Controls the activity selection modal
    public $searchActivity = ''; // Search term for filtering activities
    public $selectedActivities = []; // Array to store selected activity IDs
    public $availableActivities = []; // Array to store available activities
    // Arrays / Collections for prescribed activities
    public $newActivityId;
    public $selectedActivityDetails;
    public $prescribedActivities;
    public $premisesIdBeingEdited = null;
    public $showModal = true;

    protected $listeners = ['editPremises' => 'edit'];

    public function mount($premisesId)
    {
        $this->premise = PublicationPremises::findOrFail($premisesId);

        $this->premises_name = $this->premise->premises_name;
        $this->business_registration_no = $this->premise->business_registration_no;
        $this->address = $this->premise->address;
        $this->location = $this->premise->location;
        $this->contact_person = $this->premise->contact_person;
        $this->telephone = $this->premise->telephone;
        $this->premises_owner_id = $this->premise->contact_person_id;
        $this->province_id = $this->premise->province_id;
        $this->prescribed_activity_id = $this->premise->prescribed_activity_id;
        $this->status = $this->premise->status;

        $this->prescribedActivities = PrescribedActivity::orderBy('activity_type')->get();

        /**
         * ✅ Load existing prescribed activities for this premises
         * Keep them as Eloquent models — no toArray()
         */
        $this->selectedActivities = $this->premise->prescribedActivities
            ? $this->premise->prescribedActivities->pluck('id')->toArray()
            : [];

        $this->selectedActivityDetails = $this->premise->prescribedActivities
            ? $this->premise->prescribedActivities
            : collect();
    }

    public function closeModal()
    {
        $this->dispatch('closeModal');
    }

    // Open edit form through event listener
    public function edit($id)
    {
        $this->premise = PublicationPremises::findOrFail($id);

        $this->premises_name = $this->premise->premises_name;
        $this->business_registration_no = $this->premise->business_registration_no;
        $this->address = $this->premise->address;
        $this->location = $this->premise->location;
        $this->contact_person = $this->premise->contact_person;
        $this->telephone = $this->premise->telephone;
        $this->premises_owner_id = $this->premise->contact_person_id;
        $this->province_id = $this->premise->province_id;
        $this->prescribed_activity_id = $this->premise->prescribed_activity_id;
        $this->status = $this->premise->status;

        $this->prescribedActivities = PrescribedActivity::orderBy('activity_type')->get();

        /**
         * ✅ Also load existing prescribed activities here (for event-triggered edits)
         */
        $this->selectedActivities = $this->premise->prescribedActivities
            ? $this->premise->prescribedActivities->pluck('id')->toArray()
            : [];

        $this->selectedActivityDetails = $this->premise->prescribedActivities
            ? $this->premise->prescribedActivities
            : collect();

        $this->premisesIdBeingEdited = $id;
    }

        public function openAddActivityModal()
    {
        // Show the modal for adding activities
        $this->showAddActivityModal = true;
        // Load all available activities (optional: filter out already added ones)
        $this->availableActivities = \App\Models\PrescribedActivity::whereNotIn('id', $this->selectedActivities)->get();
    }

    public function closeAddActivityModal()
    {
        // Hide the modal and clear the search
        $this->showAddActivityModal = false;
        //$this->searchActivity = '';
    }
    public function addActivity($activityId)
    {
        // Ensure the relationship exists
        if ($this->premise && method_exists($this->premise, 'prescribedActivities')) {
            $activityId = (int) $activityId;

            // Only attach if it's not already added
            if (!in_array($activityId, $this->selectedActivities)) {
                $this->premise->prescribedActivities()->attach($activityId);

                // Update local state so Livewire reflects the change immediately
                $this->selectedActivities[] = $activityId;
                $this->selectedActivityDetails = $this->premise->prescribedActivities()->get();

                session()->flash('message', 'Prescribed activity added successfully.');
            }
        }

        // Close modal if used
        $this->closeAddActivityModal();
    }

    /*public function addActivity($activityId)
    {
        // Add an activity to the selected activities list if not already added
        $activityId = (int) $activityId;

        if (!in_array($activityId, $this->selectedActivities)) {
            $this->selectedActivities[] = $activityId;
            $this->selectedActivities = array_values($this->selectedActivities);
        }
        $this->closeAddActivityModal();
    }*/

    public function removeActivity($activityId)
    {
        // Ensure the relationship exists
        if ($this->premise && method_exists($this->premise, 'prescribedActivities')) {
            $this->premise->prescribedActivities()->detach($activityId);

            // Update local state (so Livewire reflects the change immediately)
            $this->selectedActivities = array_diff($this->selectedActivities, [$activityId]);
            $this->selectedActivityDetails = $this->premise->prescribedActivities()->get();

            session()->flash('message', 'Prescribed activity removed successfully.');
        }
    }
    public function update()
    {
        $this->validate([
            'premises_name' => 'required|string|max:255|unique:publication_premises,premises_name,' . $this->premise->id,
            'business_registration_no' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'contact_person' => 'nullable|string|max:255',
            'telephone' => 'nullable|string|max:50',
            'prescribed_activity_id' => 'required|exists:prescribed_activities,id',
            'status' => 'required|in:operational,suspended,ceased',
        ]);

        $this->premise->update([
            'premises_name' => $this->premises_name,
            'business_registration_no' => $this->business_registration_no,
            'address' => $this->address,
            'location' => $this->location,
            'contact_person' => $this->contact_person,
            'telephone' => $this->telephone,
            'prescribed_activity_id' => $this->prescribed_activity_id,
            'status' => $this->status,
        ]);

        $this->closeModal();
        $this->dispatch('refreshPublicationPremises');
        session()->flash('message', 'Publication Premises updated successfully.');
    }

    public function render()
    {
        return view('livewire.admin.publication-premises.publication-premises.edit-publication-premises');
    }
}
