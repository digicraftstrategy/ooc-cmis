<div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50 py-6 px-4 sm:px-6 lg:px-8">
    <!-- Navigation Component (same as Films page) -->
    <livewire:admin.classifications.films-publication-navigation />

    <!-- Header Section -->
    <div class="mb-6">
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-xl shadow-lg overflow-hidden">
            <div class="px-6 py-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <h1 class="text-xl md:text-2xl font-bold text-white mb-1">
                            Manage Advertisement Matter
                        </h1>
                        <p class="text-blue-100 opacity-90 text-sm">
                            Manage all registered advertisement submissions in the system
                        </p>
                    </div>

                    {{-- Link to create advertisement page (adjust route name if different) --}}
                     <a href="{{ route('admin.classifications.advertisement.create') }}"
                       class="px-4 py-2 bg-white text-blue-600 hover:bg-blue-50 border-transparent shadow font-medium rounded-lg transition-all duration-200 flex items-center text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                  d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                  clip-rule="evenodd" />
                        </svg>
                        Add New Advertisement
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Flash Messages -->
    @if (session()->has('success'))
        <div class="mb-4">
            <div class="rounded-lg bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 shadow-sm">
                {{ session('success') }}
            </div>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="mb-4">
            <div class="rounded-lg bg-red-50 border border-red-200 text-red-700 px-4 py-3 shadow-sm">
                {{ session('error') }}
            </div>
        </div>
    @endif

    <!-- Stats Cards Section -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <!-- Total Advertisements -->
        <div class="bg-white p-4 rounded-lg shadow">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Advertisements</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['total'] }}</p>
                </div>
                @if($search)
                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                        Filtered
                    </span>
                @endif
            </div>
        </div>

        <!-- Classified -->
        <div class="bg-white p-4 rounded-lg shadow">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm font-medium text-gray-500">Classified</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['classified'] }}</p>
                </div>
            </div>
        </div>

        <!-- Unclassified -->
        <div class="bg-white p-4 rounded-lg shadow">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm font-medium text-gray-500">Unclassified</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['unclassified'] }}</p>
                </div>
            </div>
        </div>

        <!-- Most Recent -->
        <div class="bg-white p-4 rounded-lg shadow">
            <p class="text-sm font-medium text-gray-500">Most Recent</p>
            <p class="text-lg font-semibold text-gray-900 truncate">
                {{ $stats['recent'] ? $stats['recent']->advertising_matter : 'N/A' }}
            </p>
            @if($stats['recent'])
                <p class="text-xs text-gray-500">
                    {{ $stats['recent']->created_at->format('M d, Y') }}
                </p>
            @endif
        </div>
    </div>

    <!-- Search Section -->
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
                    class="block w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 text-sm"
                    placeholder="Search advertisements, brands, products, directors..."
                >
            </div>

            <div class="flex items-center justify-end">
                <span class="text-sm text-gray-500">
                    {{ $films->total() }} advertisements found
                </span>
            </div>
        </div>
    </div>

    <!-- Compact Table -->
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
                            wire:click="sortBy('advertising_matter')">
                            <div class="flex items-center space-x-1">
                                <span>Advertising Matter</span>
                                @if ($sortField === 'advertising_matter')
                                    <span class="text-xs">{!! $sortDirection === 'asc' ? '↑' : '↓' !!}</span>
                                @endif
                            </div>
                        </th>

                        <th scope="col"
                            class="px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider whitespace-nowrap w-auto">
                            Brand Promoted
                        </th>

                        <th scope="col"
                            class="px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider whitespace-nowrap w-auto">
                            Product Promoted
                        </th>

                        <th scope="col"
                            class="px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider whitespace-nowrap w-auto">
                            Client Company
                        </th>

                        <th scope="col"
                            class="px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider whitespace-nowrap w-auto">
                            Duration
                        </th>

                        <th scope="col"
                            class="px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider whitespace-nowrap w-auto">
                            Release Year
                        </th>

                        <th scope="col"
                            class="px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider whitespace-nowrap w-auto">
                            Language
                        </th>

                        <th scope="col"
                            class="px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider whitespace-nowrap w-auto">
                            Director
                        </th>

                        <th scope="col"
                            class="px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider whitespace-nowrap w-auto">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($films as $advert)
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <!-- Row Number -->
                            <td class="px-3 py-2 whitespace-nowrap text-sm font-medium text-gray-900 text-center">
                                {{ $loop->iteration + ($films->currentPage() - 1) * $films->perPage() }}
                            </td>

                            <!-- Advertising Matter Title -->
                            <td class="px-3 py-2 whitespace-nowrap">
                                {{-- Adjust route / slug field if different --}}
                                <a
                                    href="{{ route('admin.classifications.advertisement.show', $advert->slug ?? $advert->id) }}"
                                    class="flex items-center w-full px-3 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition-colors duration-150"
                                >
                                    <div class="text-sm font-semibold text-gray-900">
                                        {{ $advert->advertising_matter }}
                                    </div>
                                </a>
                            </td>

                            <!-- Brand Promoted -->
                            <td class="px-3 py-2">
                                <div class="text-sm text-gray-700 max-w-xs truncate" title="{{ $advert->brand_promoted }}">
                                    {{ $advert->brand_promoted ?? '—' }}
                                </div>
                            </td>

                            <!-- Product Promoted -->
                            <td class="px-3 py-2">
                                <div class="text-sm text-gray-700 max-w-xs truncate" title="{{ $advert->product_promoted }}">
                                    {{ $advert->product_promoted ?? '—' }}
                                </div>
                            </td>

                            <!-- Client Company -->
                            <td class="px-3 py-2">
                                <div class="text-sm text-gray-700 max-w-xs truncate" title="{{ $advert->client_company }}">
                                    {{ $advert->client_company ?? '—' }}
                                </div>
                            </td>

                            <!-- Duration -->
                            <td class="px-3 py-2 whitespace-nowrap">
                                <div class="text-sm text-gray-700">
                                    {{ $advert->duration ? $advert->duration . ' sec' : '—' }}
                                </div>
                            </td>

                            <!-- Release Year -->
                            <td class="px-3 py-2 whitespace-nowrap">
                                <div class="text-sm text-gray-700">
                                    {{ $advert->release_year ?? '—' }}
                                </div>
                            </td>

                            <!-- Language -->
                            <td class="px-3 py-2 whitespace-nowrap">
                                <div class="text-sm text-gray-700">
                                    {{ $advert->language ?? '—' }}
                                </div>
                            </td>

                            <!-- Director -->
                            <td class="px-3 py-2">
                                <div class="text-sm text-gray-700 max-w-xs truncate" title="{{ $advert->director }}">
                                    {{ $advert->director ?? '—' }}
                                </div>
                            </td>

                            <!-- Actions -->
                            <td class="px-3 py-2 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex justify-end">
                                    <div class="relative" x-data="{ open: false }">
                                        <button
                                            @click="open = !open"
                                            @click.outside="open = false"
                                            class="inline-flex items-center p-1.5 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-lg transition-colors duration-150"
                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z" />
                                            </svg>
                                        </button>

                                        <!-- Dropdown panel -->
                                        <div
                                            x-show="open"
                                            x-transition:enter="transition ease-out duration-100"
                                            x-transition:enter-start="transform opacity-0 scale-95"
                                            x-transition:enter-end="transform opacity-100 scale-100"
                                            x-transition:leave="transition ease-in duration-75"
                                            x-transition:leave-start="transform opacity-100 scale-100"
                                            x-transition:leave-end="transform opacity-0 scale-95"
                                            class="absolute right-0 z-10 mt-1 w-44 bg-white rounded-lg shadow-lg border border-gray-200 py-1"
                                            style="display: none;"
                                        >
                                            <!-- View option -->
                                            <a
                                                href="{{ route('admin.classifications.advertisement.show', $advert->slug ?? $advert->id) }}"
                                                class="flex items-center w-full px-3 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition-colors duration-150"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                          d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                                View Details
                                            </a>

                                            <!-- Edit option (implement openEditModal in Livewire if needed) -->
                                            <button
                                                wire:click="openEditModal({{ $advert->id }})"
                                                @click="open = false"
                                                class="flex items-center w-full px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition-colors duration-150"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                          d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                                Edit Advertisement
                                            </button>

                                            <!-- Delete option -->
                                            <button
                                                wire:click="openDeleteModal({{ $advert->id }})"
                                                @click="open = false"
                                                class="flex items-center w-full px-3 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-red-700 transition-colors duration-150"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                                Delete Advertisement
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="px-3 py-8 text-center">
                                <div class="flex flex-col items-center justify-center text-gray-400">
                                    <svg class="w-12 h-12 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                              d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z" />
                                    </svg>
                                    <p class="text-sm font-medium text-gray-500">No advertisements found</p>
                                    <p class="text-xs mt-1">Try adjusting your search criteria or add a new advertisement</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($films->hasPages())
            <div class="px-4 py-3 bg-gray-50 border-t border-gray-200">
                {{ $films->links('vendor.pagination.tailwind') }}
            </div>
        @endif
    </div>

    <!-- Delete Confirmation Modal -->
    @if($showDeleteModal && $selectedAdvertisement)
        <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
            <div class="relative top-20 mx-auto p-4 border w-full max-w-md shadow-lg rounded-md bg-white">
                <div class="mt-3">
                    <div class="flex items-center justify-center mx-auto w-12 h-12 rounded-full bg-red-100">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                    </div>

                    <div class="mt-2 text-center">
                        <h3 class="text-lg font-medium text-gray-900">Delete Advertisement</h3>
                        <p class="mt-2 text-sm text-gray-500">
                            Are you sure you want to delete
                            "{{ $selectedAdvertisement->advertising_matter }}"? This action cannot be undone.
                        </p>
                    </div>

                    <div class="mt-4 flex justify-center space-x-3">
                        <button
                            wire:click="closeDeleteModal"
                            class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition-colors duration-200">
                            Cancel
                        </button>
                        <button
                            wire:click="deleteAdvertisement"
                            class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition-colors duration-200">
                            Delete Advertisement
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

