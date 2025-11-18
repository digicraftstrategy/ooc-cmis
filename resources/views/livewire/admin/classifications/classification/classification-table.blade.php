<div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50 py-6 px-4 sm:px-6 lg:px-8">
    <!------ Navigation Component -->
    {{--<livewire:admin.classifications.films-publication-navigation />--}}

    <!-- Header Section -->
    <div class="mb-6">
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-xl shadow-lg overflow-hidden">
            <div class="px-6 py-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <h1 class="text-xl md:text-2xl font-bold text-white mb-1">Manage Classified Films & Publications</h1>
                        <p class="text-blue-100 opacity-90 text-sm">
                            Manage all contents classified in the system. Classified contents includes Films,<br>
                            TV Series, Video Games, Music, TV Advertisements, Literatures, etc..
                        </p>
                    </div>

                    <!-- Add New Classification Button -->
                    <a href="{{ route('admin.classifications.classified-items.create') }}"
                       class="px-4 py-2 bg-white text-blue-600 hover:bg-blue-50 border-transparent shadow font-medium rounded-lg transition-all duration-200 flex items-center text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                        </svg>
                        Add New Classification
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards Section -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <!-- Total Classifications -->
        <div class="bg-white p-4 rounded-lg shadow border-l-4 border-blue-500">
            <div class="flex items-center">
                <div class="bg-blue-100 p-3 rounded-lg mr-4">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Total</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $classifications->total() }}</p>
                </div>
            </div>
        </div>

        <!-- Total Approved -->
        <div class="bg-white p-4 rounded-lg shadow border-l-4 border-green-500">
            <div class="flex items-center">
                <div class="bg-green-100 p-3 rounded-lg mr-4">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Approved</p>
                    <p class="text-2xl font-bold text-green-600">
                        {{ $classifications->where('classification_status', 'Approved')->count() }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Total Rejected -->
        <div class="bg-white p-4 rounded-lg shadow border-l-4 border-red-500">
            <div class="flex items-center">
                <div class="bg-red-100 p-3 rounded-lg mr-4">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Rejected</p>
                    <p class="text-2xl font-bold text-red-600">
                        {{ $classifications->where('classification_status', 'Rejected')->count() }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Total Second Opinion -->
        <div class="bg-white p-4 rounded-lg shadow border-l-4 border-amber-500">
            <div class="flex items-center">
                <div class="bg-amber-100 p-3 rounded-lg mr-4">
                    <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Second Opinion</p>
                    <p class="text-2xl font-bold text-amber-600">
                        {{ $classifications->where('is_second_opinion', true)->count() }}
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
                <input
                    wire:model.live.debounce.300ms="search"
                    type="text"
                    class="block w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 text-sm"
                    placeholder="Search classifications..."
                >
            </div>

            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </div>

                <select
                    wire:model.live="typeFilter"
                    class="block w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 appearance-none text-sm"
                >
                    <option value="">All Types</option>
                    <option value="film">Film</option>
                    <option value="season">TV Series</option>
                    <option value="literature">Literature</option>
                    <option value="advertisement_matter">Advertisement</option>
                    <option value="audio">Audio</option>
                </select>
            </div>
            <div class="flex items-center justify-end">
                <span class="text-sm text-gray-500">
                    {{ $classifications->total() }} classifications found
                </span>
            </div>
        </div>
    </div>

    <!-- Success Message -->
    @if (session()->has('message'))
        <div class="mb-4 p-4 bg-green-50 border-l-4 border-green-500 rounded-lg shadow-sm">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-green-700">{{ session('message') }}</p>
                </div>
            </div>
        </div>
    @endif

    <!-- Compact Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gradient-to-r from-blue-50 to-indigo-50">
                    <tr>
                        <th scope="col" class="px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider whitespace-nowrap w-auto">
                            #
                        </th>
                        <th scope="col" class="px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider whitespace-nowrap w-auto">
                            Title
                        </th>
                        <th scope="col" class="px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider whitespace-nowrap w-auto">
                            Category
                        </th>
                        <th scope="col" class="px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider whitespace-nowrap w-auto">
                            Rating
                        </th>
                        <th scope="col" class="px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider whitespace-nowrap w-auto">
                            Duration
                        </th>
                        <th scope="col" class="px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider whitespace-nowrap w-auto">
                            Status
                        </th>
                        {{--<th scope="col" class="px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider whitespace-nowrap w-auto">
                            Category
                        </th>--}}
                        <th scope="col" class="px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider whitespace-nowrap w-auto">
                            Date Classified
                        </th>
                        <th scope="col" class="px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider whitespace-nowrap w-auto">
                            Viewed By
                        </th>
                        <th scope="col" class="px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider whitespace-nowrap w-auto">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($classifications as $classification)
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-3 py-2 whitespace-nowrap text-sm font-medium text-gray-900 text-center">
                                {{ $loop->iteration + ($classifications->currentPage() - 1) * $classifications->perPage() }}
                            </td>

                            <!-- Classified Item -->
                            <td class="px-3 py-2 whitespace-nowrap">
                                <div class="text-sm font-semibold text-gray-900 max-w-xs truncate">
                                    {{ $classification->item_title }}

                                    @if ($classification->classifiable && $classification->classifiable_type === \App\Models\TvSeriesSeason::class)
                                        <div class="text-gray-500 text-xs mt-1">
                                            @if($classification->classifiable->season_title && $classification->classifiable->number_of_episodes)
                                                {{ $classification->classifiable->season_title }} - {{ $classification->classifiable->number_of_episodes }} episodes
                                            @elseif($classification->classifiable->season_title)
                                                {{ $classification->classifiable->season_title }}
                                            @elseif($classification->classifiable->number_of_episodes)
                                                {{ $classification->classifiable->number_of_episodes }} episodes
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </td>

                            <!-- Type -->
                            <td class="px-3 py-2 whitespace-nowrap">
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ $classification->media_type_label }}
                                </span>
                            </td>

                            <!-- Rating  -->
                            <td class="px-3 py-2 whitespace-nowrap">
                                <div class="flex items-center space-x-2">
                                    <!-- Icon Container -->
                                    <div class="flex-shrink-0">
                                        @if($classification->rating && $classification->rating->icon_url && $classification->rating->iconExists())
                                            <img
                                                src="{{ $classification->rating->icon_url }}"
                                                alt="{{ $classification->rating->rating }}"
                                                class="w-8 h-8 object-contain bg-white border border-gray-200 rounded shadow-sm"
                                                onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                                            >
                                            <!-- Fallback icon when image fails to load -->
                                            <div class="w-8 h-8 hidden items-center justify-center bg-indigo-100 rounded border border-indigo-200 shadow-sm">
                                                <span class="text-xs font-bold text-indigo-700">
                                                    {{ $classification->rating ? substr($classification->rating->rating, 0, 2) : 'N/A' }}
                                                </span>
                                            </div>
                                        @else
                                            <!-- Fallback icon when no image exists -->
                                            <div class="w-8 h-8 flex items-center justify-center bg-indigo-100 rounded border border-indigo-200 shadow-sm">
                                                <span class="text-xs font-bold text-indigo-700">
                                                    {{ $classification->rating ? substr($classification->rating->rating, 0, 2) : 'N/A' }}
                                                </span>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Rating Name -->
                                    <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-indigo-100 text-indigo-800 border border-indigo-200">
                                        {{ $classification->rating->rating ?? 'N/A' }}
                                    </span>
                                </div>
                            </td>
                            <!-- Duration -->
                            <td class="px-3 py-2 whitespace-nowrap">
                                <div class="text-sm text-gray-700">
                                    {{ $classification->classifiable->duration ?? 'N/A' }} min
                                </div>
                            </td>

                            <!-- Status -->
                            <td class="px-3 py-2 whitespace-nowrap">
                                {{--<span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium {{ $classification->getStatusBadgeColor() }}">
                                    {{ $classification->classification_status }}
                                </span>
                                @if($classification->is_second_opinion)
                                    <span class="inline-block ml-1 text-xs text-amber-600" title="Second Opinion">
                                        ⚡
                                    </span>
                                @endif--}}
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium {{ $classification->status_badge_color }}">
                                    {{ $classification->classification_status }}
                                </span>

                            </td>

                            <!-- Category -->
                            {{--<td class="px-3 py-2 whitespace-nowrap">
                                <div class="text-sm text-gray-700">
                                    {{ $classification->category->name ?? 'N/A' }}
                                </div>
                            </td>--}}

                            <!-- Date -->
                            <td class="px-3 py-2 whitespace-nowrap">
                                <div class="text-sm text-gray-700">
                                    {{ optional($classification->classification_date)->format('M d, Y') ?? 'N/A' }}
                                </div>
                            </td>

                            <!-- Viewed By -->
                            <td class="px-3 py-2 whitespace-nowrap">
                                <div class="text-sm text-gray-700">
                                    {{ $classification->viewed_by ?? 'N/A' }}
                                </div>
                            </td>

                            <!-- Actions -->
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
                                                wire:click="viewClassification({{ $classification->id }})"
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
                                                wire:click="editClassification({{ $classification->id }})"
                                                @click="open = false"
                                                class="flex items-center w-full px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition-colors duration-150"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                                Edit
                                            </button>

                                            <!-- Delete option -->
                                            <button
                                                wire:click="deleteClassification({{ $classification->id }})"
                                                wire:confirm="Are you sure you want to delete this classification?"
                                                @click="open = false"
                                                class="flex items-center w-full px-3 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-red-700 transition-colors duration-150"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
                            <td colspan="9" class="px-3 py-8 text-center">
                                <div class="flex flex-col items-center justify-center text-gray-400">
                                    <svg class="w-12 h-12 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
                                    </svg>
                                    <p class="text-sm font-medium text-gray-500">No classifications found</p>
                                    <p class="text-xs mt-1">Try adjusting your search criteria or add a new classification</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($classifications->hasPages())
            <div class="px-4 py-3 bg-gray-50 border-t border-gray-200">
                {{ $classifications->links('vendor.pagination.tailwind') }}
            </div>
        @endif
    </div>
</div>
