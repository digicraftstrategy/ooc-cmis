<div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50">
    <!-- Flash Messages -->
    @if (session()->has('success'))
        <div class="mx-4 sm:mx-6 lg:mx-8 mt-6">
            <div class="rounded-lg bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 shadow">
                {{ session('success') }}
            </div>
        </div>
    @endif
    @if (session()->has('error'))
        <div class="mx-4 sm:mx-6 lg:mx-8 mt-6">
            <div class="rounded-lg bg-rose-50 border border-rose-200 text-rose-800 px-4 py-3 shadow">
                {{ session('error') }}
            </div>
        </div>
    @endif

    <!-- Header -->
    <header class="px-4 sm:px-6 lg:px-8 py-6">
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-2xl shadow-lg overflow-hidden">
            <div class="px-6 py-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <h1 class="text-2xl font-bold text-white">Edit TV Series Season</h1>
                        <p class="text-blue-100 opacity-90 text-sm">
                            Update details for <span class="font-semibold">{{ $season->season_title }}</span>.
                        </p>
                    </div>

                    <div class="flex items-center gap-2">
                        <a href="{{ route('admin.classifications.tv-series') }}"
                           class="px-3 py-2 text-sm rounded-lg bg-white/10 text-white hover:bg-white/20 border border-white/20 transition">
                            Back
                        </a>
                        <button
                            wire:click="update"
                            wire:loading.attr="disabled"
                            class="inline-flex items-center px-4 py-2 text-sm rounded-lg bg-white text-blue-700 hover:bg-blue-50 shadow disabled:opacity-50">
                            <svg wire:loading wire:target="update" class="animate-spin -ml-1 mr-2 h-4 w-4"
                                 xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10"
                                        stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                      d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                            </svg>
                            Update Season
                        </button>
                    </div>
                </div>

                <!-- Breadcrumb -->
                <nav class="mt-4 text-xs text-blue-100">
                    <ol class="flex items-center gap-2">
                        <li><a href="{{ route('admin.classifications.tv-series') }}" class="hover:underline">TV Series</a></li>
                        <li>/</li>
                        <li class="text-white font-medium">Edit Season</li>
                    </ol>
                </nav>
            </div>
        </div>
    </header>

    <!-- Form -->
    <main class="px-4 sm:px-6 lg:px-8 pb-12">
        <form wire:submit="update" class="space-y-6">

            <!-- Section: Series Information (Read-only) -->
            <div class="bg-white rounded-xl border shadow-sm">
                <div class="px-4 py-3 border-b">
                    <h3 class="text-sm font-semibold text-slate-800">TV Series Information</h3>
                    <p class="text-xs text-slate-500">Parent series details (read-only).</p>
                </div>
                <div class="p-4">
                    <div class="bg-blue-50 border border-blue-200 rounded-lg px-4 py-3">
                        <p class="text-sm font-medium text-blue-900">{{ $tv_series_title }}</p>
                        <p class="text-xs text-blue-700 mt-1">This season belongs to the above TV series</p>
                    </div>
                </div>
            </div>

            <!-- Section: Basic Details -->
            <div class="bg-white rounded-xl border shadow-sm">
                <div class="px-4 py-3 border-b">
                    <h3 class="text-sm font-semibold text-slate-800">Season Details</h3>
                    <p class="text-xs text-slate-500">Core identifiers for this season.</p>
                </div>
                <div class="p-4 grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Season Title -->
                    <div class="md:col-span-2">
                        <label class="block text-xs font-medium text-slate-600 mb-1">
                            Season Title <span class="text-rose-600">*</span>
                        </label>
                        <input type="text" wire:model.live="season_title"
                               class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 @error('season_title') border-rose-400 @enderror"
                               placeholder="e.g. Season 1: The Beginning">
                        @error('season_title')
                        <p class="text-xs text-rose-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Season Number -->
                    <div>
                        <label class="block text-xs font-medium text-slate-600 mb-1">
                            Season Number <span class="text-rose-600">*</span>
                        </label>
                        <input type="number" min="1" wire:model.live="season_number"
                               class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 @error('season_number') border-rose-400 @enderror"
                               placeholder="e.g. 1">
                        @error('season_number')
                        <p class="text-xs text-rose-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Season Slug -->
                    <div class="md:col-span-2">
                        <label class="block text-xs font-medium text-slate-600 mb-1">
                            Season Slug <span class="text-rose-600">*</span>
                        </label>
                        <div class="flex gap-2">
                            <input type="text" wire:model.live="season_slug"
                                   class="flex-1 text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 @error('season_slug') border-rose-400 @enderror"
                                   placeholder="auto-generated">
                            <label class="flex items-center gap-2 text-xs text-slate-600">
                                <input type="checkbox" wire:model.live="autoSeasonSlug" class="rounded">
                                Auto
                            </label>
                        </div>
                        @error('season_slug')
                        <p class="text-xs text-rose-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Number of Episodes -->
                    <div>
                        <label class="block text-xs font-medium text-slate-600 mb-1">
                            Episodes <span class="text-rose-600">*</span>
                        </label>
                        <input type="text" wire:model.live="number_of_episodes"
                               class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 @error('number_of_episodes') border-rose-400 @enderror"
                               placeholder="e.g. 10">
                        @error('number_of_episodes')
                        <p class="text-xs text-rose-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Duration -->
                    <div>
                        <label class="block text-xs font-medium text-slate-600 mb-1">
                            Duration (minutes) <span class="text-gray-400 font-normal">(per episode)</span>
                        </label>
                        <input type="number" min="1" wire:model.live="duration"
                               class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 @error('duration') border-rose-400 @enderror"
                               placeholder="e.g. 45">
                        @error('duration')
                        <p class="text-xs text-rose-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Release Year -->
                    <div>
                        <label class="block text-xs font-medium text-slate-600 mb-1">
                            Release Year <span class="text-rose-600">*</span>
                        </label>
                        <input type="number" min="1900" wire:model.live="release_year"
                               class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 @error('release_year') border-rose-400 @enderror"
                               placeholder="e.g. 2024">
                        @error('release_year')
                        <p class="text-xs text-rose-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Genre -->
                    <div>
                        <label class="block text-xs font-medium text-slate-600 mb-1">
                            Genre <span class="text-gray-400 font-normal">(optional)</span>
                        </label>
                        <input type="text" wire:model.live="genre"
                               class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 @error('genre') border-rose-400 @enderror"
                               placeholder="e.g. Drama, Thriller">
                        @error('genre')
                        <p class="text-xs text-rose-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Language -->
                    <div>
                        <label class="block text-xs font-medium text-slate-600 mb-1">
                            Language <span class="text-gray-400 font-normal">(optional)</span>
                        </label>
                        <input type="text" wire:model.live="language"
                               class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 @error('language') border-rose-400 @enderror"
                               placeholder="e.g. English, Tok Pisin">
                        @error('language')
                        <p class="text-xs text-rose-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Has Subtitle -->
                    <div>
                        <label class="block text-xs font-medium text-slate-600 mb-1">
                            Subtitles
                        </label>
                        <label class="flex items-center gap-2 mt-2">
                            <input type="checkbox" wire:model.live="has_subtitle" class="rounded">
                            <span class="text-sm text-slate-700">Has subtitles</span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Section: Creative & Credits -->
            <div class="bg-white rounded-xl border shadow-sm">
                <div class="px-4 py-3 border-b">
                    <h3 class="text-sm font-semibold text-slate-800">Creative & Credits</h3>
                    <p class="text-xs text-slate-500">Key creatives and descriptive information.</p>
                </div>
                <div class="p-4 grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Director -->
                    <div>
                        <label class="block text-xs font-medium text-slate-600 mb-1">
                            Director <span class="text-gray-400 font-normal">(optional)</span>
                        </label>
                        <input type="text" wire:model.live="director"
                               class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 @error('director') border-rose-400 @enderror"
                               placeholder="Director's name">
                        @error('director')
                        <p class="text-xs text-rose-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Producer -->
                    <div>
                        <label class="block text-xs font-medium text-slate-600 mb-1">
                            Producer <span class="text-gray-400 font-normal">(optional)</span>
                        </label>
                        <input type="text" wire:model.live="producer"
                               class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 @error('producer') border-rose-400 @enderror"
                               placeholder="Producer's name">
                        @error('producer')
                        <p class="text-xs text-rose-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Production Company -->
                    <div>
                        <label class="block text-xs font-medium text-slate-600 mb-1">
                            Production Company <span class="text-gray-400 font-normal">(optional)</span>
                        </label>
                        <input type="text" wire:model.live="production_company"
                               class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 @error('production_company') border-rose-400 @enderror"
                               placeholder="e.g. Pacific Studios">
                        @error('production_company')
                        <p class="text-xs text-rose-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Cast -->
                    <div class="md:col-span-3">
                        <label class="block text-xs font-medium text-slate-600 mb-1">
                            Cast <span class="text-gray-400 font-normal">(optional)</span>
                        </label>
                        <textarea rows="3" wire:model.live="casts"
                                  class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 @error('casts') border-rose-400 @enderror"
                                  placeholder="Enter cast members, separated by commas"></textarea>
                        @error('casts')
                        <p class="text-xs text-rose-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Theme -->
                    <div class="md:col-span-3">
                        <label class="block text-xs font-medium text-slate-600 mb-1">
                            Theme / Synopsis <span class="text-gray-400 font-normal">(optional)</span>
                        </label>
                        <textarea rows="4" wire:model.live="theme"
                                  class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 @error('theme') border-rose-400 @enderror"
                                  placeholder="Brief narrative summary and key themes for this season."></textarea>
                        @error('theme')
                        <p class="text-xs text-rose-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Section: Poster -->
            <div class="bg-white rounded-xl border shadow-sm">
                <div class="px-4 py-3 border-b">
                    <h3 class="text-sm font-semibold text-slate-800">Season Poster</h3>
                    <p class="text-xs text-slate-500">
                        Upload or replace the poster image for this season.
                    </p>
                </div>
                <div class="p-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Upload -->
                    <div>
                        <label class="block text-xs font-medium text-slate-600 mb-1">
                            Poster Image <span class="text-gray-400 font-normal">(JPG / PNG)</span>
                        </label>
                        <input type="file" wire:model="poster_path"
                               accept="image/*"
                               class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 @error('poster_path') border-rose-400 @enderror">
                        @error('poster_path')
                        <p class="text-xs text-rose-600 mt-1">{{ $message }}</p>
                        @enderror

                        <p class="mt-1 text-[11px] text-slate-500">
                            Max size: 2MB. Upload only if you need to replace the existing poster.
                        </p>

                        @if ($poster_path)
                            <p class="mt-2 text-xs text-slate-700">
                                New poster selected:
                                <span class="font-semibold">{{ $poster_path->getClientOriginalName() }}</span>
                            </p>
                        @endif
                    </div>

                    <!-- Existing poster info -->
                    <div class="md:text-sm text-xs">
                        <label class="block text-xs font-medium text-slate-600 mb-1">
                            Current Poster
                        </label>

                        @if ($season->getRawOriginal('poster_path'))
                            <div class="rounded-lg border bg-slate-50 px-3 py-2">
                                <img src="{{ $season->poster_path }}" alt="Current poster" class="w-32 h-auto rounded mb-2">
                                <button type="button"
                                        wire:click="downloadPoster"
                                        class="inline-flex items-center px-3 py-1.5 text-xs rounded-lg bg-blue-600 text-white hover:bg-blue-700">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5 5m0 0l5-5m-5 5V4"/>
                                    </svg>
                                    Download current poster
                                </button>
                            </div>
                        @else
                            <div class="rounded-lg border border-dashed border-slate-200 bg-slate-50 px-3 py-2">
                                <p class="text-slate-500">
                                    No poster has been uploaded yet.
                                </p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex justify-end gap-2 pt-6">
                <a href="{{ route('admin.classifications.tv-series') }}"
                   class="px-3 py-2 text-sm rounded-lg border border-slate-200 hover:bg-slate-50 transition-colors duration-200">
                    Cancel
                </a>
                <button type="submit"
                        wire:loading.attr="disabled"
                        class="inline-flex items-center px-4 py-2 text-sm rounded-lg bg-blue-600 text-white hover:bg-blue-700 shadow disabled:opacity-50 transition-colors duration-200">
                    <svg wire:loading wire:target="update" class="animate-spin -ml-1 mr-2 h-4 w-4 text-white"
                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10"
                                stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor"
                              d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                    </svg>
                    Update Season
                </button>
            </div>
        </form>
    </main>
</div>