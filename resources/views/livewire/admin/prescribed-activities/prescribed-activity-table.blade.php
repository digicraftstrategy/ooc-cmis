<div>
    <x-slot name='header'>
        <div class="px-4 py-2 bg-blue-100">
            <h2 class="text-xl font-semibold">
                Manage Prescribed Activities
            </h2>
        </div>
    </x-slot>

    <!-- Header and search -->
    <div>
        <div class="mb-4 flex flex-wrap items-center gap-4">
            <div class="flex-1 min-w-[250px]">
                <input wire:model.live.debounce.300ms="search" type="text"
                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    placeholder="Search prescribed activities...">
            </div>
            <div class="flex-1 min-w-[250px]">
                <select wire:model.live="prescribedTypeFilter"
                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="">All Prescribed Types</option>
                    @foreach($prescribedTypes as $prescribedType)
                        <option value="{{ $prescribedType->id }}">{{ $prescribedType->type }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex">
                <x-blue-button wire:click="openCreateModal"
                    class="px-4 py-2 font-medium text-white transition-colors duration-200 bg-indigo-600 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-4 h-4 mr-1" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                            clip-rule="evenodd" />
                    </svg>
                    Add Prescribed Activity
                </x-blue-button>
            </div>
        </div>
    </div>

    <!-- Event-based Message Display -->
    @if ($message)
        <div class="p-4 mb-2 bg-green-50 border-l-4 border-green-500"
            x-data="{ show: true, timeLeft: 5 }"
            x-init="
                setTimeout(() => { show = false }, 5000);
                setInterval(() => { if (timeLeft > 0) timeLeft-- }, 1000);
                $wire.dispatch('clear-message');
            "
            x-show="show"
            x-transition:enter="transition ease-out duration-300"
            x-transition:leave="transition ease-in duration-200"
            >
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <svg class="h-5 w-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <p class="text-sm font-medium text-green-800">{{ $message }}</p>
                </div>
                <button
                @click="show = false; $wire.clearMessage()"
                type="button" class="text-green-500 hover:text-green-700 focus:outline-none">
                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        </div>
    @endif

    <!-- Keep your existing error message handling -->
    @if (session()->has('error'))
        <div x-data="{ show: true }" x-show="show"
            class="p-4 mb-4 text-red-700 bg-red-100 border border-red-400 rounded shadow-lg z-50 max-w-sm"
            role="alert">
            <div class="flex items-center justify-between">
                <span>{{ session('error') }}</span>
                <button @click="show = false" class="ml-4 text-red-700 hover:text-green-900">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    @endif

    <!-- Table -->
    <div class="p-4 overflow-y-auto bg-white rounded-lg shadow">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-blue-50">
                <tr>
                    <th scope="col"
                        class="px-6 py-6 text-xs font-medium tracking-wider text-left text-blue-700 uppercase cursor-pointer">
                        #</th>
                    <th scope="col"
                        class="px-6 py-6 text-xs font-medium tracking-wider text-left text-blue-700 uppercase cursor-pointer"
                        wire:click="sortBy('activity_type')">
                        Activity Type
                        @if ($sortField === 'activity_type')
                            <span>{!! $sortDirection === 'asc' ? '&uarr;' : '&darr;' !!}</span>
                        @endif
                    </th>
                    <th scope="col"
                        class="px-6 py-6 text-xs font-medium tracking-wider text-left text-blue-700 uppercase">
                        Prescribed Fees/Charges
                    </th>
                    <th scope="col"
                        class="px-6 py-6 text-xs font-medium tracking-wider text-left text-blue-700 uppercase">
                        Status
                    </th>
                    <th scope="col"
                        class="px-6 py-6 text-xs font-medium tracking-wider text-left text-blue-700 uppercase">
                        Prescribed Type
                    </th>
                    <th scope="col" class="px-6 py-6 text-xs font-medium tracking-wider text-left text-blue-700 uppercase">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($prescribedActivities as $prescribedActivity)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">
                            {{ $loop->iteration }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">
                                {{ $prescribedActivity->activity_type }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">
                                PGK{{ number_format($prescribedActivity->prescribed_fee, 2) }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex px-2 text-xs font-semibold leading-5 rounded-full {{ $prescribedActivity->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $prescribedActivity->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">
                                {{ $prescribedActivity->prescribedType->type ?? 'N/A' }}
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm font-medium text-right whitespace-nowrap">
                            <div class="relative text-left" x-data="{ open: false }">
                                <button x-on:click="open = !open" class="flex items-center text-gray-400 hover:text-gray-600 focus:outline-none">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z" />
                                    </svg>
                                </button>

                                <div x-show="open" x-cloak @click.away="open = false"
                                    class="absolute right-0 z-10 w-48 mt-2 origin-top-right bg-white border border-gray-200 rounded-md shadow-lg">
                                    <div class="py-1" role="menu" aria-orientation="vertical">
                                        <button wire:click="openViewModal({{ $prescribedActivity->id }})"
                                            class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 w-full text-left"
                                            role="menuitem">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            View
                                        </button>

                                        <button wire:click="openEditModal({{ $prescribedActivity->id }})"
                                            class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 w-full text-left"
                                            role="menuitem">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                            Edit
                                        </button>

                                        <button wire:click="openDeleteModal({{ $prescribedActivity->id }})"
                                            class="flex items-center px-4 py-2 text-sm text-red-700 hover:bg-red-100 hover:text-red-900 w-full text-left"
                                            role="menuitem">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            Delete
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-sm text-center text-gray-500 whitespace-nowrap">
                            No prescribed activities found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $prescribedActivities->links('vendor.pagination.tailwind') }}
    </div>

    <!-- Delete Confirmation Modal -->
    @if ($showDeleteModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-50"
            @keydown.window.escape="$wire.closeModal()">
            <div class="w-full max-w-md bg-white rounded-lg shadow-xl">
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Delete Prescribed Activity</h3>
                    <button wire:click="closeModal" class="text-gray-400 hover:text-gray-500">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div class="px-6 py-4">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 p-2 bg-red-100 rounded-full">
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                </path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-700">
                                Are you sure you want to delete this Prescribed Activity? This action cannot be undone.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="px-4 py-3 bg-gray-50 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" wire:click="deletePrescribedActivity"
                        class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white bg-red-600 border border-transparent rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Delete
                    </button>
                    <button type="button" wire:click="closeModal"
                        class="inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    @endif

    <!-- Conditionally include components -->
    @if($showCreateModal)
        @livewire('admin.prescribed-activities.create-prescribed-activity', key('create-prescribed-activity'))
    @endif

    @if($prescribedActivityIdBeingEdited)
        @livewire('admin.prescribed-activities.edit-prescribed-activity', ['prescribedActivityId' => $prescribedActivityIdBeingEdited], key('edit-prescribed-activity-'.$prescribedActivityIdBeingEdited))
    @endif

    @if($prescribedActivityIdBeingViewed)
        @livewire('admin.prescribed-activities.view-prescribed-activity', ['prescribedActivityId' => $prescribedActivityIdBeingViewed], key('view-prescribed-activity-'.$prescribedActivityIdBeingViewed))
    @endif

    <!-- JavaScript for Event Listeners -->
    <script>
        document.addEventListener('livewire:initialized', () => {
            // Handle escape key to close modals
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') {
                    Livewire.dispatch('closeModal');
                }
            });

            // Handle click outside for delete modal
            document.addEventListener('click', (e) => {
                if (e.target.classList.contains('modal-overlay')) {
                    Livewire.dispatch('closeModal');
                }
            });
        });
    </script>
</div>
