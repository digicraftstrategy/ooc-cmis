<div class="min-h-screen flex items-center justify-center p-4">
    <div x-data="{ open: @entangle('showModal') }">
        <div x-show="open" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity bg-gray-900 bg-opacity-75" aria-hidden="true"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>

                <div class="inline-block w-full max-w-md p-0 my-8 overflow-hidden text-left align-middle transition-all transform bg-white shadow-2xl rounded-2xl sm:my-16">
                    <!-- Header -->
                    <div class="px-6 py-5 bg-gradient-to-r from-blue-600 to-indigo-700 text-white">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="p-2 bg-white/20 rounded-lg">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-8 0H5m2 0h4M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-xl font-semibold" id="modal-title">Edit Premises Owner</h3>
                                    <p class="text-green-100 text-sm mt-1">Update owner details in the system</p>
                                </div>
                            </div>
                            <button wire:click="closeModal" class="text-white/80 hover:text-white transition-colors duration-200 p-1 rounded-full hover:bg-white/10">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Form Content -->
                    <div class="px-6 py-8 bg-white">
                        <!-- Owner's Name -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Owner's Name <span class="text-red-500">*</span></label>
                            <input type="text" wire:model="owners_name"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Enter owner's full name">
                            @error('owners_name') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror
                        </div>

                        <!-- Logo Image -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Logo</label>

                            {{-- Show existing logo if already saved --}}
                            @if($logo && is_string($logo))
                                <div class="mb-3">
                                    <img src="{{ Storage::url($logo) }}" 
                                        alt="Current Logo" 
                                        class="h-16 rounded-md shadow">
                                </div>
                            @endif

                            {{-- Upload new logo --}}
                            <input type="file" wire:model="logo"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

                            {{-- Preview for new upload --}}
                            @if ($logo && !is_string($logo))
                                <div class="mt-2">
                                    <img src="{{ $logo->temporaryUrl() }}" 
                                        alt="Preview" 
                                        class="h-16 rounded-md shadow">
                                </div>
                            @endif

                            @error('logo') 
                                <span class="text-xs text-red-500 mt-1">{{ $message }}</span> 
                            @enderror
                        </div>

                        <!-- Contact Information -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Phone</label>
                                <input type="text" wire:model="phone"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Phone number">
                                @error('phone') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Email <span class="text-red-500">*</span></label>
                                <input type="email" wire:model="email"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="email@example.com">
                                @error('email') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Website Link -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Website Url</label>
                            <input type="text" wire:model="website"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Company website">
                            @error('website') 
                                <span class="text-xs text-red-500 mt-1">{{ $message }}</span> 
                            @enderror
                        </div>

                        <!-- Address -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">HQ Address</label>
                            <textarea wire:model="address" rows="3"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 resize-none"
                                placeholder="Enter full business address"></textarea>
                            @error('address') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror
                        </div>

                        <!-- Owner Type -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Owner Type <span class="text-red-500">*</span></label>
                            <select wire:model="premises_owner_type_id"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Select Owner Type</option>
                                @foreach($premisesOwnerTypes as $premisesOwnerType)
                                    <option value="{{ $premisesOwnerType->id }}">{{ $premisesOwnerType->type }}</option>
                                @endforeach
                            </select>
                            @error('premises_owner_type_id') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Footer Actions -->
                    <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end space-x-3 rounded-b-2xl">
                        <button type="button" wire:click="closeModal"
                            class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">
                            Cancel
                        </button>
                        <button type="button" wire:click="update"
                            class="px-5 py-2.5 text-sm font-medium text-white bg-gradient-to-r from-blue-600 to-indigo-600 border border-transparent rounded-lg shadow-sm hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200 flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Update Owner
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
