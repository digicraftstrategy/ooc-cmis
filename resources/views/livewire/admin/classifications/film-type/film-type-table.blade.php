<div>
    <x-slot name='header'>
        <div class="px-4 py-2 bg-blue-100">
            <h2 class="text-xl font-semibold">
                Manage Film Types
            </h2>
        </div>
    </x-slot>

    <!-- Header and search -->
    <div>
        <div class="mb-4 flex flex-wrap items-center gap-4">
            <div class="flex-1 min-w-[200px]">
                <input wire:model.live.debounce.300ms="search" type="text"
                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    placeholder="Search film types...">
            </div>
            <div class="flex">
                <x-blue-button wire:click="openCreateModal"
                    class="px-4 py-2 text-sm font-medium text-white transition-colors duration-200 bg-indigo-600 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-4 h-4 mr-1" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                            clip-rule="evenodd" />
                    </svg>
                    Add Film Type
                </x-blue-button>
            </div>
        </div>
    </div>

    <!-- Flash Messages -->
    @if (session()->has('message'))
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
                    <p class="text-sm font-medium text-green-800">{{ session('message') }}</p>
                </div>
                <button @click="show = false" class="flex-shrink-0 text-green-500 hover:text-green-700">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
    @endif

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
                <thead class="bg-blue-50">
                    <tr>
                        <th scope="col" class="w-12 px-3 py-3 text-xs font-medium text-blue-700 uppercase tracking-wider">
                            #
                        </th>
                        <th scope="col" class="px-3 py-3 text-xs font-medium text-blue-700 uppercase tracking-wider cursor-pointer"
                            wire:click="sortBy('type')">
                            <div class="flex items-center space-x-1">
                                <span>Film Type</span>
                                @if ($sortField === 'type')
                                    <span class="text-xs">{!! $sortDirection === 'asc' ? '↑' : '↓' !!}</span>
                                @endif
                            </div>
                        </th>
                        <th scope="col" class="px-3 py-3 text-xs font-medium text-blue-700 uppercase tracking-wider cursor-pointer"
                            wire:click="sortBy('slug')">
                            <div class="flex items-center space-x-1">
                                <span>Slug</span>
                                @if ($sortField === 'slug')
                                    <span class="text-xs">{!! $sortDirection === 'asc' ? '↑' : '↓' !!}</span>
                                @endif
                            </div>
                        </th>
                        <th scope="col" class="px-3 py-3 text-xs font-medium text-blue-700 uppercase tracking-wider">
                            Description
                        </th>
                        <th scope="col" class="w-32 px-3 py-3 text-xs font-medium text-blue-700 uppercase tracking-wider">
                            Created
                        </th>
                        <th scope="col" class="w-20 px-3 py-3 text-xs font-medium text-blue-700 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($paginateFilmTypes as $film_type)
                        <tr class="hover:bg-gray-50">
                            <td class="px-3 py-2 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900 text-center">
                                    {{ $loop->iteration }}
                                </div>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $film_type->type }}
                                </div>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap">
                                <div class="text-sm text-gray-600 font-mono">
                                    {{ $film_type->slug ?? 'N/A' }}
                                </div>
                            </td>
                            <td class="px-3 py-2">
                                <div class="text-sm text-gray-600 max-w-xs truncate" title="{{ $film_type->description }}">
                                    {{ $film_type->description }}
                                </div>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap">
                                <div class="text-xs text-gray-500">
                                    {{ $film_type->created_at ? $film_type->created_at->format('M d, Y') : '—' }}
                                </div>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex justify-end space-x-1">
                                    <button wire:click="openViewModal({{ $film_type->id }})" 
                                        class="text-blue-600 hover:text-blue-900 p-1 rounded hover:bg-blue-50"
                                        title="View">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </button>

                                    <button wire:click="openEditModal({{ $film_type->id }})"
                                        class="text-green-600 hover:text-green-900 p-1 rounded hover:bg-green-50"
                                        title="Edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </button>

                                    <button wire:click="openDeleteModal({{ $film_type->id }})"
                                        class="text-red-600 hover:text-red-900 p-1 rounded hover:bg-red-50"
                                        title="Delete">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-3 py-4 text-sm text-center text-gray-500 whitespace-nowrap">
                                No film types found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-3">
        {{ $paginateFilmTypes->links('vendor.pagination.tailwind') }}
    </div>

    <!-- Modal Control Script -->
    <script>
        document.addEventListener('livewire:initialized', () => {
            // Handle escape key for all modals
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') {
                    Livewire.dispatch('closeModal');
                }
            });

            // Handle click outside for all modals
            document.addEventListener('click', (e) => {
                if (e.target.classList.contains('modal-overlay')) {
                    Livewire.dispatch('closeModal');
                }
            });
        });
    </script>
</div>