<div>
    @if (session()->has('success'))
        <div class="p-4 mb-4 text-green-800 bg-green-100 rounded-lg border border-green-200">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                {{ session('success') }}
            </div>
        </div>
    @endif
    @if (session()->has('error'))
        <div class="p-4 mb-4 text-red-800 bg-red-100 rounded-lg border border-red-200">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 极 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                </svg>
                {{ session('error') }}
            </div>
        </div>
    @endif

    <!-- Modal Trigger -->
    <div x-data="{ open: @entangle('showModal') }">
        <!-- Modal Content -->
        <div x-show="open" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <!-- Background overlay -->
                <div class="fixed inset-0 transition-opacity bg-gray-900 bg-opacity-75" aria-hidden="true" x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"></div>

                <!-- Modal panel -->
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <div class="inline-block w-full max-w-4xl my-8 overflow-hidden text-left align-middle transition-all transform bg-white shadow-xl rounded-2xl sm:my-16">
                    <!-- Header -->
                    <div class="px-6 py-5 bg-gradient-to-r from-indigo-600 to-purple-600 text-white">
                        <div class="flex items-center justify-between">
                            <h3 class="text-xl font-semibold" id="modal-title">
                                @if($step === 1)
                                    <span class="flex items-center">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-8 0H5m2 0h4M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 极 011 1v5m-4 0h4"></path>
                                        </svg>
                                        New Premises Registration
                                    </span>
                                @elseif($step === 2)
                                    <span class="flex items-center">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h极a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                        </svg>
                                        Add Prescribed Activities
                                    </span>
                                @elseif($step === 3)
                                    <span class="flex items-center">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2极16l3.5-2 3.5 2 3.5-2 3.5 2z"></path>
                                        </svg>
                                        Request Invoice
                                    </span>
                                @endif
                            </h3>
                            <button wire:click="closeModal" class="text-indigo-100 hover:text-white transition-colors duration-200">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>

                        <!-- Progress steps -->
                        <div class="mt-4">
                            <div class="flex items-center justify-center">
                                @foreach([1, 2, 3] as $stepNumber)
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 rounded-full flex items-center justify-center border-2 {{ $step >= $stepNumber ? 'bg-white text-indigo-600 border-white' : 'bg-indigo-500 bg-opacity-50 text-white border-white border-opacity-50' }}">
                                            {{ $stepNumber }}
                                        </div>
                                        @if($stepNumber < 3)
                                            <div class="w-12 h-0.5 mx-2 {{ $step > $stepNumber ? 'bg-white' : 'bg-indigo-500 bg-opacity-50' }}"></div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                            <div class="flex justify-between mt-2 text-xs text-indigo-100">
                                <span class="{{ $step >= 1 ? 'font-medium' : '' }}">Details</span>
                                <span class="{{ $step >= 2 ? 'font-medium' : '' }}">Activities</span>
                                <span class="{{ $step >= 3 ? 'font-medium' : '' }}">Invoice</span>
                            </div>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="px-6 py-6 bg-white">
                        <!-- Step 1: Create Premises -->
                        @if($step === 1)
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <!-- Column 1 -->
                            <div class="space-y-5">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                        <svg class="w-4 h-4 mr-1 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21极5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4极-8 0H5m2 0h4M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                        </svg>
                                        Premises Name <span class="text-red-500 ml-1">*</span>
                                    </label>
                                    <input type="text" wire:model="premises_name"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200 shadow-sm">
                                    @error('premises_name') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                        <svg class="w-4 h-4 mr-1 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                        Business Registration No <span class="text-red-500 ml-1">*</span>
                                    </label>
                                    <input type="text" wire:model="business_registration_no"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200 shadow-sm">
                                    @error('business_registration_no') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                        <svg class="w-4 h-4 mr-1 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 极 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                        Contact Person <span class="text-red-500 ml-1">*</span>
                                    </label>
                                    <input type="text" wire:model="contact_person"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200 shadow-sm">
                                    @error('contact_person') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <!-- Column 2 -->
                            <div class="space-y-5">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                        <svg class="w-4 h-4 mr-1极-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        Location <span class="text-red-500 ml-1">*</span>
                                    </label>
                                    <input type="text" wire:model="location"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200 shadow-sm">
                                    @error('location') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            Telephone
                                        </label>
                                        <input type="text" wire:model="telephone"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200 shadow-sm">
                                        @error('telephone') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            Mobile
                                        </label>
                                        <input type="text" wire:model="mobile"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200 shadow-sm">
                                        @error('mobile') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                            Status <span class="text-red-500 ml-1">*</span>
                                        </label>
                                        <select wire:model="status"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200 shadow-sm">
                                            <option value="">Select Status</option>
                                            <option value="operational">Operational</option>
                                            <option value="suspended">Suspended</option>
                                            <option value="ceased">Ceased</option>
                                        </select>
                                        @error('status') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                            Province <span class="text-red-500 ml-1">*</span>
                                        </label>
                                        <select wire:model="province_id"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200 shadow-sm">
                                            <option value="">Select Province</option>
                                            @foreach($provinces as $province)
                                                <option value="{{ $province->id }}">{{ $province->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('province_id') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                                    </极>
                                </div>
                            </div>
                        </div>

                        <!-- Full width field -->
                        <div class="mt-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                <svg class="w-4 h-4 mr-1 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1极-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                </svg>
                                Premises Address
                            </label>
                            <textarea wire:model="address" rows="3"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200 shadow-sm resize-none"
                                placeholder="Enter full address"></textarea>
                            @error('address') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        @endif

                        <!-- Step 2: Add Activities -->
                        @if($step === 2)
                        <div class="mt-4">
                            <h4 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-8 0H5m2 0h4M9 7极1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                                Premises Information
                            </h4>
                            <div class="grid grid-cols-2 gap-4 mb-6 p-4 bg-gray-50 rounded-lg">
                                <div>
                                    <p class="text-sm text-gray-600">Premises Name</p>
                                    <p class="font-medium text-gray-800">{{ $premises_name }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Business Registration No</p>
                                    <p class="font-medium text-gray-800">{{ $business_registration_no }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Contact Person</p>
                                    <p class="font-medium text-gray-800">{{ $contact_person }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Location</p>
                                    <p class="font-medium text-gray-800">{{ $location }}</p>
                                </div>
                            </div>

                            <div class="border-t border-gray-200 pt-6">
                                <h4 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                                    </svg>
                                    Prescribed Activities
                                </h4>

                                @if(count($selectedActivities) > 0)
                                    <div class="mb-6 bg-gray-50 rounded-lg p-4">
                                        @foreach($selectedActivityDetails as $activity)
                                            <div class="flex items-center justify-between py-3 px-4 bg-white rounded-md shadow-sm mb-2">
                                                <span class="text-gray-700">{{ $activity->activity_type }}</span>
                                                <button type="button" wire:click="removeActivity({{ $activity->id }})" class="text-red-500 hover:text-red-700 transition-colors duration-200">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                </button>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6">
                                        <div class="flex items-center">
                                            <svg class="w-5 h-5 text-yellow-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 极 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                            </svg>
                                            <span class="text-yellow-700">No activities added yet. Please add at least one prescribed activity.</span>
                                        </div>
                                    </div>
                                @endif

                                <button type="button" wire:click="openAddActivityModal" class="flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition-colors duration-200 shadow-sm">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                    Add Prescribed Activity
                                </button>
                            </div>
                        </div>
                        @endif

                        <!-- Step 3: Request Invoice -->
                        @if($step === 3)
                        <div class="mt-4">
                            <div class="text-center mb-6">
                                <div class="mx-auto w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mb-4">
                                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 极 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <h4 class="text-xl font-semibold text-gray-800 mb-2">Registration Complete!</h4>
                                <p class="text-gray-600">Premises and activities have been saved successfully.</p>
                            </div>

                            <!-- Activities Table -->
                            <div class="mb-6 bg-white rounded-lg border border-gray-200 overflow-hidden">
                                <table class="w-full">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                                                Activity
                                            </th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                                                Fees
                                            </th>
                                            <th class="px-6 py-3 text-left text-xs font-medium极text-gray-500 uppercase tracking-wider border-b border-gray-200">
                                                Count
                                            </th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                                                Total Cost
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @php
                                            $subtotal = 0;
                                        @endphp
                                        @foreach($selectedActivityDetails as $activity)
                                            @php
                                                $activityFee = $activity->prescribed_fee; // Get fee from Activities table
                                                $activityCount = 1; // Default count (you can modify this if needed)
                                                $activityTotal = $activityFee * $activityCount;
                                                $subtotal += $activityTotal;
                                            @endphp
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    {{ $activity->activity_type }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    K {{ number_format($activityFee, 2) }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    {{ $activityCount }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">
                                                    K {{ number_format($activityTotal, 2) }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot class="bg-gray-50">
                                        <tr>
                                            <td colspan="3" class="px-6 py-4 text-sm font-medium text-gray-900 text-right">
                                                Subtotal:
                                            </td>
                                            <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                                K {{ number_format($subtotal, 2) }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="px-6 py-4 text-sm font-bold text-gray-900 text-right border-t border-gray-200">
                                                Total:
                                            </td>
                                            <td class="px-6 py-4极text-sm font-bold text-gray-900 border-t border-gray-200">
                                                K {{ number_format($subtotal, 2) }}
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                            <!-- Client Information -->
                            <div class="bg-gray-50 p-5 rounded-lg mb-6">
                                <h5 class="font-medium text-gray-700 mb-3 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7极14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    Client Information
                                </h5>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-sm text-gray-600">Premises:</p>
                                        <p class="font-medium text-gray-800">{{ $premises_name }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600">Business Registration No:</p>
                                        <p class="font-medium text-gray-800">{{ $business_registration_no }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600">Contact Person:</p>
                                        <p class="font-medium text-gray-800">{{ $contact_person }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600">Phone:</p>
                                        <p class="font-medium text-gray-800">{{ $mobile ?: $telephone ?: 'N/A' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600">Location:</p>
                                        <p class="font-medium text-gray-800">{{ $location }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600">Address:</p>
                                        <p class="font-medium text-gray-800">{{ $address ?: 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex space-x-3 justify-center mb-6">
                                <button type="button" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-700 transition-colors duration-200 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    View PDF
                                </button>
                                <button type="button" class="px-4 py-2 text-sm font-medium text-white bg-green-600 border border-transparent rounded-md shadow-sm hover:bg-green-700 transition-colors duration-200 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    Download PDF
                                </button>
                            </div>

                            <p class="text-sm text-gray-500 text-center mb-6">
                                Click the buttons above to view or download the invoice for the selected activities.
                            </p>
                        </div>
                        @endif

                    <!-- Footer Buttons -->
                    <div class="px-6 py-4 bg-gray-50 rounded-b-2xl border-t border-gray-200 flex justify-between items-center">
                        <div>
                            @if($step > 1)
                                <span class="text-sm text-gray-500">Step {{ $step }} of 3</span>
                            @endif
                        </div>
                        <div class="flex space-x-3">
                            @if($step === 1)
                                <button type="button" wire:click="closeModal"
                                    class="px-5 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                                    Cancel
                                </button>
                                <button type="button" wire:click="goToStep2"
                                    class="px-5 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Next: Add Activities
                                </button>
                            @elseif($step === 2)
                                <button type="button" wire:click="closeModal"
                                    class="px-5 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                                    Cancel
                                </button>
                                <button type="button" wire:click="saveAllData"
                                    class="px-5 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13极4 4L19 7"></path>
                                    </svg>
                                    Complete Registration
                                </button>
                            @elseif($step === 3)
                                <button type="button" wire:click="closeModal"
                                    class="px-5 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                                    Close
                                </button>
                                <button type="button" wire:click="completeProcess"
                                    class="px-5 py-2 text-sm font-medium text-white bg-green-600 border border-transparent rounded-md shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-200 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                    </svg>
                                    Invoicing
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Activity Modal -->
    @if($showAddActivityModal)
        <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="activity-modal-title" role="dialog" aria-modal="true">
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity bg-gray-900 bg-opacity-75" aria-hidden="true"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div class="inline-block w-full max-w-md my-8 overflow-hidden text-left align-middle transition-all transform bg-white shadow-xl rounded-2xl">
                    <div class="px-6 pt-5 pb-4 bg-gradient-to-r from-indigo-600 to-purple-600 text-white">
                        <div class="flex items-center justify-between">
                            <h3 class="text-xl font-semibold" id="activity-modal-title">
                                Add Prescribed Activity
                            </h3>
                            <button wire:click="closeAddActivityModal" class="text-indigo-100 hover:text-white transition-colors duration-200">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>

                        <div class="mt-4">
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-indigo-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                                <input type="text" wire:model.live="searchActivity" placeholder="Search activities..."
                                    class="w-full pl-10 pr-4 py-3 bg-indigo-700 bg-opacity-25 border border-indigo-500 border-opacity-50 rounded-lg text-white placeholder-indigo-200 focus:outline-none focus:ring-2 focus:ring-indigo-300 focus:border-indigo-300 transition-colors duration-200">
                            </div>
                        </div>
                    </div>

                    <div class="max-h-96 overflow-y-auto">
                        @if($filteredActivities->count() > 0)
                            @foreach($filteredActivities as $activity)
                                <div wire:click="addActivity({{ $activity->id }})"
                                    class="p-4 border-b border-gray-100 cursor-pointer hover:bg-indigo-50 transition-colors duration-200 flex items-center">
                                    <svg class="w-5 h-5 text-indigo-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span class="text-gray-700">{{ $activity->activity_type }}</span>
                                </div>
                            @endforeach
                        @else
                            <div class="p-4 text-center text-gray-500">
                                <svg class="w-12 h-12 mx-auto text-gray-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <p>No activities found.</p>
                            </div>
                        @endif
                    </div>
                    <div class="px-6 py-4 bg-gray-50 rounded-b-2xl border-t border-gray-200 flex justify-end">
                        <button type="button" wire:click="closeAddActivityModal"
                            class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 transition-colors duration-200">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
