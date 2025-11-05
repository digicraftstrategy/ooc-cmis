<div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50 py-6 px-4 sm:px-6 lg:px-8">
    <!-- Header Section -->
    <div class="mb-6">
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-xl shadow-lg overflow-hidden">
            <div class="px-6 py-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <h1 class="text-xl md:text-2xl font-bold text-white mb-1">Premises Owners Management</h1>
                        <p class="text-blue-100 opacity-90 text-sm">Manage all publication premises owners in the system</p>
                    </div>
                    <button wire:click="openCreateModal"
                        class="px-4 py-2 bg-white text-blue-600 hover:bg-blue-50 border-transparent shadow font-medium rounded-lg transition-all duration-200 flex items-center text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                        </svg>
                        Add New Owner
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Search and Filter Section -->
    <div class="mb-4 bg-white rounded-lg shadow-sm p-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <input wire:model.live.debounce.300ms="search" type="text"
                    class="block w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 text-sm"
                    placeholder="Search owners...">
            </div>

            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </div>
                <select wire:model.live="premisesOwnerFilter"
                    class="block w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 appearance-none text-sm">
                    <option value="">All Owner Types</option>
                    @foreach($premisesOwnerTypes as $premisesOwnerType)
                        <option value="{{ $premisesOwnerType->id }}">{{ $premisesOwnerType->type }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex items-center justify-end">
                <span class="text-sm text-gray-500">
                    {{ $premisesOwners->total() }} owners found
                </span>
            </div>
        </div>
    </div>

    <!-- Event-based Message Display -->
   {{-- @if ($message)
        <div class="p-3 mb-3 bg-green-50 border border-green-200 rounded-lg"
            x-data="{ show: true }"
            x-init="setTimeout(() => { show = false }, 5000)"
            x-show="show"
            x-transition:enter="transition ease-out duration-300"
            x-transition:leave="transition ease-in duration-200">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <div class="w-4 h-4 bg-green-500 rounded-full flex items-center justify-center mt-0.5">
                        <svg class="w-2.5 h-2.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                </div>
                <div class="ml-2 flex-1">
                    <p class="text-sm font-medium text-green-800">{{ $message }}</p>
                </div>
                <button @click="show = false; $wire.clearMessage()" class="flex-shrink-0 text-green-500 hover:text-green-700">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
    @endif--}}

    @if (session()->has('error'))
        <div x-data="{ show: true }" x-show="show"
            class="p-3 mb-3 text-red-700 bg-red-100 border border-red-200 rounded-lg"
            role="alert">
            <div class="flex items-center justify-between">
                <span class="text-sm">{{ session('error') }}</span>
                <button @click="show = false" class="text-red-500 hover:text-red-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    @endif

    <!-- Compact Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gradient-to-r from-blue-50 to-indigo-50">
                    <tr>
                        <th scope="col" class="w-12 px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider">
                            #
                        </th>
                        <th scope="col" class="px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider cursor-pointer"
                            wire:click="sortBy('owners_name')">
                            <div class="flex items-center space-x-1">
                                <span>Owner Name</span>
                                @if ($sortField === 'owners_name')
                                    <span class="text-xs">{!! $sortDirection === 'asc' ? '↑' : '↓' !!}</span>
                                @endif
                            </div>
                        </th>
                        <th scope="col" class="w-24 px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider">
                            Owner Type
                        </th>
                        {{--<th scope="col" class="px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider">
                            HQ Address
                        </th>--}}
                        <th scope="col" class="w-32 px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider">
                            Contact Info
                        </th>
                        <th scope="col" class="w-20 px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($premisesOwners as $premisesOwner)
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-3 py-2 whitespace-nowrap text-sm font-medium text-gray-900 text-center">
                                {{ $loop->iteration + ($premisesOwners->currentPage() - 1) * $premisesOwners->perPage() }}
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap">
                                <div class="text-sm font-semibold text-gray-900">{{ $premisesOwner->owners_name }}</div>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap">
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ $premisesOwner->premises_type->type ?? 'N/A' }}
                                </span>
                            </td>
                            {{--<td class="px-3 py-2">
                                <div class="text-sm text-gray-700 max-w-xs truncate" title="{{ $premisesOwner->address }}">
                                    {{ $premisesOwner->address }}
                                </div>
                            </td>--}}
                            <td class="px-3 py-2 whitespace-nowrap">
                                <div class="text-sm text-gray-700">{{ $premisesOwner->phone }}</div>
                                @if($premisesOwner->email)
                                    <div class="text-xs text-gray-500 truncate" title="{{ $premisesOwner->email }}">
                                        {{ $premisesOwner->email }}
                                    </div>
                                @endif
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap text-right text-sm font-medium">
                                <!-- Dropdown Menu -->
                                <div class="relative inline-block text-left" x-data="{ open: false }">
                                    <button @click="open = !open" class="inline-flex items-center p-1.5 text-gray-400 hover:text-gray-600 transition-colors duration-200 rounded-lg hover:bg-gray-100">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"></path>
                                        </svg>
                                    </button>

                                    <!-- Dropdown panel -->
                                    <div x-show="open" x-cloak @click.away="open = false"
                                        x-transition:enter="transition ease-out duration-100"
                                        x-transition:enter-start="transform opacity-0 scale-95"
                                        x-transition:enter-end="transform opacity-100 scale-100"
                                        x-transition:leave="transition ease-in duration-75"
                                        x-transition:leave-start="transform opacity-100 scale-100"
                                        x-transition:leave-end="transform opacity-0 scale-95"
                                        class="absolute right-0 z-50 mt-2 w-48 origin-top-right bg-white rounded-lg shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                                        <div class="py-1" role="menu" aria-orientation="vertical">
                                            <!-- Manage Action -->
                                            <a href="{{ route('admin.publication-premises.premises-owner.manage', $premisesOwner->uuid) }}" wire:navigate
                                                class="flex items-center px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors duration-200 group"
                                                role="menuitem">
                                                <svg class="w-4 h-4 mr-2 text-blue-500 group-hover:text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                </svg>
                                                Manage Details
                                            </a>

                                            <!-- Edit Action -->
                                            <button wire:click="openEditModal('{{ $premisesOwner->id }}')"
                                                class="flex items-center w-full px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 transition duration-150 ease-in-out focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 group"
                                                role="menuitem">
                                                <svg class="w-4 h-4 mr-2 text-green-500 group-hover:text-green-600"
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                                <span class="font-medium">Edit Owner</span>
                                            </button>

                                            <!-- Delete Action -->
                                            <button wire:click="openDeleteModal({{ $premisesOwner->id }})"
                                                class="flex items-center w-full px-3 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors duration-200 group"
                                                role="menuitem">
                                                <svg class="w-4 h-4 mr-2 text-red-500 group-hover:text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                                Delete Owner
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-3 py-8 text-center">
                                <div class="flex flex-col items-center justify-center text-gray-400">
                                    <svg class="w-12 h-12 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                    <p class="text-sm font-medium text-gray-500">No premises owners found</p>
                                    <p class="text-xs mt-1">Try adjusting your search criteria or add a new owner</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($premisesOwners->hasPages())
            <div class="px-4 py-3 bg-gray-50 border-t border-gray-200">
                {{ $premisesOwners->links('vendor.pagination.tailwind') }}
            </div>
        @endif
    </div>

    <!-- Delete Confirmation Modal -->
    @if ($showDeleteModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-50 transition-opacity duration-300"
            @keydown.window.escape="$wire.closeModal()">
            <div class="w-full max-w-md bg-white rounded-xl shadow-2xl transform transition-all duration-300 scale-100 opacity-100"
                x-data x-trap.noscroll="$wire.showDeleteModal"
                @click.outside="$wire.closeModal()">
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Confirm Deletion</h3>
                    <button wire:click="closeModal" class="text-gray-400 hover:text-gray-500 transition-colors duration-200 rounded-full p-1 hover:bg-gray-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div class="px-6 py-4">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 p-2 bg-red-100 rounded-full">
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h4 class="text-sm font-medium text-gray-900">Delete Premises Owner</h4>
                            <p class="mt-1 text-sm text-gray-500">
                                Are you sure you want to delete this premises owner? This action cannot be undone and all associated data will be permanently removed.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="px-6 py-4 bg-gray-50 rounded-b-xl flex justify-end space-x-3">
                    <button wire:click="closeModal" type="button" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                        Cancel
                    </button>
                    <button wire:click="deletePremisesOwner" type="button" class="px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-lg shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200">
                        Delete Owner
                    </button>
                </div>
            </div>
        </div>
    @endif

    <!-- Create Modal -->
    @if($showCreateModal)
        <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity bg-gray-900 bg-opacity-75" aria-hidden="true"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div class="inline-block w-full max-w-2xl my-8 overflow-hidden text-left align-middle transition-all transform bg-white shadow-xl rounded-2xl">
                    @livewire('admin.publication-premises.premises-owner.create-premises-owners', key('create-premises-owners'))
                </div>
            </div>
        </div>
    @endif

    <!-- Edit Modal -->
    @if($premisesOwnerIdBeingEdited)
        <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity bg-gray-900 bg-opacity-75" aria-hidden="true"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div class="inline-block w-full max-w-2xl my-8 overflow-hidden text-left align-middle transition-all transform bg-white shadow-xl rounded-2xl">
                    @livewire('admin.publication-premises.premises-owner.edit-premises-owners',
                        ['premisesOwnerId' => $premisesOwnerIdBeingEdited],
                        key('edit-premises-owner-'.$premisesOwnerIdBeingEdited))
                </div>
            </div>
        </div>
    @endif

    <style>
        .bg-gradient-to-br {
            background: linear-gradient(135deg, var(--tw-gradient-from), var(--tw-gradient-to));
        }

        .shadow-2xl {
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }

        .transition-transform {
            transition-property: transform;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 200ms;
        }

        [x-cloak] { display: none !important; }
    </style>
</div>
