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
                        <h1 class="text-2xl font-bold text-white">Create Film</h1>
                        <p class="text-blue-100 opacity-90 text-sm">Register a new film so officers can classify and rate.</p>
                    </div>

                    <div class="flex items-center gap-2">
                        <a href="{{ route('admin.classifications.films') }}"
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
                            Save Film
                        </button>
                    </div>
                </div>

                <!-- Breadcrumb -->
                <nav class="mt-4 text-xs text-blue-100">
                    <ol class="flex items-center gap-2">
                        <li><a href="{{ route('admin.classifications.films') }}" class="hover:underline">Films</a></li>
                        <li>/</li>
                        <li class="text-white font-medium">Create</li>
                    </ol>
                </nav>
            </div>
        </div>
    </header>

    <!-- Form -->
    <main class="px-4 sm:px-6 lg:px-8 pb-12">
        <form wire:submit="save" class="space-y-6">

            <!-- Section: Basic Details -->
            <div class="bg-white rounded-xl border shadow-sm">
                <div class="px-4 py-3 border-b">
                    <h3 class="text-sm font-semibold text-slate-800">Basic Details</h3>
                    <p class="text-xs text-slate-500">Core identifiers used across the system.</p>
                </div>
                <div class="p-4 grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Film Title -->
                    <div class="md:col-span-2">
                        <label class="block text-xs font-medium text-slate-600 mb-1">Film Title <span class="text-rose-600">*</span></label>
                        <input type="text" wire:model.live="film_title"
                               class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 @error('film_title') border-rose-400 @enderror"
                               placeholder="e.g. The Highlands Run">
                        @error('film_title') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Release Year -->
                    <div>
                        <label class="block text-xs font-medium text-slate-600 mb-1">Release Year</label>
                        <select wire:model.live="release_year"
                                class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 @error('release_year') border-rose-400 @enderror">
                            <option value="">Select Year</option>
                            @foreach($years as $year)
                                <option value="{{ $year }}">{{ $year }}</option>
                            @endforeach
                        </select>
                        @error('release_year') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Custom URL Slug -->
                    <div class="md:col-span-3">
                        <label class="block text-xs font-medium text-slate-600 mb-1">
                            Custom URL Slug
                            <span class="text-gray-400 font-normal">(optional)</span>
                        </label>
                        <div class="flex items-center space-x-3">
                            <div class="flex-1">
                                <input type="text"
                                       wire:model="slug"
                                       @if($autoSlug) disabled @endif
                                       class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 @error('slug') border-rose-400 @enderror @if($autoSlug) bg-gray-100 cursor-not-allowed @endif"
                                       placeholder="Leave empty for auto-generation">
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox"
                                       wire:model="autoSlug"
                                       id="autoSlug"
                                       class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="autoSlug" class="ml-2 text-xs font-medium text-slate-700 whitespace-nowrap">
                                    Auto-generate
                                </label>
                            </div>
                        </div>
                        @error('slug') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                        <p class="mt-1 text-xs text-slate-500">
                            Custom URL-friendly version. Leave empty to auto-generate from film title.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Section: Technical Specs -->
            <div class="bg-white rounded-xl border shadow-sm">
                <div class="px-4 py-3 border-b">
                    <h3 class="text-sm font-semibold text-slate-800">Technical Specs & Classification Inputs</h3>
                    <p class="text-xs text-slate-500">Duration, language, and other details that affect rating decisions.</p>
                </div>
                <div class="p-4 grid grid-cols-1 md:grid-cols-4 gap-4">
                    <!-- Film Type -->
                    <div>
                        <label class="block text-xs font-medium text-slate-600 mb-1">Film Type <span class="text-rose-600">*</span></label>
                        <select wire:model.live="film_type_id"
                                class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 @error('film_type_id') border-rose-400 @enderror">
                            <option value="">Select Film Type</option>
                            @foreach($filmTypes as $type)
                                <option value="{{ $type->id }}">{{ $type->type }}</option>
                            @endforeach
                        </select>
                        @error('film_type_id') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Duration -->
                    <div>
                        <label class="block text-xs font-medium text-slate-600 mb-1">Duration (minutes) <span class="text-rose-600">*</span></label>
                        <input type="number" min="1" wire:model.live="duration"
                               class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 @error('duration') border-rose-400 @enderror"
                               placeholder="e.g. 120">
                        @error('duration') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Language -->
                    <div>
                        <label class="block text-xs font-medium text-slate-600 mb-1">Language</label>
                        <select wire:model.live="language"
                                class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 @error('language') border-rose-400 @enderror">
                            <option value="">Select Language</option>
                            @foreach($languages as $value)
                                <option value="{{ $value }}">{{ $value }}</option>
                            @endforeach
                        </select>
                        @error('language') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Color -->
                    <div>
                        <label class="block text-xs font-medium text-slate-600 mb-1">Color</label>
                        <select wire:model.live="color"
                                class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 @error('color') border-rose-400 @enderror">
                            <option value="">Select Color Type</option>
                            @foreach($colors as $value)
                                <option value="{{ $value }}">{{ $value }}</option>
                            @endforeach
                        </select>
                        @error('color') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Genre -->
                    <div class="md:col-span-2">
                        <label class="block text-xs font-medium text-slate-600 mb-1">Genre</label>
                        <input type="text" wire:model.live="genre"
                               class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 @error('genre') border-rose-400 @enderror"
                               placeholder="e.g. Action, Drama, Comedy">
                        @error('genre') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Country -->
                    <div class="md:col-span-2">
                        <label class="block text-xs font-medium text-slate-600 mb-1">Country</label>
                        <input type="text" wire:model.live="country"
                               class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 @error('country') border-rose-400 @enderror"
                               placeholder="e.g. Philippines, USA">
                        @error('country') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Has Subtitles -->
                    <div class="md:col-span-2">
                        <label class="block text-xs font-medium text-slate-600 mb-1">Has Subtitles</label>
                        <label class="inline-flex items-center text-xs bg-slate-50 border rounded px-3 py-2 cursor-pointer">
                            <input type="checkbox" class="mr-2" wire:model.live="has_subtitle">
                            Film includes subtitle track
                        </label>
                        @error('has_subtitle') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            <!-- Section: Creative & Credits -->
            <div class="bg-white rounded-xl border shadow-sm">
                <div class="px-4 py-3 border-b">
                    <h3 class="text-sm font-semibold text-slate-800">Creative & Credits</h3>
                    <p class="text-xs text-slate-500">People and descriptors that help officers decide quickly.</p>
                </div>
                <div class="p-4 grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Director -->
                    <div>
                        <label class="block text-xs font-medium text-slate-600 mb-1">Director</label>
                        <input type="text" wire:model.live="director"
                               class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 @error('director') border-rose-400 @enderror"
                               placeholder="Director's name">
                        @error('director') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Producer -->
                    <div>
                        <label class="block text-xs font-medium text-slate-600 mb-1">Producer</label>
                        <input type="text" wire:model.live="producer"
                               class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 @error('producer') border-rose-400 @enderror"
                               placeholder="Producer's name">
                        @error('producer') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Production Company -->
                    <div>
                        <label class="block text-xs font-medium text-slate-600 mb-1">Production Company</label>
                        <input type="text" wire:model.live="production_company"
                               class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 @error('production_company') border-rose-400 @enderror"
                               placeholder="e.g. Pacific Films Ltd">
                        @error('production_company') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Cast -->
                    <div class="md:col-span-3">
                        <label class="block text-xs font-medium text-slate-600 mb-1">Cast</label>
                        <textarea rows="3" wire:model.live="casts"
                                  class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 @error('casts') border-rose-400 @enderror"
                                  placeholder="Enter cast members, separated by commas"></textarea>
                        @error('casts') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Theme / Synopsis -->
                    <div class="md:col-span-3">
                        <label class="block text-xs font-medium text-slate-600 mb-1">Theme / Synopsis</label>
                        <textarea rows="4" wire:model.live="theme"
                                  class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 @error('theme') border-rose-400 @enderror"
                                  placeholder="Brief narrative summary and notable themes that influence classification."></textarea>
                        @error('theme') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                        <p class="text-[11px] text-slate-500 mt-1">Tip: include any content notes (violence, horror, language, substances, etc.).</p>
                    </div>
                </div>
            </div>

            <!-- Section: Media -->
            <div class="bg-white rounded-xl border shadow-sm">
                <div class="px-4 py-3 border-b">
                    <h3 class="text-sm font-semibold text-slate-800">Media</h3>
                    <p class="text-xs text-slate-500">Poster and trailer help officers preview the content.</p>
                </div>
                <div class="p-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Film Poster -->
                    <div>
                        <label class="block text-xs font-medium text-slate-600 mb-1">Film Poster</label>
                        <input type="file" wire:model="poster_path" accept="image/*"
                               class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 @error('poster_path') border-rose-400 @enderror">
                        @error('poster_path') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                        @if ($poster_path)
                            <div class="mt-2">
                                <p class="text-xs text-slate-600">Preview:</p>
                                <img src="{{ $poster_path->temporaryUrl() }}" class="mt-1 h-32 object-cover rounded-lg border">
                            </div>
                        @endif
                        <p class="mt-1 text-[11px] text-slate-500">Supported: JPEG/PNG/GIF. Max 2MB.</p>
                    </div>

                    <!-- Trailer URL -->
                    <div>
                        <label class="block text-xs font-medium text-slate-600 mb-1">Trailer URL</label>
                        <input type="url" wire:model.live="trailer_url"
                               class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 @error('trailer_url') border-rose-400 @enderror"
                               placeholder="https://youtube.com/watch?v=...">
                        @error('trailer_url') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex justify-end gap-2 pt-6">
                <button type="button" wire:click="resetForm"
                        class="px-3 py-2 text-sm rounded-lg border border-slate-200 hover:bg-slate-50 transition-colors duration-200">
                    Reset
                </button>
                <a href="{{ route('admin.classifications.films') }}"
                   class="px-3 py-2 text-sm rounded-lg border border-slate-200 hover:bg-slate-50 transition-colors duration-200">
                    Cancel
                </a>
                <button type="submit"
                        wire:loading.attr="disabled"
                        class="inline-flex items-center px-4 py-2 text-sm rounded-lg bg-blue-600 text-white hover:bg-blue-700 shadow disabled:opacity-50 transition-colors duration-200">
                    <svg wire:loading wire:target="save" class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                    </svg>
                    Create Film
                </button>
            </div>
        </form>
    </main>
</div>