<div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50 py-6 px-4 sm:px-6 lg:px-8">

    <!-- Flash Messages -->
    @if (session()->has('message'))
        <div class="mb-4">
            <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-lg shadow-sm"
                 x-data="{ show: true, timeLeft: 5 }"
                 x-init="
                    setTimeout(() => { show = false }, 5000);
                    setInterval(() => { if (timeLeft > 0) timeLeft-- }, 1000);
                 "
                 x-show="show"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:leave="transition ease-in duration-200"
            >
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <svg class="h-5 w-5 text-emerald-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                  d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                  clip-rule="evenodd" />
                        </svg>
                        <p class="text-sm font-medium">{{ session('message') }}</p>
                    </div>
                    <button
                        @click="show = false"
                        type="button"
                        class="text-emerald-500 hover:text-emerald-700 focus:outline-none"
                    >
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                  d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                  clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="mb-4" x-data="{ show: true }" x-show="show"
             x-transition:enter="transition ease-out duration-300"
             x-transition:leave="transition ease-in duration-200">
            <div class="p-4 text-red-700 bg-red-50 border border-red-200 rounded-lg shadow-sm max-w-xl">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <svg class="h-5 w-5 text-red-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                  d="M10 18a8 8 0 100-16 8 8 0 000 16zm.75-11.5a.75.75 0 00-1.5 0v4a.75.75 0 001.5 0v-4zm0 6.5a.75.75 0 10-1.5 0 .75.75 0 001.5 0z"
                                  clip-rule="evenodd" />
                        </svg>
                        <span>{{ session('error') }}</span>
                    </div>
                    <button @click="show = false" class="text-red-500 hover:text-red-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    @endif

    <!-- Header Section (like Films / TV Series) -->
    <div class="mb-6">
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-xl shadow-lg overflow-hidden">
            <div class="px-6 py-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <h1 class="text-xl md:text-2xl font-bold text-white mb-1">
                            Manage Premises Owner Types
                        </h1>
                        <p class="text-blue-100 opacity-90 text-sm">
                            Define and maintain the different types of premises owners used across the system.
                        </p>
                    </div>

                    <div class="flex items-center gap-2">
                        <button
                            wire:click="openCreateModal"
                            class="px-4 py-2 bg-white text-blue-600 hover:bg-blue-50 border-transparent shadow font-medium rounded-lg transition-all duration-200 flex items-center text-sm"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                      d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                      clip-rule="evenodd" />
                            </svg>
                            Add Owner Type
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Search Section (same pattern as other tables) -->
    <div class="mb-4 bg-white rounded-lg shadow-sm p-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
            <div class="relative md:col-span-2">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <input
                    wire:model.live.debounce.300ms="search"
                    type="text"
                    id="search"
                    class="block w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 text-sm"
                    placeholder="Search owner types..."
                >
            </div>

            <div class="flex items-center justify-end">
                <span class="text-sm text-gray-500">
                    {{ $paginatedPremisesOwnerTypes->total() }} owner types found
                </span>
            </div>
        </div>
    </div>

    <!-- Table (Film / TV-style compact table) -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gradient-to-r from-blue-50 to-indigo-50">
                    <tr>
                        <th scope="col"
                            class="px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider whitespace-nowrap w-auto">
                            #
                        </th>
                        <th scope="col"
                            class="px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider whitespace-nowrap w-auto cursor-pointer"
                            wire:click="sortBy('type')">
                            <div class="flex items-center space-x-1">
                                <span>Owner Type</span>
                                @if ($sortField === 'type')
                                    <span class="text-xs">{!! $sortDirection === 'asc' ? '↑' : '↓' !!}</span>
                                @endif
                            </div>
                        </th>
                        <th scope="col"
                            class="px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider whitespace-nowrap w-auto">
                            Description
                        </th>
                        <th scope="col"
                            class="px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider whitespace-nowrap w-auto">
                            Created
                        </th>
                        <th scope="col"
                            class="px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider whitespace-nowrap w-auto">
                            Updated
                        </th>
                        <th scope="col"
                            class="px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider whitespace-nowrap w-auto text-right">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($paginatedPremisesOwnerTypes as $premisesOwnerType)
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <!-- Row number -->
                            <td class="px-3 py-2 whitespace-nowrap text-sm font-medium text-gray-900 text-center">
                                {{ $loop->iteration + ($paginatedPremisesOwnerTypes->currentPage() - 1) * $paginatedPremisesOwnerTypes->perPage() }}
                            </td>

                            <!-- Owner Type -->
                            <td class="px-3 py-2 whitespace-nowrap">
                                <div class="text-sm font-semibold text-gray-900">
                                    {{ $premisesOwnerType->type }}
                                </div>
                            </td>

                            <!-- Description -->
                            <td class="px-3 py-2">
                                <div class="text-sm text-gray-700 max-w-md truncate" title="{{ $premisesOwnerType->description }}">
                                    {{ $premisesOwnerType->description ?? 'N/A' }}
                                </div>
                            </td>

                            <!-- Created -->
                            <td class="px-3 py-2 whitespace-nowrap">
                                <div class="text-xs text-gray-600">
                                    <span class="font-medium">Created:</span>
                                    {{ $premisesOwnerType->created_at ? $premisesOwnerType->created_at->format('M d, Y') : '—' }}
                                </div>
                            </td>

                            <!-- Updated -->
                            <td class="px-3 py-2 whitespace-nowrap">
                                <div class="text-xs text-gray-500">
                                    <span class="font-medium">Updated:</span>
                                    {{ $premisesOwnerType->updated_at ? $premisesOwnerType->updated_at->format('M d, Y') : '—' }}
                                </div>
                            </td>

                            <!-- Actions -->
                            {{-- <td class="px-3 py-2 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex justify-end space-x-2">
                                    <x-blue-button-sm wire:click="openViewModal({{ $premisesOwnerType->id }})">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                             viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </x-blue-button-sm>

                                    <x-blue-button-sm wire:click="openEditModal({{ $premisesOwnerType->id }})">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                             viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </x-blue-button-sm>

                                    <x-blue-button-sm wire:click="openDeleteModal({{ $premisesOwnerType->id }})">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                             viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </x-blue-button-sm>
                                </div>
                            </td> --}}
            
                            <!-- Actions -->
                            <td class="px-3 py-2 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex justify-end">
                                    <div
                                        x-data="{ open: false, menuStyles: '' }"
                                        class="relative"
                                    >
                                        <button
                                            x-ref="trigger"
                                            @click="
                                                const rect = $refs.trigger.getBoundingClientRect();
                                                const top  = rect.bottom + window.scrollY + 4;
                                                const left = rect.right + window.scrollX - 176; // 176px ≈ menu width

                                                menuStyles = `top:${top}px;left:${left}px;`;
                                                open = !open;
                                            "
                                            @keydown.escape.window="open = false"
                                            class="inline-flex items-center p-1.5 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-lg transition-colors duration-150"
                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z" />
                                            </svg>
                                        </button>

                                        <!-- Floating dropdown panel (fixed, overlays everything) -->
                                        <div
                                            x-show="open"
                                            x-transition:enter="transition ease-out duration-100"
                                            x-transition:enter-start="transform opacity-0 scale-95"
                                            x-transition:enter-end="transform opacity-100 scale-100"
                                            x-transition:leave="transition ease-in duration-75"
                                            x-transition:leave-start="transform opacity-100 scale-100"
                                            x-transition:leave-end="transform opacity-0 scale-95"
                                            class="fixed z-50 w-44 bg-white rounded-lg shadow-lg border border-gray-200 py-1"
                                            :style="menuStyles"
                                            @click.outside="open = false"
                                            style="display: none;"
                                        >
                                            <!-- View option -->
                                            <a
                                                href="{{ route('admin.publication-premises.premises-owner-types.view', $premisesOwnerType->id) }}"
                                                class="flex items-center w-full px-3 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition-colors duration-150"
                                                @click="open = false"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                                View Details
                                            </a>

                                            <!-- Edit option -->
                                            <a
                                                href="{{ route('admin.publication-premises.premises-owner-types.edit', $premisesOwnerType->id) }}"
                                                class="flex items-center w-full px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition-colors duration-150"
                                                @click="open = false"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                                Edit
                                            </a>

                                            <!-- Delete option -->
                                            <button
                                                wire:click="openDeleteModal({{ $premisesOwnerType->id }})"
                                                class="flex items-center w-full px-3 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-red-700 transition-colors duration-150"
                                                @click="open = false"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
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
                            <td colspan="5" class="px-3 py-8 text-center">
                                <div class="flex flex-col items-center justify-center text-gray-400">
                                    <svg class="w-10 h-10 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                              d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875C4.254 8.25 3.75 8.754 3.75 9.375v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25z" />
                                    </svg>
                                    <p class="text-sm font-medium text-gray-500">No owner types found</p>
                                    <p class="text-xs mt-1">Try adjusting your search or add a new premises owner type.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($paginatedPremisesOwnerTypes->hasPages())
            <div class="px-4 py-3 bg-gray-50 border-t border-gray-200">
                {{ $paginatedPremisesOwnerTypes->links('vendor.pagination.tailwind') }}
            </div>
        @endif
    </div>

    <!-- Delete Confirmation Modal -->
    @if ($showDeleteModal)
        <div class="fixed inset-0 z-40 flex items-center justify-center p-4 bg-black bg-opacity-50 modal-overlay"
             x-data
             x-init="window.livewire.on('closeModal', () => { $wire.showDeleteModal = false })"
             @keydown.window.escape="$wire.closeModal()">
            <div class="w-full max-w-md bg-white rounded-xl shadow-xl">
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Delete Owner Type</h3>
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
                                Are you sure you want to delete this premises owner type? This action cannot be undone.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="px-4 py-3 bg-gray-50 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" wire:click="deletePremisesOwnerType"
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

    <!-- Include Components -->
    @livewire('admin.publication-premises.premises-owner-types.create-premises-owner-types')
    @livewire('admin.publication-premises.premises-owner-types.edit-premises-owner-types')
    @livewire('admin.publication-premises.premises-owner-types.view-premises-owner-types')

    <!-- Modal Control Script -->
    <script>
        document.addEventListener('livewire:initialized', () => {
            // Handle escape key for all modals
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') {
                    Livewire.dispatch('closeModal');
                }
            });

            // Handle click outside for all modals (using .modal-overlay class above)
            document.addEventListener('click', (e) => {
                if (e.target.classList.contains('modal-overlay')) {
                    Livewire.dispatch('closeModal');
                }
            });
        });
    </script>
</div>
