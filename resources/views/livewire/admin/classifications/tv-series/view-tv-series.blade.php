<div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50 py-6 px-4 sm:px-6 lg:px-8">
    <!-- Header Section -->
    <div class="mb-6">
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-xl shadow-lg overflow-hidden">
            <div class="px-6 py-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <h1 class="text-xl md:text-2xl font-bold text-white mb-1">TV Series Season Details</h1>
                        <p class="text-blue-100 opacity-90 text-sm">{{ $season->display_title ?? $season->season_title }}</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <a href="{{ route('admin.classifications.tv-series') }}"
                           class="px-3 py-2 text-sm rounded-lg bg-white/10 text-white hover:bg-white/20 border border-white/20 transition">
                            Back to List
                        </a>
                        <a href="{{ route('admin.classifications.tv-series.edit', $season->id) }}"
                           class="px-3 py-2 text-sm rounded-lg bg-white text-blue-700 hover:bg-blue-50 shadow transition">
                            Edit Season
                        </a>
                    </div>
                </div>

                <!-- Breadcrumb -->
                <nav class="mt-4 text-xs text-blue-100">
                    <ol class="flex items-center gap-2">
                        <li><a href="{{ route('admin.classifications.tv-series') }}" class="hover:underline">TV Series</a></li>
                        <li>/</li>
                        <li class="text-white font-medium">{{ $season->season_title }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left Column: Season Info -->
        <div class="lg:col-span-2 space-y-6">
            <!-- TV Series Information -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z"/>
                    </svg>
                    TV Series Information
                </h2>
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <p class="text-sm font-medium text-blue-900">{{ $season->tvSeries->tv_series_title ?? 'N/A' }}</p>
                    <p class="text-xs text-blue-700 mt-1">Parent TV Series</p>
                </div>
            </div>

            <!-- Basic Information -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Basic Information
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <dt class="text-xs font-medium text-gray-500 uppercase tracking-wider">Season Title</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $season->season_title }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium text-gray-500 uppercase tracking-wider">Season Number</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $season->season_number }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium text-gray-500 uppercase tracking-wider">Number of Episodes</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $season->number_of_episodes }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium text-gray-500 uppercase tracking-wider">Duration</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $season->duration ? $season->duration . ' minutes (per episode)' : 'N/A' }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium text-gray-500 uppercase tracking-wider">Release Year</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $season->release_year }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium text-gray-500 uppercase tracking-wider">Season Slug</dt>
                        <dd class="mt-1 text-sm text-gray-900 font-mono bg-gray-50 px-2 py-1 rounded">{{ $season->season_slug }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium text-gray-500 uppercase tracking-wider">Genre</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $season->genre ?: 'N/A' }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium text-gray-500 uppercase tracking-wider">Language</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $season->language ?: 'N/A' }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium text-gray-500 uppercase tracking-wider">Has Subtitles</dt>
                        <dd class="mt-1">
                            @if($season->has_subtitle)
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">
                                    Yes
                                </span>
                            @else
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-800">
                                    No
                                </span>
                            @endif
                        </dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium text-gray-500 uppercase tracking-wider">Classification Status</dt>
                        <dd class="mt-1">
                            @if($season->has_classified)
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">
                                    Classified
                                </span>
                            @else
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-amber-100 text-amber-800">
                                    Unclassified
                                </span>
                            @endif
                        </dd>
                    </div>
                </div>
            </div>

            <!-- Creative & Credits -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    Creative & Credits
                </h2>
                <div class="space-y-4">
                    <div>
                        <dt class="text-xs font-medium text-gray-500 uppercase tracking-wider">Director</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $season->director ?: 'N/A' }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium text-gray-500 uppercase tracking-wider">Producer</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $season->producer ?: 'N/A' }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium text-gray-500 uppercase tracking-wider">Production Company</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $season->production_company ?: 'N/A' }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium text-gray-500 uppercase tracking-wider">Cast</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $season->casts ?: 'N/A' }}</dd>
                    </div>
                </div>
            </div>

            <!-- Theme / Synopsis -->
            @if($season->theme)
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Theme / Synopsis
                </h2>
                <p class="text-sm text-gray-700 leading-relaxed">{{ $season->theme }}</p>
            </div>
            @endif

            <!-- Classification Information -->
            @if($season->classification)
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                    Classification Details
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <dt class="text-xs font-medium text-gray-500 uppercase tracking-wider">Rating</dt>
                        <dd class="mt-1">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                {{ $season->classification->rating->rating ?? 'N/A' }}
                            </span>
                        </dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium text-gray-500 uppercase tracking-wider">Classification Date</dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            {{ $season->classification->created_at->format('M d, Y') }}
                        </dd>
                    </div>
                </div>
            </div>
            @endif

            <!-- Episodes List -->
            @if($season->episodes->count() > 0)
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                    </svg>
                    Episodes ({{ $season->episodes->count() }})
                </h2>
                <div class="space-y-2">
                    @foreach($season->episodes as $episode)
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                        <div>
                            <p class="text-sm font-medium text-gray-900">Episode {{ $episode->episode_number }}: {{ $episode->episode_title }}</p>
                            @if($episode->duration)
                            <p class="text-xs text-gray-500">{{ $episode->duration }} minutes</p>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        <!-- Right Column: Sidebar -->
        <div class="space-y-6">
            <!-- Poster Image -->
            @if($season->getRawOriginal('poster_path'))
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Season Poster</h2>
                <img src="{{ $season->poster_path }}" alt="{{ $season->season_title }}" class="w-full rounded-lg shadow-md mb-4">
                <button type="button"
                        wire:click="downloadPoster"
                        class="w-full inline-flex items-center justify-center px-4 py-2 text-sm rounded-lg bg-blue-600 text-white hover:bg-blue-700">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5 5m0 0l5-5m-5 5V4"/>
                    </svg>
                    Download Poster
                </button>
            </div>
            @endif

            <!-- Quick Stats -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Quick Stats</h2>
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Episodes</span>
                        <span class="text-sm font-semibold text-gray-900">{{ $season->episodes->count() }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Total Runtime</span>
                        <span class="text-sm font-semibold text-gray-900">
                            {{ $season->duration && $season->number_of_episodes 
                                ? ($season->duration * (int)$season->number_of_episodes) . ' min' 
                                : 'N/A' }}
                        </span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Release Year</span>
                        <span class="text-sm font-semibold text-gray-900">{{ $season->release_year }}</span>
                    </div>
                </div>
            </div>

            <!-- Metadata -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Metadata</h2>
                <div class="space-y-3 text-xs">
                    <div>
                        <dt class="text-gray-500">Created</dt>
                        <dd class="text-gray-900 font-medium">{{ $season->created_at->format('M d, Y g:i A') }}</dd>
                    </div>
                    <div>
                        <dt class="text-gray-500">Last Updated</dt>
                        <dd class="text-gray-900 font-medium">{{ $season->updated_at->format('M d, Y g:i A') }}</dd>
                    </div>
                    <div>
                        <dt class="text-gray-500">Season ID</dt>
                        <dd class="text-gray-900 font-mono">{{ $season->id }}</dd>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>