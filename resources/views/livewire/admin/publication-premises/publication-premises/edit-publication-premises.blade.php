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

                        <!-- Business Registration -->
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

                        <!-- Activities -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Owner Type <span class="text-red-500">*</span></label>
                            <select wire:model="premises_owner_type_id"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Select Owner Type</option>
                                @if($premise->prescribedActivities->count() > 0)
                                @foreach($premise->prescribedActivities as $activity)
                                    <option value="{{ $activity->id }}">{{ $activity->activity_type }}</option>
                                @endforeach
                                @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                    N/A
                                </span>
                                @endif
                            </select>
                            @error('premises_owner_type_id') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror
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
</div>
