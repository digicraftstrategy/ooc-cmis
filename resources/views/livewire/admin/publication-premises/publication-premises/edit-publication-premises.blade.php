<div>
    @if($showModal)
        <div class="flex inset-0 items-center justify-center text-center sm:block sm:p-0">

            <!-- =========================
                 Background Overlay
            ========================== -->
            <div class="fixed inset-0 transition-opacity bg-gray-900 bg-opacity-75" aria-hidden="true"></div>

            <!-- =========================
                 Edit Modal Panel
            ========================== -->
            <div class="inline-block w-full max-w-4xl p-0 text-left align-middle transition-all transform">

                <!-- =========================
                     Header Section
                ========================== -->
                <div class="px-6 py-5 bg-gradient-to-r from-blue-600 to-indigo-700 text-white rounded-t-2xl">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="p-2 bg-white/20 rounded-lg">
                                <!-- Building Icon -->
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-8 0H5m2 0h4M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold" id="modal-title">Edit Publication Premises</h3>
                                <p class="text-green-100 text-sm mt-1">Update premises details in the system</p>
                            </div>
                        </div>
                        <!-- Close Button -->
                        <button wire:click="closeModal"
                                class="text-white/80 hover:text-white transition-colors duration-200 p-1 rounded-full hover:bg-white/10">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- =========================
                     Form Content Section
                ========================== -->
                <div class="px-6 py-8 bg-white">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                        <!-- Premises Name -->
                        <div class="col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Premises Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" wire:model="premises_name"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="Enter premises name">
                            @error('premises_name') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror
                             <label class="block text-sm font-medium text-gray-700 mb-2">
                                Premises Address <span class="text-red-500">*</span>
                            </label>
                            <input type="text" wire:model="address"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="Enter address">
                            @error('address') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror
                        </div>

                        <!-- Business Registration -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Business Registration No</label>
                            <input type="text" wire:model="business_registration_no"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="Enter registration number">
                        </div>

                        <!-- Business Location -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Business location</label>
                            <input type="text" wire:model="location"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="Enter business location">
                        </div>

                        <!-- Contact Person -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Contact Person</label>
                            <input type="text" wire:model="contact_person"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="Enter contact person name">
                        </div>

                        <!-- Telephone -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Telephone</label>
                            <input type="text" wire:model="telephone"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="Enter phone number">
                        </div>

                       <!-- Prescribed Activities Section -->
                        <div class="border-t border-gray-200 pt-6">
                            <h4 class="text-lg font-semibold text-gray-800 mb-4 flex items-center justify-between">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                                    </svg>
                                    Prescribed Activities
                                </div>

                                <!-- Add Activity Button -->
                                <button type="button"
                                        wire:click="openAddActivityModal"
                                        class="flex items-center bg-indigo-500 text-white px-3 py-1.5 rounded-md shadow hover:bg-indigo-600 transition-all duration-200">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4" />
                                    </svg>
                                    Add Activity
                                </button>
                            </h4>

                            @if(!empty($selectedActivities) && count($selectedActivities) > 0)
                                <div class="mb-6 bg-gray-50 rounded-lg p-4">
                                    @foreach($selectedActivityDetails as $activity)
                                        <div class="flex items-center justify-between py-3 px-4 bg-white rounded-md shadow-sm mb-2">
                                            <span class="text-gray-700">{{ $activity->activity_type }}</span>
                                            <button type="button"
                                                    wire:click="removeActivity({{ $activity->id }})"
                                                    class="text-red-500 hover:text-red-700 transition-colors duration-200">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-gray-500 italic bg-gray-50 rounded-lg p-4">
                                    No prescribed activities selected yet.
                                </div>
                            @endif
                        </div>

                        <!-- Status -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Status <span class="text-red-500">*</span>
                            </label>
                            <select wire:model="status"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Select status</option>
                                <option value="operational">Operational</option>
                                <option value="suspended">Suspended</option>
                                <option value="ceased">Ceased</option>
                            </select>
                            @error('status') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror
                        </div>

                    </div>
                </div>

                <!-- =========================
                     Footer Actions Section
                ========================== -->
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end space-x-3 rounded-b-2xl">
                    <button type="button" wire:click="closeModal"
                            class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">
                        Cancel
                    </button>
                    <button type="button" wire:click="updatePremises"
                            class="px-5 py-2.5 text-sm font-medium text-white bg-gradient-to-r from-blue-600 to-indigo-600 border border-transparent rounded-lg shadow-sm hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200 flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Update Premises
                    </button>
                </div>
            </div>
        </div>
    @endif

    <!-- Add Activity Modal -->
    @if($showAddActivityModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white rounded-lg shadow-xl w-full max-w-md p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4v16m8-8H4" />
                    </svg>
                    Add Prescribed Activity
                </h3>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Select Activity</label>
                    <select wire:model="newActivityId"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option value="">-- Choose an activity --</option>
                        @foreach($availableActivities as $activity)
                            <option value="{{ $activity->id }}">{{ $activity->activity_type }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex justify-end space-x-2">
                    <button wire:click="closeAddActivityModal"
                            class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition">
                        Cancel
                    </button>
                    <button wire:click="addActivity({{ $newActivityId ?? 'null' }})"
                            class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition">
                        Add
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
