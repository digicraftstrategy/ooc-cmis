<div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50">

    <!-- Page Header -->
    <header class="px-4 sm:px-6 lg:px-8 py-6">
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-2xl shadow-lg overflow-hidden">
            <div class="px-6 py-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <h1 class="text-2xl font-bold text-white">Create TV Series Season</h1>
                        <p class="text-blue-100 opacity-90 text-sm">
                            Register a new season for a TV series so officers can classify and rate.
                        </p>
                    </div>

                    <div class="flex items-center gap-2">
                        <a href="{{ url()->previous() }}"
                           class="px-3 py-2 text-sm rounded-lg bg-white/10 text-white hover:bg-white/20 border border-white/20 transition">
                            Back
                        </a>
                        <button
                            wire:click="save"
                            wire:loading.attr="disabled"
                            class="inline-flex items-center px-4 py-2 text-sm rounded-lg bg-white text-blue-700 hover:bg-blue-50 shadow disabled:opacity-50">
                            <svg wire:loading wire:target="save" class="animate-spin -ml-1 mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                            </svg>
                            Save Season
                        </button>
                    </div>
                </div>

                <!-- Breadcrumb -->
                <nav class="mt-4 text-xs text-blue-100">
                    <ol class="flex items-center gap-2">
                        <li><a href="{{ route('admin.classifications.tv-series') }}" class="hover:underline">TV Series</a></li>
                        <li>/</li>
                        <li class="text-white font-medium">Create Season</li>
                    </ol>
                </nav>
            </div>
        </div>
    </header>

    <!-- Notifications -->
    @if (session()->has('success'))
        <div class="mx-4 sm:mx-6 lg:px-8 -mt-2">
            <div class="rounded-lg bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 shadow">
                {{ session('success') }}
            </div>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="mx-4 sm:mx-6 lg:px-8 -mt-2">
            <div class="rounded-lg bg-red-50 border border-red-200 text-red-700 px-4 py-3 shadow">
                {{ session('error') }}
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <main class="px-4 sm:px-6 lg:px-8 pb-16">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

            <!-- Left: Form sections -->
            <div class="lg:col-span-8 space-y-6">

                <!-- Series Selection (New / Existing) -->
                <section class="bg-white rounded-xl border shadow-sm overflow-hidden">
                    <div class="px-5 py-4 border-b">
                        <h2 class="text-sm font-semibold text-slate-800">TV Series Selection</h2>
                        <p class="text-xs text-slate-500">
                            Create a new TV series record or attach this season to an existing one.
                        </p>
                    </div>

                    <div class="p-5 space-y-4">
                        <!-- Radio Options -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <label class="flex items-start gap-2 rounded-lg border px-3 py-3 cursor-pointer
                                           @if($createNewSeries) border-blue-500 bg-blue-50 @else border-slate-200 bg-slate-50 @endif">
                                <input type="radio" id="new_series" value="1" wire:model.live="createNewSeries"
                                       class="mt-1 text-blue-600 border-slate-300 focus:ring-blue-500">
                                <div>
                                    <span class="block text-sm font-semibold text-slate-800">Create New TV Series</span>
                                    <span class="block text-xs text-slate-500">
                                        Use this when the series has not been registered in CMIS yet.
                                    </span>
                                </div>
                            </label>

                            <label class="flex items-start gap-2 rounded-lg border px-3 py-3 cursor-pointer
                                           @if(!$createNewSeries) border-blue-500 bg-blue-50 @else border-slate-200 bg-slate-50 @endif">
                                <input type="radio" id="existing_series" value="0" wire:model.live="createNewSeries"
                                       class="mt-1 text-blue-600 border-slate-300 focus:ring-blue-500">
                                <div>
                                    <span class="block text-sm font-semibold text-slate-800">Use Existing TV Series</span>
                                    <span class="block text-xs text-slate-500">
                                        Select from already registered TV series in the system.
                                    </span>
                                </div>
                            </label>
                        </div>

                        <!-- New Series Fields -->
                        @if($createNewSeries)
                            <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="tv_series_title" class="block text-xs font-medium text-slate-600 mb-1">
                                        TV Series Title <span class="text-rose-600">*</span>
                                    </label>
                                    <input type="text" id="tv_series_title" wire:model.blur="tv_series_title"
                                           class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500"
                                           placeholder="e.g. Guardians of the Pacific">
                                    @error('tv_series_title') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                                </div>

                                <div>
                                    <div class="flex items-center justify-between mb-1">
                                        <label for="slug" class="block text-xs font-medium text-slate-600">
                                            Series Slug <span class="text-rose-600">*</span>
                                        </label>
                                        <div class="flex items-center text-[11px] text-slate-600">
                                            <input type="checkbox" id="auto_slug" wire:model.live="autoSlug"
                                                   class="mr-1 rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                                            <label for="auto_slug">Auto-generate</label>
                                        </div>
                                    </div>
                                    <input type="text" id="slug" wire:model.blur="slug"
                                           @disabled($autoSlug)
                                           class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 disabled:bg-slate-50 disabled:text-slate-500"
                                           placeholder="guardians-of-the-pacific">
                                    @error('slug') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                                    <p class="text-[11px] text-slate-500 mt-1">Used in URLs and lookups. Must be unique.</p>
                                </div>
                            </div>
                        @else
                            <!-- Existing Series Selection -->
                            <div class="mt-4">
                                <label for="selectedSeriesId" class="block text-xs font-medium text-slate-600 mb-1">
                                    Select TV Series <span class="text-rose-600">*</span>
                                </label>
                                <select id="selectedSeriesId" wire:model.live="selectedSeriesId"
                                        class="block w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                                    <option value="">-- Select TV Series --</option>
                                    @foreach($existingSeries as $series)
                                        <option value="{{ $series->id }}">{{ $series->tv_series_title }}</option>
                                    @endforeach
                                </select>
                                @error('selectedSeriesId') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                            </div>
                        @endif
                    </div>
                </section>

                <!-- Season Information -->
                <section class="bg-white rounded-xl border shadow-sm overflow-hidden">
                    <div class="px-5 py-4 border-b">
                        <h2 class="text-sm font-semibold text-slate-800">Season Information</h2>
                        <p class="text-xs text-slate-500">Key details for this particular season.</p>
                    </div>

                    <div class="p-5 grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Season Title -->
                        <div>
                            <label for="season_title" class="block text-xs font-medium text-slate-600 mb-1">
                                Season Title <span class="text-rose-600">*</span>
                            </label>
                            <input type="text" id="season_title" wire:model.blur="season_title"
                                   class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500"
                                   placeholder="e.g. Rising Tides">
                            @error('season_title') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Season Slug -->
                        <div>
                            <div class="flex items-center justify-between mb-1">
                                <label for="season_slug" class="block text-xs font-medium text-slate-600">
                                    Season Slug <span class="text-rose-600">*</span>
                                </label>
                                <div class="flex items-center text-[11px] text-slate-600">
                                    <input type="checkbox" id="auto_season_slug" wire:model.live="autoSeasonSlug"
                                           class="mr-1 rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                                    <label for="auto_season_slug">Auto-generate</label>
                                </div>
                            </div>
                            <input type="text" id="season_slug" wire:model.blur="season_slug"
                                   @disabled($autoSeasonSlug)
                                   class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 disabled:bg-slate-50 disabled:text-slate-500">
                            @error('season_slug') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Season Number -->
                        <div>
                            <label for="season_number" class="block text-xs font-medium text-slate-600 mb-1">
                                Season Number <span class="text-rose-600">*</span>
                            </label>
                            <input type="number" id="season_number" wire:model.blur="season_number" min="1"
                                   class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500"
                                   placeholder="1">
                            @error('season_number') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Number of Episodes -->
                        <div>
                            <label for="number_of_episodes" class="block text-xs font-medium text-slate-600 mb-1">
                                Number of Episodes <span class="text-rose-600">*</span>
                            </label>
                            <input type="text" id="number_of_episodes" wire:model.blur="number_of_episodes"
                                   class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500"
                                   placeholder="e.g. 1 - 24">
                            @error('number_of_episodes') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Duration -->
                        <div>
                            <label for="duration" class="block text-xs font-medium text-slate-600 mb-1">
                                Avg. Duration (minutes)
                            </label>
                            <input type="number" id="duration" wire:model.blur="duration" min="1"
                                   class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500"
                                   placeholder="e.g. 42">
                            @error('duration') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Release Year -->
                        <div>
                            <label for="release_year" class="block text-xs font-medium text-slate-600 mb-1">
                                Release Year <span class="text-rose-600">*</span>
                            </label>
                            <input type="number" id="release_year" wire:model.blur="release_year"
                                   min="1900" max="{{ date('Y') + 1 }}"
                                   class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500"
                                   placeholder="{{ date('Y') }}">
                            @error('release_year') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Language -->
                        <div>
                            <label for="language" class="block text-xs font-medium text-slate-600 mb-1">
                                Language
                            </label>
                            <input type="text" id="language" wire:model.blur="language"
                                   class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500"
                                   placeholder="e.g. English">
                            @error('language') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Has Subtitle -->
                        <div class="flex items-center mt-2">
                            <input type="checkbox" id="has_subtitle" wire:model="has_subtitle"
                                   class="h-4 w-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                            <label for="has_subtitle" class="ml-2 text-xs font-medium text-slate-700">
                                Season has subtitles
                            </label>
                        </div>
                    </div>
                </section>

                <!-- Creative & Additional Metadata -->
                <section class="bg-white rounded-xl border shadow-sm overflow-hidden">
                    <div class="px-5 py-4 border-b">
                        <h2 class="text-sm font-semibold text-slate-800">Creative & Metadata</h2>
                        <p class="text-xs text-slate-500">
                            People, genres and narrative details that help officers classify quickly.
                        </p>
                    </div>

                    <div class="p-5 grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Casts -->
                        <div>
                            <label for="casts" class="block text-xs font-medium text-slate-600 mb-1">
                                Casts
                            </label>
                            <input type="text" id="casts" wire:model.blur="casts"
                                   class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500"
                                   placeholder="Actor 1, Actor 2, Actor 3">
                            @error('casts') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Genre -->
                        <div>
                            <label for="genre" class="block text-xs font-medium text-slate-600 mb-1">
                                Genre
                            </label>
                            <input type="text" id="genre" wire:model.blur="genre"
                                   class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500"
                                   placeholder="Action, Drama, Comedy">
                            @error('genre') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Director -->
                        <div>
                            <label for="director" class="block text-xs font-medium text-slate-600 mb-1">
                                Director
                            </label>
                            <input type="text" id="director" wire:model.blur="director"
                                   class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                            @error('director') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Producer -->
                        <div>
                            <label for="producer" class="block text-xs font-medium text-slate-600 mb-1">
                                Producer
                            </label>
                            <input type="text" id="producer" wire:model.blur="producer"
                                   class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                            @error('producer') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Production Company -->
                        <div class="md:col-span-2">
                            <label for="production_company" class="block text-xs font-medium text-slate-600 mb-1">
                                Production Company
                            </label>
                            <input type="text" id="production_company" wire:model.blur="production_company"
                                   class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                            @error('production_company') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Theme -->
                        <div class="md:col-span-2">
                            <label for="theme" class="block text-xs font-medium text-slate-600 mb-1">
                                Theme / Synopsis
                            </label>
                            <textarea id="theme" wire:model.blur="theme" rows="3"
                                      class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500"
                                      placeholder="Summarise the main themes and narrative content for this season."></textarea>
                            @error('theme') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                            <p class="text-[11px] text-slate-500 mt-1">
                                Tip: include any content notes (violence, horror, language, substances, etc.).
                            </p>
                        </div>
                    </div>
                </section>

                <!-- Poster Upload -->
                <section class="bg-white rounded-xl border shadow-sm overflow-hidden">
                    <div class="px-5 py-4 border-b">
                        <h2 class="text-sm font-semibold text-slate-800">Season Poster</h2>
                        <p class="text-xs text-slate-500">
                            Optional visual poster for quick recognition in lists.
                        </p>
                    </div>

                    <div class="p-5">
                        <label for="poster_path" class="block text-xs font-medium text-slate-600 mb-1">
                            Upload Poster
                        </label>
                        <input type="file" id="poster_path" wire:model="poster_path" accept="image/*"
                               class="block w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                        @error('poster_path') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror

                        @if ($poster_path)
                            <div class="mt-3">
                                <p class="text-xs text-slate-500 mb-1">Preview:</p>
                                <img src="{{ $poster_path->temporaryUrl() }}" class="h-40 rounded-lg shadow border object-cover">
                            </div>
                        @endif

                        <p class="text-[11px] text-slate-500 mt-2">
                            Supported formats: JPEG, PNG, JPG, GIF (Max: 2MB)
                        </p>
                    </div>
                </section>

                <!-- Form Actions (bottom) -->
                <div class="bg-white rounded-xl border shadow-sm p-5">
                    <div class="flex justify-end gap-2">
                        <a href="{{ route('admin.classifications.tv-series') }}"
                           class="px-3 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-200 rounded-lg shadow-sm hover:bg-slate-50">
                            Cancel
                        </a>
                        <button type="button"
                                wire:click="save"
                                wire:loading.attr="disabled"
                                class="px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-lg shadow-sm hover:bg-blue-700 flex items-center">
                            <svg wire:loading wire:target="save" class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Create TV Series Season
                        </button>
                    </div>
                </div>

            </div>

            <!-- Right: Preview & Tips -->
            <aside class="lg:col-span-4 space-y-6">

                <!-- Preview Card -->
                <div class="bg-white rounded-xl border shadow-sm overflow-hidden">
                    <div class="px-5 py-4 border-b">
                        <h3 class="text-sm font-semibold text-slate-800">Season Preview</h3>
                        <p class="text-xs text-slate-500">How this season might appear in internal listings.</p>
                    </div>
                    <div class="p-5">
                        <div class="rounded-lg border bg-gradient-to-b from-slate-50 to-white p-4">
                            <div class="flex items-start justify-between">
                                <div class="min-w-0">
                                    <p class="text-sm font-semibold text-slate-900 truncate">
                                        {{ $tv_series_title ?: 'TV Series Title' }}
                                    </p>
                                    <p class="text-xs text-slate-500 truncate">
                                        Season {{ $season_number ?: '—' }} — {{ $season_title ?: 'No season title' }}
                                    </p>
                                </div>
                                <span class="text-[10px] px-2 py-0.5 rounded-full bg-blue-50 text-blue-700 border border-blue-200">
                                    {{ $language ?: 'Language' }}
                                </span>
                            </div>

                            <div class="mt-3 flex flex-wrap gap-2">
                                @if($genre)
                                    <span class="text-[10px] px-2 py-0.5 rounded-full bg-indigo-50 text-indigo-700 border border-indigo-200">
                                        {{ $genre }}
                                    </span>
                                @endif
                                @if($release_year)
                                    <span class="text-[10px] px-2 py-0.5 rounded-full bg-slate-50 text-slate-700 border border-slate-200">
                                        Year: {{ $release_year }}
                                    </span>
                                @endif
                                @if($number_of_episodes)
                                    <span class="text-[10px] px-2 py-0.5 rounded-full bg-slate-50 text-slate-700 border border-slate-200">
                                        Episodes: {{ $number_of_episodes }}
                                    </span>
                                @endif
                                @if($duration)
                                    <span class="text-[10px] px-2 py-0.5 rounded-full bg-slate-50 text-slate-700 border border-slate-200">
                                        Duration: {{ $duration }}m
                                    </span>
                                @endif
                            </div>

                            <p class="mt-3 text-xs text-slate-600 line-clamp-4">
                                {{ $theme ?: 'A short synopsis will help officers assess content quickly and apply the correct classification.' }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Tips -->
                <div class="bg-white rounded-xl border shadow-sm overflow-hidden">
                    <div class="px-5 py-4 border-b">
                        <h3 class="text-sm font-semibold text-slate-800">Submission Tips</h3>
                    </div>
                    <div class="p-5 text-sm text-slate-600 space-y-2">
                        <p>• Provide clear <strong>synopsis</strong> and note sensitive content (violence, horror, language, substances).</p>
                        <p>• Ensure <strong>Season Number</strong>, <strong>Episodes</strong> and <strong>Release Year</strong> are accurate.</p>
                        <p>• Use readable <strong>slugs</strong> so officers can find seasons quickly in the system.</p>
                    </div>
                </div>

                <!-- Quick Save block -->
                <div class="bg-white rounded-xl border shadow-sm p-5">
                    <div class="flex items-center gap-2">
                        <a href="{{ route('admin.classifications.tv-series') }}"
                           class="px-3 py-2 text-sm rounded-lg border border-slate-200 hover:bg-slate-50">
                            Cancel
                        </a>
                        <button
                            wire:click="save"
                            wire:loading.attr="disabled"
                            class="ml-auto inline-flex items-center px-4 py-2 text-sm rounded-lg bg-blue-600 text-white hover:bg-blue-700 shadow disabled:opacity-50">
                            <svg wire:loading wire:target="save" class="animate-spin -ml-1 mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                            </svg>
                            Save Season
                        </button>
                    </div>
                </div>

            </aside>
        </div>
    </main>
</div>
