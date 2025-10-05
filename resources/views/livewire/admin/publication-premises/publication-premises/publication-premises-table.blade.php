<div class="min-h-screen bg-gray-50">
    {{-- Vehicle Owner Header --}}
    <x-slot name='header'>
        <div class="px-6 py-4 bg-gradient-to-r from-blue-600 to-indigo-700 shadow-lg">
            <h2 class="text-2xl font-bold text-white">
                {{ $premisesOwner->owners_name }} - Premises Management
            </h2>
            <p class="text-blue-100 mt-1">Manage all your premises under <b>{{ $premisesOwner->owners_name }} here</b> .</p>
        </div>
    </x-slot>

    <div class="px-6 py-4">
        <!-- Action Bar -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 p-6 bg-white rounded-xl shadow-sm mb-6">
            <div>
                <x-blue-button-link-sm href="{{ route('admin.publication-premises.premises-owner.manage', $premisesOwner->uuid) }}" wire:navigate class="flex items-center gap-2">
                    <x-icons.arrow-left class="w-4 h-4" />
                    Back to Owners
                </x-blue-button-link-sm>
            </div>

            <div class="flex-1 max-w-md">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input wire:model.live.debounce.300ms="search" type="text"
                        class="block w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200"
                        placeholder="Search premises...">
                </div>
            </div>

            <div>
                <button wire:click="openCreateModal"
                    class="flex items-center gap-2 px-5 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-medium rounded-lg shadow-md hover:from-indigo-700 hover:to-purple-700 transition-all duration-200 transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Register New Premises
                </button>
            </div>
        </div>

        <!-- Flash Messages -->
        @if (session()->has('message'))
            <div class="p-4 mb-6 bg-green-50 border-l-4 border-green-500 rounded-r-lg shadow-sm"
                x-data="{ show: true, timeLeft: 5 }"
                x-init="
                    setTimeout(() => { show = false }, 5000);
                    setInterval(() => { if (timeLeft > 0) timeLeft-- }, 1000);
                "
                x-show="show"
                x-transition:enter="transition ease-out duration-300"
                x-transition:leave="transition ease-in duration-200">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-green-800">{{ session('message') }}</p>
                        </div>
                    </div>
                    <button @click="show = false" class="ml-auto pl-3">
                        <svg class="h-5 w-5 text-green-500 hover:text-green-700" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>
        @endif

        @if (session()->has('error'))
            <div x-data="{ show: true }" x-show="show" x-transition:enter="transition ease-out duration-300" x-transition:leave="transition ease-in duration-200"
                class="p-4 mb-6 bg-red-50 border-l-4 border-red-500 rounded-r-lg shadow-sm">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-red-800">{{ session('error') }}</p>
                        </div>
                    </div>
                    <button @click="show = false" class="ml-auto pl-3">
                        <svg class="h-5 w-5 text-red-500 hover:text-red-700" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>
        @endif

        <!-- Table Container -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gradient-to-r from-blue-50 to-indigo-50">
                        <tr>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-blue-700 uppercase tracking-wider">
                                #
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-blue-700 uppercase tracking-wider">
                                Premises Name
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-blue-700 uppercase tracking-wider">
                                Business Reg. #
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-blue-700 uppercase tracking-wider">
                                Location
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-blue-700 uppercase tracking-wider">
                                Activities
                            </th>
                             <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-blue-700 uppercase tracking-wider">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-blue-700 uppercase tracking-wider">
                                Contact
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-blue-700 uppercase tracking-wider">
                                Phone
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-blue-700 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($premises as $premise)
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $loop->iteration + ($premises->currentPage() - 1) * $premises->perPage() }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-semibold text-gray-900">{{ $premise->premises_name }}</div>
                                    <div class="text-xs text-gray-500">{{ $premise->address }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $premise->business_registration_no }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $premise->location }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        @if($premise->prescribedActivities->count() > 0)
                                            @foreach($premise->prescribedActivities as $activity)
                                                <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full mr-1 mb-1">
                                                    {{ $activity->activity_type }}
                                                </span>
                                            @endforeach
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                N/A
                                            </span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($editingStatusId === $premise->id)
                                        <div class="flex items-center space-x-2">
                                            <select wire:model="newStatus" class="text-sm border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 py-1">
                                                <option value="operational">Operational</option>
                                                <option value="suspended">Suspended</option>
                                                <option value="ceased">Ceased</option>
                                            </select>
                                            <button wire:click="saveStatus({{ $premise->id }})" class="p-1 text-green-600 hover:text-green-800 transition-colors duration-200">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                            </button>
                                            <button wire:click="cancelEdit" class="p-1 text-red-600 hover:text-red-800 transition-colors duration-200">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </div>
                                    @else
                                        <div class="cursor-pointer" wire:click="editStatus({{ $premise->id }}, '{{ $premise->status }}')">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                                                {{ $premise->status === 'operational' ? 'bg-green-100 text-green-800 border border-green-200' : '' }}
                                                {{ $premise->status === 'suspended' ? 'bg-yellow-100 text-yellow-800 border border-yellow-200' : '' }}
                                                {{ $premise->status === 'ceased' ? 'bg-red-100 text-red-800 border border-red-200' : '' }}
                                                {{ !in_array($premise->status, ['operational', 'suspended', 'ceased']) ? 'bg-gray-100 text-gray-800 border border-gray-200' : '' }}
                                                transition-all duration-200 hover:shadow-md">
                                                {{ ucfirst($premise->status) }}
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </span>
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $premise->contact_person }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    <div class="flex items-center gap-1">
                                        {{--<svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>--}}
                                        {{ $premise->telephone }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex items-center justify-end space-x-2">
                                        <!-- Delete Action -->
                                        <button wire:click="openDeleteModal({{ $premise->id }})"
                                            class="text-red-600 hover:text-red-900 transition-colors duration-200 p-1 rounded hover:bg-red-50"
                                            title="Delete Premises">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>

                                        <!-- Edit Action -->
                                        <button wire:click="showEditModal({{ $premise->id }})"
                                            class="text-blue-600 hover:text-blue-900 transition-colors duration-200 p-1 rounded hover:bg-blue-50"
                                            title="Edit Premises">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center text-gray-400">
                                        <svg class="w-16 h-16 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-8 0H5m2 0h4M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                        </svg>
                                        <p class="text-lg font-medium text-gray-500">No premises registered yet</p>
                                        <p class="text-sm mt-1">Get started by registering a new premises</p>
                                        <button wire:click="openCreateModal" class="mt-4 px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors duration-200">
                                            Register First Premises
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($premises->hasPages())
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                    {{ $premises->links() }}
                </div>
            @endif
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    @if ($showDeleteModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-50 transition-opacity duration-300"
            @keydown.window.escape="$wire.closeModal()">
            <div class="w-full max-w-md bg-white rounded-xl shadow-2xl transform transition-all duration-300 scale-100 opacity-100"
                x-data x-trap.noscroll="$wire.showDeleteModal"
                @click.outside="$wire.closeModal()">
                <div class="flex items-center justify-between px-6 py-5 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Confirm Deletion</h3>
                    <button wire:click="closeModal" class="text-gray-400 hover:text-gray-500 transition-colors duration-200 rounded-full p-1 hover:bg-gray-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div class="px-6 py-5">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 p-2 bg-red-100 rounded-full">
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h4 class="text-sm font-medium text-gray-900">Delete Premises</h4>
                            <p class="mt-1 text-sm text-gray-500">
                                Are you sure you want to delete this premises? This action cannot be undone and all associated data will be permanently removed.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="px-6 py-4 bg-gray-50 rounded-b-xl flex justify-end space-x-3">
                    <button wire:click="closeModal" type="button" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                        Cancel
                    </button>
                    <button wire:click="deletePremise" type="button" class="px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-lg shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200">
                        Delete Premises
                    </button>
                </div>
            </div>
        </div>
    @endif

    <!-- Create Modal -->
    @if($showCreatedModel)
        <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity bg-gray-900 bg-opacity-75" aria-hidden="true"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div class="inline-block w-full max-w-4xl my-8 overflow-hidden text-left align-middle transition-all transform bg-white shadow-xl rounded-2xl">
                    {{--@livewire('admin.publication-premises.publication-premises.create-publication-premises', [
                        'premisesOwnerId' => $premisesOwner->id
                    ], key('create-publication-premises'))--}}
                </div>
            </div>
        </div>
    @endif

    <!-- Edit Modal -->
   @if($showModal && $premisesToEdit)
    <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity bg-gray-900 bg-opacity-75" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block w-full max-w-4xl my-8 overflow-hidden text-left align-middle transition-all transform bg-white shadow-xl rounded-2xl">
                @livewire('admin.publication-premises.publication-premises.edit-publication-premises', [
                    'premisesId' => $premisesToEdit
                ], key('edit-publication-premises-'.$premisesToEdit))
            </div>
        </div>
    </div>
    @endif
    @if($showCreatedModel)
        @livewire('admin.publication-premises.publication-premises.create-publication-premises', [
            'premisesOwnerId' => $premisesOwner->id
        ], key('create-publication-premises'))
    @endif
</div>

@push('styles')
<style>
    [x-cloak] { display: none !important; }

    /* Smooth transitions for all interactive elements */
    * {
        transition-property: color, background-color, border-color, transform, box-shadow;
        transition-duration: 200ms;
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Custom scrollbar for table */
    .overflow-x-auto::-webkit-scrollbar {
        height: 6px;
    }

    .overflow-x-auto::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 3px;
    }

    .overflow-x-auto::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 3px;
    }

    .overflow-x-auto::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }

    /* Enhanced focus styles */
    button:focus, input:focus, select:focus {
        outline: 2px solid #6366f1;
        outline-offset: 2px;
    }

    /* Gradient text for headers */
    .gradient-text {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
</style>
@endpush
