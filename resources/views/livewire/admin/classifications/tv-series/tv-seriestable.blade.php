<div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50 py-6 px-4 sm:px-6 lg:px-8">
    <livewire:admin.classifications.films-publication-navigation />
    <!-- Header Section -->
    <div class="mb-6">
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-xl shadow-lg overflow-hidden">
            <div class="px-6 py-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <h1 class="text-xl md:text-2xl font-bold text-white mb-1">Manage TV Series</h1>
                        <p class="text-blue-100 opacity-90 text-sm">Manage all TV series seasons in the system</p>
                    </div>

                    <a href="{{ route('admin.classifications.tv-series.create')}}"
                       class="px-4 py-2 bg-white text-blue-600 hover:bg-blue-50 border-transparent shadow font-medium rounded-lg transition-all duration-200 flex items-center text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                        </svg>
                        Add New TV Series
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards Section -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <!-- Total Seasons -->
        <div class="bg-white rounded-lg shadow p-4">
            <div class="flex items-center">
                <div class="p-2 bg-blue-100 rounded-lg">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Total Seasons</p>
                    <p class="text-xl font-semibold text-gray-900">{{ $stats['total'] }}</p>
                </div>
            </div>
        </div>

        <!-- Recent Season -->
        <div class="bg-white rounded-lg shadow p-4">
            <div class="flex items-center">
                <div class="p-2 bg-purple-100 rounded-lg">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Recent Season</p>
                    <p class="text-lg font-semibold text-gray-900 truncate" title="{{ $stats['recent']->season_title ?? 'N/A' }}">
                        {{ $stats['recent']->season_title ?? 'N/A' }}
                    </p>
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
                    placeholder="Search seasons...">
            </div>

            <div class="flex items-center justify-end md:col-span-2">
                @if(count($selectedSeasons) > 0)
                    <button wire:click="bulkDelete" wire:confirm="Are you sure you want to delete selected seasons?"
                        class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white font-medium rounded-lg transition-all duration-200 flex items-center text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        Delete Selected ({{ count($selectedSeasons) }})
                    </button>
                @else
                    <span class="text-sm text-gray-500">
                        {{ $seasons->total() }} seasons found
                    </span>
                @endif
            </div>
        </div>
    </div>

    <!-- Compact Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gradient-to-r from-blue-50 to-indigo-50">
                    <tr>
                        <th scope="col" class="px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider whitespace-nowrap text-left w-12">
                            <input type="checkbox" wire:model.live="selectAll">
                        </th>
                        <th scope="col" class="px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider whitespace-nowrap text-left">
                            #
                        </th>
                        <th scope="col" class="px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider whitespace-nowrap text-left">
                            TV Series
                        </th>
                        <th scope="col"
                            class="px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider whitespace-nowrap text-left cursor-pointer"
                            wire:click="sortBy('season_number')">
                            <div class="flex items-center space-x-1">
                                <span>Season No.</span>
                                @if ($sortField === 'season_number')
                                    <span class="text-xs">{!! $sortDirection === 'asc' ? '↑' : '↓' !!}</span>
                                @endif
                            </div>
                        </th>
                        <th scope="col"
                            class="px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider whitespace-nowrap text-left cursor-pointer"
                            wire:click="sortBy('season_title')">
                            <div class="flex items-center space-x-1">
                                <span>Season Title</span>
                                @if ($sortField === 'season_title')
                                    <span class="text-xs">{!! $sortDirection === 'asc' ? '↑' : '↓' !!}</span>
                                @endif
                            </div>
                        </th>
                        <th class="px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider whitespace-nowrap text-left">Episodes</th>
                        <th class="px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider whitespace-nowrap text-left">Duration</th>
                        <th scope="col"
                            class="px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider whitespace-nowrap text-left cursor-pointer"
                            wire:click="sortBy('release_year')">
                            <div class="flex items-center space-x-1">
                                <span>Year</span>
                                @if ($sortField === 'release_year')
                                    <span class="text-xs">{!! $sortDirection === 'asc' ? '↑' : '↓' !!}</span>
                                @endif
                            </div>
                        </th>
                        <th class="px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider whitespace-nowrap text-left">Genre</th>
                        <th scope="col" class="px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider whitespace-nowrap text-left">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($seasons as $season)
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-3 py-2 text-sm text-slate-700 align-top text-left">
                                <input type="checkbox" wire:model.live="selectedSeasons" value="{{ $season->id }}">
                            </td>
                            <td class="px-3 py-2 text-sm text-slate-700 align-top text-left">
                                {{ $loop->iteration + ($seasons->currentPage() - 1) * $seasons->perPage() }}
                            </td>
                            <td class="px-3 py-2 text-sm text-slate-700 align-top text-left">
                                <div class="text-sm font-semibold text-slate-800">
                                    {{ $season->tvSeries->tv_series_title ?? 'N/A' }}
                                    <p class="text-gray-500 text-xs">{{ $season->tvSeries->slug }}</p>
                                </div>
                            </td>
                            <td class="px-3 py-2 text-sm text-slate-700 align-top text-left">
                                <span class="font-semibold">S{{ str_pad($season->season_number, 2, '0', STR_PAD_LEFT) }}</span>
                            </td>
                            <td class="px-3 py-2 text-sm text-slate-700 align-top text-left">
                                <div class="truncate max-w-xs" title="{{ $season->season_title }}">
                                    {{ $season->season_title }}
                                    <p class="text-gray-500 text-xs">{{ $season->season_slug }}</p>
                                </div>
                            </td>
                            <td class="px-3 py-2 text-sm text-slate-700 align-top text-left">
                                {{ $season->number_of_episodes }} epidoes
                            </td>
                            <td class="px-3 py-2 text-sm text-slate-700 align-top text-left whitespace-nowrap">
                                {{ $season->duration }} min
                            </td>
                            <td class="px-3 py-2 text-sm text-slate-700 align-top text-left">
                                {{ $season->release_year }}
                            </td>
                            <td class="px-3 py-2 text-sm text-slate-700 align-top text-left">
                                <div class="truncate max-w-xs" title="{{ is_array($season->genre) ? implode(', ', $season->genre) : $season->genre }}">
                                    {{ is_array($season->genre) ? implode(', ', $season->genre) : $season->genre }}
                                </div>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex justify-end">
                                    <!-- Dropdown menu -->
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
                                            class="absolute right-0 z-10 mt-1 w-40 bg-white rounded-lg shadow-lg border border-gray-200 py-1"
                                            style="display: none;"
                                        >
                                            <!-- View option -->
                                            <button
                                                wire:click="openViewModal({{ $season->id }})"
                                                @click="open = false"
                                                class="flex items-center w-full px-3 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition-colors duration-150"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                                View Details
                                            </button>

                                            <!-- Edit option -->
                                            <button
                                                wire:click="openEditModal({{ $season->id }})"
                                                @click="open = false"
                                                class="flex items-center w-full px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition-colors duration-150"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                                Edit Season
                                            </button>

                                            <!-- Delete option -->
                                            <button
                                                wire:click="openDeleteModal({{ $season->id }})"
                                                @click="open = false"
                                                class="flex items-center w-full px-3 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-red-700 transition-colors duration-150"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                                Delete Season
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
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z" />
                                    </svg>
                                    <p class="text-sm font-medium text-gray-500">No seasons found</p>
                                    <p class="text-xs mt-1">Try adjusting your search criteria or add a new season</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($seasons->hasPages())
            <div class="px-4 py-3 bg-gray-50 border-t border-gray-200">
                {{ $seasons->links('vendor.pagination.tailwind') }}
            </div>
        @endif
    </div>

    <!-- Success Message -->
    @if (session()->has('message'))
        <div class="fixed top-4 right-4 z-50">
            <div class="bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    {{ session('message') }}
                </div>
            </div>
        </div>
    @endif

    <!-- Modals Section -->
    <div>
        <!-- View Season Modal -->
        @if($showViewModal && $selectedSeason)
            <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
                <div class="relative top-20 mx-auto p-4 border w-full max-w-4xl shadow-lg rounded-md bg-white">
                    <div class="mt-3">
                        <div class="flex items-center justify-between p-4 border-b">
                            <h3 class="text-xl font-semibold text-gray-900">Season Details - {{ $selectedSeason->season_title }}</h3>
                            <button wire:click="closeViewModal" class="text-gray-400 hover:text-gray-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>

                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <h4 class="text-lg font-semibold mb-4">Basic Information</h4>
                                    <dl class="space-y-3">
                                        <div>
                                            <dt class="text-sm font-medium text-gray-500">TV Series</dt>
                                            <dd class="text-sm text-gray-900">{{ $selectedSeason->tvSeries->title ?? 'N/A' }}</dd>
                                        </div>
                                        <div>
                                            <dt class="text-sm font-medium text-gray-500">Season Number</dt>
                                            <dd class="text-sm text-gray-900">{{ $selectedSeason->season_number }}</dd>
                                        </div>
                                        <div>
                                            <dt class="text-sm font-medium text-gray-500">Season Title</dt>
                                            <dd class="text-sm text-gray-900">{{ $selectedSeason->season_title }}</dd>
                                        </div>
                                    </dl>
                                </div>
                                <div>
                                    <h4 class="text-lg font-semibold mb-4">Additional Details</h4>
                                    <dl class="space-y-3">
                                        <div>
                                            <dt class="text-sm font-medium text-gray-500">Duration</dt>
                                            <dd class="text-sm text-gray-900">{{ $selectedSeason->duration }} minutes</dd>
                                        </div>
                                        <div>
                                            <dt class="text-sm font-medium text-gray-500">Released Year</dt>
                                            <dd class="text-sm text-gray-900">{{ $selectedSeason->released_year }}</dd>
                                        </div>
                                        <div>
                                            <dt class="text-sm font-medium text-gray-500">Genre</dt>
                                            <dd class="text-sm text-gray-900">{{ is_array($selectedSeason->genre) ? implode(', ', $selectedSeason->genre) : $selectedSeason->genre }}</dd>
                                        </div>
                                        <div>
                                            <dt class="text-sm font-medium text-gray-500">Language</dt>
                                            <dd class="text-sm text-gray-900">{{ $selectedSeason->language ?? 'N/A' }}</dd>
                                        </div>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Edit Season Modal -->
        @if($showEditModal && $selectedSeason)
            <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
                <div class="relative top-20 mx-auto p-4 border w-full max-w-2xl shadow-lg rounded-md bg-white">
                    <div class="mt-3">
                        <div class="flex items-center justify-between p-4 border-b">
                            <h3 class="text-xl font-semibold text-gray-900">Edit Season - {{ $selectedSeason->season_title }}</h3>
                            <button wire:click="closeEditModal" class="text-gray-400 hover:text-gray-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>

                        <div class="p-6">
                            <form wire:submit="updateSeason">
                                <div class="grid grid-cols-1 gap-4">
                                    <div>
                                        <label for="season_title" class="block text-sm font-medium text-gray-700">Season Title</label>
                                        <input type="text" wire:model="selectedSeason.season_title" id="season_title"
                                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                        @error('selectedSeason.season_title') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label for="season_number" class="block text-sm font-medium text-gray-700">Season Number</label>
                                            <input type="number" wire:model="selectedSeason.season_number" id="season_number"
                                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                            @error('selectedSeason.season_number') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                        </div>

                                        <div>
                                            <label for="number_of_episodes" class="block text-sm font-medium text-gray-700">Number of Episodes</label>
                                            <input type="number" wire:model="selectedSeason.number_of_episodes" id="number_of_episodes"
                                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                            @error('selectedSeason.number_of_episodes') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                    <div>
                                        <label for="released_year" class="block text-sm font-medium text-gray-700">Released Year</label>
                                        <input type="number" wire:model="selectedSeason.released_year" id="released_year"
                                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                        @error('selectedSeason.released_year') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="mt-6 flex justify-end space-x-3">
                                    <button type="button" wire:click="closeEditModal"
                                        class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                        Cancel
                                    </button>
                                    <button type="submit"
                                        class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                        Update Season
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Delete Confirmation Modal -->
        @if($showDeleteModal && $selectedSeason)
            <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
                <div class="relative top-20 mx-auto p-4 border w-full max-w-md shadow-lg rounded-md bg-white">
                    <div class="mt-3">
                        <div class="flex items-center justify-center mx-auto w-12 h-12 rounded-full bg-red-100">
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </div>

                        <div class="mt-2 text-center">
                            <h3 class="text-lg font-medium text-gray-900">Delete Season</h3>
                            <p class="mt-2 text-sm text-gray-500">
                                Are you sure you want to delete "{{ $selectedSeason->season_title }}"? This action cannot be undone.
                            </p>
                        </div>

                        <div class="mt-4 flex justify-center space-x-3">
                            <button wire:click="closeDeleteModal"
                                    class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition-colors duration-200">
                                Cancel
                            </button>
                            <button wire:click="deleteSeason"
                                    class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition-colors duration-200">
                                Delete Season
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
