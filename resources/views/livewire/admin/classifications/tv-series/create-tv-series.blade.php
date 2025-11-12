<div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50">

    <!-- Page Header -->
    <header class="px-4 sm:px-6 lg:px-8 py-6">
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-2xl shadow-lg overflow-hidden">
            <div class="px-6 py-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <h1 class="text-2xl font-bold text-white">Create TV Series</h1>
                        <p class="text-blue-100 opacity-90 text-sm">Register a new TV series so officers can classify and rate.</p>
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
                            Save TV Series
                        </button>
                    </div>
                </div>

                <!-- Breadcrumb -->
                <nav class="mt-4 text-xs text-blue-100">
                    <ol class="flex items-center gap-2">
                        <li><a href="{{ url('/tv-series') }}" class="hover:underline">TV Series</a></li>
                        <li>/</li>
                        <li class="text-white font-medium">Create</li>
                    </ol>
                </nav>
            </div>
        </div>
    </header>

    <!-- Notifications -->
    @if (session('success'))
        <div class="mx-4 sm:mx-6 lg:mx-8 -mt-2">
            <div class="rounded-lg bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 shadow">
                {{ session('success') }}
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <main class="px-4 sm:px-6 lg:px-8 pb-16">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

            <!-- Left: Form sections -->
            <div class="lg:col-span-8 space-y-6">

                <!-- Basic Details -->
                <section class="bg-white rounded-xl border shadow-sm overflow-hidden">
                    <div class="px-5 py-4 border-b">
                        <h2 class="text-sm font-semibold text-slate-800">Basic Details</h2>
                        <p class="text-xs text-slate-500">Core identifiers used across the system.</p>
                    </div>

                    <div class="p-5 grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="md:col-span-2">
                            <label class="block text-xs font-medium text-slate-600 mb-1">Series Title <span class="text-rose-600">*</span></label>
                            <input type="text" wire:model.live="tv_series_title"
                                   class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500"
                                   placeholder="e.g. Guardians of the Pacific">
                            @error('tv_series_title') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="space-y-2">
                            <label class="block text-xs font-medium text-slate-600">Auto-slug</label>
                            <label class="inline-flex items-center text-xs">
                                <input type="checkbox" wire:model.live="autoSlug" class="mr-2">
                                Generate from title
                            </label>
                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1">Slug <span class="text-rose-600">*</span></label>
                                <input type="text" wire:model.live="slug" @disabled($this->autoSlug)
                                       class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 disabled:bg-slate-50 disabled:text-slate-500"
                                       placeholder="guardians-of-the-pacific">
                                @error('slug') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                                <p class="text-[11px] text-slate-500 mt-1">Used in URLs and lookups. Must be unique.</p>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Season & Episodes -->
                <section class="bg-white rounded-xl border shadow-sm overflow-hidden">
                    <div class="px-5 py-4 border-b">
                        <h2 class="text-sm font-semibold text-slate-800">Season & Episodes</h2>
                        <p class="text-xs text-slate-500">Describe the current season or the series aggregate.</p>
                    </div>

                    <div class="p-5 grid grid-cols-1 md:grid-cols-4 gap-4">

                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1">Season No.</label>
                            <input type="number" min="1" wire:model.live="season_number"
                                   class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500"
                                   placeholder="1">
                            @error('season_number') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-xs font-medium text-slate-600 mb-1">Season Title</label>
                            <input type="text" wire:model.live="season_title"
                                   class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500"
                                   placeholder="e.g. Rising Tides">
                            @error('season_title') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                        </div>
                        
                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1">Episodes No.</label>
                            <input type="text" wire:model.live="number_of_episodes"
                                   class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500"
                                   placeholder="1 - 10">
                            @error('number_of_episodes') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1">Avg. Duration (mins)</label>
                            <input type="number" min="1" wire:model.live="duration"
                                   class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500"
                                   placeholder="42">
                            @error('duration') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </section>

                <!-- Creative & Meta -->
                <section class="bg-white rounded-xl border shadow-sm overflow-hidden">
                    <div class="px-5 py-4 border-b">
                        <h2 class="text-sm font-semibold text-slate-800">Creative & Metadata</h2>
                        <p class="text-xs text-slate-500">People and descriptors that help officers decide quickly.</p>
                    </div>

                    <div class="p-5 grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1">Director</label>
                            <input type="text" wire:model.live="director"
                                   class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500"
                                   placeholder="e.g. A. Kiru">
                            @error('director') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1">Producer</label>
                            <input type="text" wire:model.live="producer"
                                   class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500"
                                   placeholder="e.g. M. Sungi">
                            @error('producer') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1">Production Company</label>
                            <input type="text" wire:model.live="production_company"
                                   class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500"
                                   placeholder="e.g. Pacific Films Ltd">
                            @error('production_company') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1">Language</label>
                            <input type="text" wire:model.live="language"
                                   class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500"
                                   placeholder="e.g. English">
                            @error('language') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1">Genre</label>
                            <input type="text" wire:model.live="genre"
                                   class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500"
                                   placeholder="e.g. Drama, Thriller">
                            @error('genre') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1">Release Year</label>
                            <input type="number" min="1900" max="{{ now()->year + 1 }}" wire:model.live="release_year"
                                   class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500"
                                   placeholder="{{ now()->year }}">
                            @error('release_year') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="md:col-span-3">
                            <label class="block text-xs font-medium text-slate-600 mb-1">Cast</label>
                            <textarea rows="2" wire:model.live="casts"
                                      class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500"
                                      placeholder="Separate names with commas"></textarea>
                            @error('casts') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="md:col-span-3">
                            <label class="block text-xs font-medium text-slate-600 mb-1">Theme / Synopsis</label>
                            <textarea rows="4" wire:model.live="theme"
                                      class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500"
                                      placeholder="Brief narrative summary and notable themes that influence classification."></textarea>
                            @error('theme') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                            <p class="text-[11px] text-slate-500 mt-1">Tip: include any content notes (violence, horror, language, substances, etc.).</p>
                        </div>
                    </div>
                </section>

            </div>

            <!-- Right: Preview & Actions -->
            <aside class="lg:col-span-4 space-y-6">

                <!-- Live Preview Card -->
                <div class="bg-white rounded-xl border shadow-sm overflow-hidden">
                    <div class="px-5 py-4 border-b">
                        <h3 class="text-sm font-semibold text-slate-800">Preview Card</h3>
                        <p class="text-xs text-slate-500">How this series might appear in lists.</p>
                    </div>
                    <div class="p-5">
                        <div class="rounded-lg border bg-gradient-to-b from-slate-50 to-white p-4">
                            <div class="flex items-start justify-between">
                                <div class="min-w-0">
                                    <p class="text-sm font-semibold text-slate-900 truncate">
                                        {{ $tv_series_title ?: 'Series title' }}
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
                                @if($genre)<span class="text-[10px] px-2 py-0.5 rounded-full bg-indigo-50 text-indigo-700 border border-indigo-200">{{ $genre }}</span>@endif
                                @if($release_year)<span class="text-[10px] px-2 py-0.5 rounded-full bg-slate-50 text-slate-700 border border-slate-200">Year: {{ $release_year }}</span>@endif
                                @if($number_of_episodes)<span class="text-[10px] px-2 py-0.5 rounded-full bg-slate-50 text-slate-700 border border-slate-200">Episodes: {{ $number_of_episodes }}</span>@endif
                                @if($duration)<span class="text-[10px] px-2 py-0.5 rounded-full bg-slate-50 text-slate-700 border border-slate-200">Duration: {{ $duration }}m</span>@endif
                            </div>
                            <p class="mt-3 text-xs text-slate-600 line-clamp-3">
                                {{ $theme ?: 'A short synopsis will help officers assess content quickly.' }}
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
                        <p>• Ensure <strong>slug</strong> is unique and readable; keep Auto-slug on unless you need a custom one.</p>
                        <p>• Fill <strong>duration</strong>, <strong>episodes</strong> and <strong>release year</strong> accurately for better filtering.</p>
                    </div>
                </div>

                <!-- Sticky Save (mobile convenience) -->
                <div class="bg-white rounded-xl border shadow-sm p-5">
                    <div class="flex items-center gap-2">
                        <a href="{{ url('/tv-series') }}"
                           class="px-3 py-2 text-sm rounded-lg border border-slate-200 hover:bg-slate-50">Cancel</a>
                        <button
                            wire:click="save"
                            wire:loading.attr="disabled"
                            class="ml-auto inline-flex items-center px-4 py-2 text-sm rounded-lg bg-blue-600 text-white hover:bg-blue-700 shadow disabled:opacity-50">
                            <svg wire:loading wire:target="save" class="animate-spin -ml-1 mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                            </svg>
                            Save TV Series
                        </button>
                    </div>
                </div>

            </aside>
        </div>
    </main>
</div>
