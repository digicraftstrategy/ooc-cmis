<div class="p-6">
    <!-- Film Header -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
        <div class="flex items-start justify-between">
            <div class="flex-1">
                <h1 class="text-2xl font-bold text-gray-900 mb-2">{{ $film->film_title }}</h1>
                <div class="flex items-center gap-3 flex-wrap">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                        {{ $film->filmType->type ?? 'N/A' }}
                    </span>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                        {{ $film->duration }} minutes
                    </span>
                    @if($film->has_subtitle)
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
                            With Subtitles
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="space-y-6">
        <!-- Film Details & Production Team -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Film Details -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 pb-3 border-b border-gray-200 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Film Details
                </h3>
                <div class="space-y-4">
                    <div class="flex justify-between items-start">
                        <span class="text-sm font-medium text-gray-500">Genre</span>
                        <span class="text-sm text-gray-900 text-right">{{ $film->genre ?? 'Not specified' }}</span>
                    </div>
                    <div class="flex justify-between items-start">
                        <span class="text-sm font-medium text-gray-500">Language</span>
                        <span class="text-sm text-gray-900 text-right">{{ $film->language ?? 'Not specified' }}</span>
                    </div>
                    <div class="flex justify-between items-start">
                        <span class="text-sm font-medium text-gray-500">Color</span>
                        <span class="text-sm text-gray-900 text-right">{{ $film->color ?? 'Not specified' }}</span>
                    </div>
                    <div class="flex justify-between items-start">
                        <span class="text-sm font-medium text-gray-500">Release Year</span>
                        <span class="text-sm text-gray-900 text-right">{{ $film->release_year ?? 'Not specified' }}</span>
                    </div>
                    <div class="flex justify-between items-start">
                        <span class="text-sm font-medium text-gray-500">Country</span>
                        <span class="text-sm text-gray-900 text-right">{{ $film->country ?? 'Not specified' }}</span>
                    </div>
                </div>
            </div>

            <!-- Production Team -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 pb-3 border-b border-gray-200 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    Production Team
                </h3>
                <div class="space-y-4">
                    <div>
                        <span class="block text-sm font-medium text-gray-500 mb-1">Director</span>
                        <span class="text-sm text-gray-900">{{ $film->director ?? 'Not specified' }}</span>
                    </div>
                    <div>
                        <span class="block text-sm font-medium text-gray-500 mb-1">Producer</span>
                        <span class="text-sm text-gray-900">{{ $film->producer ?? 'Not specified' }}</span>
                    </div>
                    <div>
                        <span class="block text-sm font-medium text-gray-500 mb-1">Production Company</span>
                        <span class="text-sm text-gray-900">{{ $film->production_company ?? 'Not specified' }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Media Section -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Poster Display -->
            @if($film->poster_path)
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 pb-3 border-b border-gray-200">Film Poster</h3>
                    <div class="flex justify-center">
                        <img src="{{ asset('storage/' . $film->poster_path) }}"
                             alt="{{ $film->film_title }} poster"
                             class="w-48 h-64 object-cover rounded-lg shadow-md border border-gray-200">
                    </div>
                </div>
            @endif

            <!-- Trailer Link -->
            @if($film->trailer_url)
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 pb-3 border-b border-gray-200">Trailer</h3>
                    <div class="flex flex-col items-center justify-center h-full space-y-4">
                        <a href="{{ $film->trailer_url }}"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="inline-flex items-center px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 transition-colors duration-200">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/>
                            </svg>
                            Watch Trailer
                        </a>
                        <p class="text-xs text-gray-500 text-center">Opens in new window</p>
                    </div>
                </div>
            @endif
        </div>

        <!-- Casts Section -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4 pb-3 border-b border-gray-200 flex items-center">
                <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                Cast Members
            </h3>
            <div class="bg-gray-50 rounded-lg p-4">
                <p class="text-sm text-gray-700 whitespace-pre-wrap leading-relaxed">
                    {{ $film->casts ?? 'No cast information available.' }}
                </p>
            </div>
        </div>

        <!-- Theme Section -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4 pb-3 border-b border-gray-200 flex items-center">
                <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                </svg>
                Theme & Subject Matter
            </h3>
            <div class="bg-gray-50 rounded-lg p-4">
                <p class="text-sm text-gray-700 whitespace-pre-wrap leading-relaxed">
                    {{ $film->theme ?? 'No theme information available.' }}
                </p>
            </div>
        </div>

        <!-- Metadata -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4 pb-3 border-b border-gray-200 flex items-center">
                <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                Metadata
            </h3>
            <div class="space-y-3 text-sm">
                <div class="flex justify-between items-center">
                    <span class="text-gray-500 font-medium">Created</span>
                    <span class="text-gray-900">
                        {{ $film->created_at ? $film->created_at->format('M j, Y \a\t g:i A') : 'Not available' }}
                    </span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-500 font-medium">Last Updated</span>
                    <span class="text-gray-900">
                        {{ $film->updated_at ? $film->updated_at->format('M j, Y \a\t g:i A') : 'Not available' }}
                    </span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-500 font-medium">Slug</span>
                    <span class="text-gray-900 font-mono text-xs bg-gray-100 px-2 py-1 rounded">
                        {{ $film->slug }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="flex justify-end space-x-3 pt-6 mt-6 border-t border-gray-200">
        <button type="button"
                wire:click="$dispatch('close-modal')"
                class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
            Close
        </button>
        <button type="button"
                wire:click="$dispatch('open-modal', { component: 'admin.classifications.films.edit-film', arguments: { film: {{ $film->id }} } })"
                class="px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-lg shadow-sm hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 flex items-center">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
            </svg>
            Edit Film
        </button>
    </div>
</div>
