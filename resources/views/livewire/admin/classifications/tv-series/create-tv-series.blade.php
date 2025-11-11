<div class="p-4">
    <!-- Form -->
    <div class="space-y-6">

        <!-- Title & Slug -->
        <div class="bg-white rounded-xl border shadow-sm">
            <div class="px-4 py-3 border-b">
                <h3 class="text-sm font-semibold text-slate-800">Basic Details</h3>
                <p class="text-xs text-slate-500">Core identifiers used across the system.</p>
            </div>
            <div class="p-4 grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="md:col-span-2">
                    <label class="block text-xs font-medium text-slate-600 mb-1">Series Title <span class="text-rose-600">*</span></label>
                    <input
                        type="text"
                        wire:model.live="tv_series_title"
                        class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500"
                        placeholder="e.g. Guardians of the Pacific"
                    >
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
                        <input
                            type="text"
                            wire:model.live="slug"
                            @disabled($autoSlug)
                            class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 disabled:bg-slate-50 disabled:text-slate-500"
                            placeholder="guardians-of-the-pacific"
                        >
                        @error('slug') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                        <p class="text-[11px] text-slate-500 mt-1">Used in URLs and lookups. Must be unique.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Seasons & Episodes -->
        <div class="bg-white rounded-xl border shadow-sm">
            <div class="px-4 py-3 border-b">
                <h3 class="text-sm font-semibold text-slate-800">Season & Episodes</h3>
                <p class="text-xs text-slate-500">Describe the current season or the series aggregate.</p>
            </div>
            <div class="p-4 grid grid-cols-1 md:grid-cols-4 gap-4">
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
                    <label class="block text-xs font-medium text-slate-600 mb-1">Episodes #</label>
                    <input type="number" min="1" wire:model.live="number_of_episodes"
                           class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500"
                           placeholder="10">
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
        </div>

        <!-- Creative & Meta -->
        <div class="bg-white rounded-xl border shadow-sm">
            <div class="px-4 py-3 border-b">
                <h3 class="text-sm font-semibold text-slate-800">Creative & Metadata</h3>
                <p class="text-xs text-slate-500">People and descriptors that help officers decide quickly.</p>
            </div>
            <div class="p-4 grid grid-cols-1 md:grid-cols-3 gap-4">
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
        </div>

        <!-- Actions -->
        <div class="flex items-center justify-end gap-2 pt-2">
            <button
                type="button"
                class="px-3 py-2 text-sm rounded-lg border border-slate-200 hover:bg-slate-50"
                wire:click="$dispatch('closeCreateModal')"
            >
                Cancel
            </button>

            <button
                type="button"
                wire:click="save"
                wire:loading.attr="disabled"
                class="inline-flex items-center px-4 py-2 text-sm rounded-lg bg-blue-600 text-white hover:bg-blue-700 shadow disabled:opacity-50"
            >
                <svg wire:loading wire:target="save" class="animate-spin -ml-1 mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                </svg>
                Save TV Series
            </button>
        </div>
    </div>
</div>
