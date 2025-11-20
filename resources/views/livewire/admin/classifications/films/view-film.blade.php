<div class="p-6 bg-gray-50 max-w-6xl mx-auto">
    <!-- Header -->
    <header class="px-2 sm:px-4 lg:px-4 py-6">
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-2xl shadow-lg overflow-hidden">
            <div class="px-6 py-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                    <!-- Title + Metadata Pills -->
                    <div>
                        <h1 class="text-3xl font-bold text-white uppercase tracking-wide">
                            {{ $film->film_title }}
                        </h1>

                        <div class="mt-2 flex flex-wrap items-center gap-2">

                            <span class="inline-flex items-center px-3 py-1.5 rounded text-xs font-semibold bg-white/20 text-white border border-white/30">
                                {{ $film->filmType->type ?? 'Single' }}
                            </span>

                            @if($film->duration)
                                <span class="inline-flex items-center px-3 py-1.5 rounded text-xs font-semibold bg-white/20 text-white border border-white/30">
                                    {{ $film->duration }} minutes
                                </span>
                            @endif

                            @if($film->has_subtitle)
                                <span class="inline-flex items-center px-3 py-1.5 rounded text-xs font-semibold bg-white/20 text-white border border-white/30">
                                    With Subtitles
                                </span>
                            @endif

                            @if($film->release_year)
                                <span class="inline-flex items-center px-3 py-1.5 rounded text-xs font-semibold bg-white/20 text-white border border-white/30">
                                    {{ $film->release_year }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="flex items-center gap-2">
                        <a href="{{ route('admin.classifications.films') }}"
                           class="px-3 py-2 text-sm rounded-lg bg-white/10 text-white hover:bg-white/20 border border-white/20 transition">
                            Back
                        </a>
                        <a href="{{ route('admin.classifications.films.edit', $film->slug) }}"
                            class="inline-flex items-center px-4 py-2 text-sm rounded-lg bg-white text-blue-700 hover:bg-blue-50 shadow">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            Edit Film
                        </a>
                    </div>
                </div>

                <!-- Breadcrumb -->
                <nav class="mt-4 text-xs text-blue-100">
                    <ol class="flex items-center gap-2">
                        <li>
                            <a href="{{ route('admin.classifications.films') }}" class="hover:underline">Films</a>
                        </li>
                        <li>/</li>
                        <li class="text-white font-medium">{{ $film->film_title }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </header>
    
    <div class="space-y-6">
        <!-- Top Layout: fixed 3-column grid -->
        <div class="grid grid-cols-3 gap-6">
            <!-- Preview -->
            <div class="col-span-1">
                <div class="bg-white rounded-lg shadow-md border border-gray-200 p-4 h-full">
                    <div class="flex items-center gap-2 mb-3 pb-2 border-b border-gray-200">
                        <span class="inline-flex items-center justify-center w-7 h-7 rounded bg-blue-600 text-white">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M4 4v16l8-4 8 4V4a2 2 0 00-2-2H6a2 2 0 00-2 2z"/>
                            </svg>
                        </span>
                        <h3 class="text-xs font-bold text-gray-800 uppercase tracking-wide">Preview</h3>
                    </div>

                    @if($film->poster_path)
                        <a
                            @if($film->trailer_url)
                                href="{{ $film->trailer_url }}"
                                target="_blank"
                                rel="noopener noreferrer"
                            @else
                                href="#"
                            @endif
                            class="group relative block w-full overflow-hidden rounded bg-gray-100 aspect-[3/4] border border-gray-300"
                        >
                            <img
                                src="{{ asset('storage/' . $film->poster_path) }}"
                                alt="{{ $film->film_title }} poster"
                                class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105"
                            >
                            @if($film->trailer_url)
                                <!-- Dark overlay -->
                                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/50 to-black/30 opacity-60 group-hover:opacity-85 transition-opacity duration-300"></div>
                                <!-- Play button -->
                                <div class="absolute inset-0 flex flex-col items-center justify-center text-center">
                                    <div class="inline-flex items-center justify-center w-14 h-14 rounded-full bg-red-600 text-white shadow-2xl group-hover:scale-110 group-hover:bg-red-700 transition-all duration-300 border-2 border-white">
                                        <svg class="w-6 h-6 ml-0.5" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M8 5v14l11-7z"/>
                                        </svg>
                                    </div>
                                    <p class="mt-2 text-xs font-bold text-white tracking-wide">
                                        TRAILER
                                    </p>
                                </div>
                            @endif
                        </a>
                    @else
                        <div class="flex items-center justify-center aspect-[3/4] rounded border-2 border-dashed border-gray-300 bg-gray-100">
                            <div class="text-center">
                                <p class="text-xs font-semibold text-gray-600">No poster</p>
                                @if($film->trailer_url)
                                    <a href="{{ $film->trailer_url }}" target="_blank" rel="noopener noreferrer"
                                       class="mt-2 inline-flex items-center px-3 py-1.5 rounded text-xs font-bold bg-red-600 text-white hover:bg-red-700 transition-colors shadow-md">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M10 8v8l6-4z"/>
                                        </svg>
                                        Trailer
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Right side: film + production -->
            <div class="col-span-2 space-y-4">
                <!-- Film Details -->
                <div class="bg-white rounded-lg shadow-md border border-gray-200 p-4">
                    <h3 class="text-sm font-bold text-gray-800 mb-4 pb-2 border-b border-gray-200 flex items-center gap-2 uppercase tracking-wide">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Film Details
                    </h3>
                    <div class="grid grid-cols-2 gap-x-6 gap-y-3 text-sm">
                        <div class="flex items-center gap-3 py-1.5 border-b border-gray-100">
                            <span class="text-gray-600 font-semibold min-w-[80px]">Genre:</span>
                            <span class="text-gray-900 font-medium">{{ $film->genre ?? 'Not specified' }}</span>
                        </div>
                        <div class="flex items-center gap-3 py-1.5 border-b border-gray-100">
                            <span class="text-gray-600 font-semibold min-w-[80px]">Language:</span>
                            <span class="text-gray-900 font-medium">{{ $film->language ?? 'Not specified' }}</span>
                        </div>
                        <div class="flex items-center gap-3 py-1.5 border-b border-gray-100">
                            <span class="text-gray-600 font-semibold min-w-[80px]">Color:</span>
                            <span class="text-gray-900 font-medium">{{ $film->color ?? 'Not specified' }}</span>
                        </div>
                        <div class="flex items-center gap-3 py-1.5 border-b border-gray-100">
                            <span class="text-gray-600 font-semibold min-w-[80px]">Release Year:</span>
                            <span class="text-gray-900 font-medium">{{ $film->release_year ?? 'Not specified' }}</span>
                        </div>
                        <div class="flex items-center gap-3 py-1.5">
                            <span class="text-gray-600 font-semibold min-w-[80px]">Country:</span>
                            <span class="text-gray-900 font-medium">{{ $film->country ?? 'Not specified' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Theme -->
                <div class="bg-white rounded-lg shadow-md border border-gray-200 p-4 flex flex-col">
                    <h3 class="text-sm font-bold text-gray-800 pb-2 mb-3 border-b border-gray-200 flex items-center gap-2 uppercase tracking-wide">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                        </svg>
                        Theme & Subject Matter
                    </h3>
                    <div class="bg-gray-50 rounded border border-gray-200 p-4 flex-1">
                        <p class="text-sm text-gray-800 whitespace-pre-wrap leading-relaxed">
                            {{ $film->theme ?: 'No theme information available.' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Cast & Theme (fixed 2-column grid) -->
        <div class="grid grid-cols-2 gap-6">
            <!-- Cast -->
            <div class="bg-white rounded-lg shadow-md border border-gray-200 p-4 flex flex-col">
                <h3 class="text-sm font-bold text-gray-800 pb-2 mb-3 border-b border-gray-200 flex items-center gap-2 uppercase tracking-wide">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Cast Members
                </h3>
                <div class="bg-gray-50 rounded border border-gray-200 p-4 flex-1">
                    <p class="text-sm text-gray-800 whitespace-pre-wrap leading-relaxed">
                        {{ $film->casts ?: 'No cast information available.' }}
                    </p>
                </div>
            </div>
            
            <!-- Production Team (polished 1-column) -->
            <div class="bg-white rounded-lg shadow-md border border-gray-200 p-4">
                <h3 class="text-sm font-bold text-gray-800 mb-4 pb-2 border-b border-gray-200 flex items-center gap-2 uppercase tracking-wide">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    Production Team
                </h3>

                <div class="space-y-3 text-sm">
                    <div class="flex items-baseline gap-3 pb-2 border-b border-gray-100">
                        <span class="text-gray-600 font-semibold min-w-[90px]">Director:</span>
                        <span class="text-gray-900 font-medium">
                            {{ $film->director ?? 'Not specified' }}
                        </span>
                    </div>

                    <div class="flex items-baseline gap-3 pb-2 border-b border-gray-100">
                        <span class="text-gray-600 font-semibold min-w-[90px]">Producer:</span>
                        <span class="text-gray-900 font-medium">
                            {{ $film->producer ?? 'Not specified' }}
                        </span>
                    </div>

                    <div class="flex items-baseline gap-3">
                        <span class="text-gray-600 font-semibold min-w-[140px]">Production Company:</span>
                        <span class="text-gray-900 font-medium">
                            {{ $film->production_company ?? 'Not specified' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Metadata -->
        <div class="bg-white rounded-lg shadow-md border border-gray-200 p-4">
            <h3 class="text-sm font-bold text-gray-800 mb-4 pb-2 border-b border-gray-200 flex items-center gap-2 uppercase tracking-wide">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Metadata
            </h3>
            <div class="grid grid-cols-3 gap-x-6 gap-y-3 text-sm">
                <div class="flex items-center gap-3 py-1.5 border-b border-gray-100">
                    <span class="text-gray-600 font-semibold min-w-[80px]">Created:</span>
                    <span class="text-gray-900 font-medium">
                        {{ $film->created_at ? $film->created_at->format('M j, Y \a\t g:i A') : 'Not available' }}
                    </span>
                </div>
                <div class="flex items-center gap-3 py-1.5 border-b border-gray-100">
                    <span class="text-gray-600 font-semibold min-w-[100px]">Last Updated:</span>
                    <span class="text-gray-900 font-medium">
                        {{ $film->updated_at ? $film->updated_at->format('M j, Y \a\t g:i A') : 'Not available' }}
                    </span>
                </div>
                <div class="flex items-center gap-3 py-1.5 border-b border-gray-100">
                    <span class="text-gray-600 font-semibold min-w-[50px]">Slug:</span>
                    <span class="text-gray-900 font-mono text-xs bg-gray-100 px-3 py-1 rounded border border-gray-300">
                        {{ $film->slug }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="flex justify-end space-x-3 pt-6 mt-8 border-t border-gray-200">
        <button type="button"
                wire:click="$dispatch('close-modal')"
                class="px-5 py-2.5 text-sm font-bold text-gray-700 bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-gray-100 focus:ring-2 focus:ring-gray-500 focus:border-gray-600 transition-all duration-200 uppercase tracking-wide">
            Close
        </button>
        <button type="button"
                wire:click="$dispatch('open-modal', { component: 'admin.classifications.films.edit-film', arguments: { film: {{ $film->id }} } })"
                class="px-5 py-2.5 text-sm font-bold text-white bg-blue-600 border border-blue-700 rounded-lg shadow-sm hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:border-blue-800 transition-all duration-200 flex items-center uppercase tracking-wide">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
            </svg>
            Edit Film
        </button>
    </div>
</div>
<script>
    window.addEventListener('modal-close', () => {
        Livewire.dispatch('closeModal');
    });

    window.addEventListener('modal-open', event => {
        Livewire.dispatch('openModal', event.detail);
    });
</script>

