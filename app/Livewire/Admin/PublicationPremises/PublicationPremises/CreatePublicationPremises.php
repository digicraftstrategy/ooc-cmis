<?php

namespace App\Livewire\Admin\PublicationPremises\PublicationPremises;

use App\Models\PremisesOwner;
use App\Models\PrescribedActivity;
use App\Models\Province;
use App\Models\PublicationPremises;
use Livewire\Component;
use Illuminate\Validation\Rule;
//use Illuminate\Support\Facades\Log;

class CreatePublicationPremises extends Component
{
    // These properties store the premises owner information
    public $premisesOwnerId;
    public $owner;

    // Form field properties for the publication premises
    public $premises_name;
    public $business_registration_no;
    public $contact_person;
    public $location;
    public $address;
    public $telephone;
    public $mobile;
    public $status = "operational"; // Default status
    public $premises_owner_id;
    public $province_id;

    // UI control properties
    public $showModal = true;
    public $provinces;
    public $prescribedActivities;

    // Multi-step form workflow properties
    public $step = 1; // Tracks which step we're on (1: basic info, 2: activities, 3: completion)
    public $createdPremisesId; // Stores ID of the newly created premises
    public $createdPremises; // Stores the actual premises model instance
    public $showAddActivityModal = false; // Controls the activity selection modal
    public $searchActivity = ''; // Search term for filtering activities
    public $selectedActivities = []; // Array to store selected activity IDs

    public $existingPremise;

    public function mount($premisesOwnerId)
    {
        // Initialize with the provided premises owner ID and load related data
        $this->premisesOwnerId = $premisesOwnerId;
        $this->owner = PremisesOwner::findOrFail($this->premisesOwnerId);
        $this->premises_owner_id = $this->premisesOwnerId;

        $this->loadData();
    }

    protected function loadData()
    {
        // Load prescribed activities that are relevant to publication premises registration
        $this->prescribedActivities = PrescribedActivity::whereHas('prescribedType', function ($query) {
            $query->where('type', 'Registration of Publication Premises');
        })->orderBy('activity_type')->get();

        // Load all provinces for the dropdown selection
        $this->provinces = Province::orderBy('name')->get();
    }

    public function closeModal()
    {
        // Emit events to close the modal and reset the form
        $this->dispatch('closeModal');
        $this->dispatch('modalClosed');
        $this->resetForm();
    }

    protected function resetForm()
    {
        // Clear all form fields and errors
        $this->reset([
            'premises_name',
            'business_registration_no',
            'contact_person',
            'location',
            'address',
            'telephone',
            'mobile',
            'status',
            'province_id',
        ]);

        // Keep the owner reference but clear everything else
        $this->premises_owner_id = $this->premisesOwnerId;
        $this->resetErrorBag();

        // Reset the multi-step workflow back to the first step
        $this->step = 1;
        $this->selectedActivities = [];
        $this->createdPremisesId = null;
        $this->createdPremises = null;
    }

    public function validateStep1()
    {
        // Validate the form data for step 1 only
        $this->validate([
            'premises_name' => [
                'required',
                'string',
                'max:225',
                Rule::unique('premises', 'premises_name') // Ensure name is unique
            ],
            'business_registration_no' => [
                'required',
                'string',
                'max:75',
                Rule::unique('premises', 'business_registration_no') // Ensure registration number is unique
            ],
            'contact_person' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'address' => 'nullable|string',
            'telephone' => 'nullable|string',
            'mobile' => 'nullable|string|size:8|starts_with:7,8', // Specific format for mobile numbers
            'status' => 'required|in:operational,suspended,ceased', // Only allow these status values
            'premises_owner_id' => 'required|exists:premises_owners,id', // Must be a valid owner
            'province_id' => 'required|exists:provinces,id', // Must be a valid province
        ]);

        return true;
    }

    public function goToStep2()
    {
        // Validate step 1 and move to step 2 without saving
        if ($this->validateStep1()) {
            $this->step = 2;
            session()->flash('success', 'Please add prescribed activities to complete registration.');
        }
    }

    public function openAddActivityModal()
    {
        // Show the modal for adding activities
        $this->showAddActivityModal = true;
    }

    public function closeAddActivityModal()
    {
        // Hide the modal and clear the search
        $this->showAddActivityModal = false;
        $this->searchActivity = '';
    }

    public function addActivity($activityId)
    {
        // Add an activity to the selected activities list if not already added
        $activityId = (int) $activityId;

        if (!in_array($activityId, $this->selectedActivities)) {
            $this->selectedActivities[] = $activityId;
            $this->selectedActivities = array_values($this->selectedActivities);
        }
        $this->closeAddActivityModal();
    }

    public function removeActivity($activityId)
    {
        // Remove an activity from the selected activities list
        $activityId = (int) $activityId;

        $this->selectedActivities = array_filter($this->selectedActivities, function ($id) use ($activityId) {
            return $id !== $activityId;
        });

        $this->selectedActivities = array_values($this->selectedActivities);
    }

    public function saveAllData()
    {
        try {
            // Validate step 1 data again
            $this->validateStep1();

            // Validate that at least one activity is selected
            if (empty($this->selectedActivities)) {
                session()->flash('error', 'Please add at least one prescribed activity.');
                return;
            }

            // Create the premises record in the database
            $premises = PublicationPremises::create($this->all());

            // Sync the selected activities with the premises using many-to-many relationship
            $premises->prescribedActivities()->sync($this->selectedActivities);

            $this->createdPremisesId = $premises->id;
            $this->createdPremises = $premises;

            $this->step = 3; // Move to the completion step

            session()->flash('success', 'Publication Premises registration completed successfully!');
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to complete registration: ' . $e->getMessage());
        }
    }

    public function completeProcess()
    {
        // Final method called when user clicks "Request Invoice"
        $this->dispatch('premisesCreated', $this->createdPremisesId);
        $this->closeModal();

        session()->flash('success', 'Publication Premises registration completed successfully. Invoice requested.');
    }

    public function render()
    {
        // Filter prescribed activities based on search term
        $filteredActivities = $this->prescribedActivities;

        if (!empty($this->searchActivity)) {
            $filteredActivities = $filteredActivities->filter(function ($activity) {
                return stripos($activity->activity_type, $this->searchActivity) !== false;
            });
        }

        // Get details of selected activities for display
        $selectedActivityDetails = PrescribedActivity::whereIn('id', $this->selectedActivities)->get();

        return view('livewire.admin.publication-premises.publication-premises.create-publication-premises', [
            'filteredActivities' => $filteredActivities,
            'selectedActivityDetails' => $selectedActivityDetails
        ]);
    }
}
