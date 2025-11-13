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
    <!-- Back to films list -->
    <div class="mb-6">
        <a href="{{ route('admin.classifications.films') }}"
           class="inline-flex items-center text-sm text-blue-600 hover:text-blue-800 transition-colors duration-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to Films List
        </a>
    </div>

    <!-- Page Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Create New Film</h1>
        <p class="text-gray-600 mt-1">Add a new film to the classification system</p>
    </div>

    <form wire:submit="save" class="space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Film Title -->
            <div class="md:col-span-2">
                <label for="film_title" class="block text-sm font-medium text-gray-700 mb-1">Film Title<span class="text-red-500"> * </span></label>
                <input type="text" wire:model="film_title" id="film_title"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('film_title') border-red-500 @enderror"
                    placeholder="Enter film title">
                @error('film_title')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Slug Field -->
            <div class="md:col-span-2">
                <label for="slug" class="block text-sm font-medium text-gray-700 mb-1">
                    Custom URL Slug
                    <span class="text-gray-400 font-normal">(optional)</span>
                </label>
                <div class="flex items-center space-x-3">
                    <div class="flex-1">
                        <input type="text"
                               wire:model="slug"
                               id="slug"
                               @if($autoSlug) disabled @endif
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('slug') border-red-500 @enderror @if($autoSlug) bg-gray-100 cursor-not-allowed @endif"
                               placeholder="Leave empty for auto-generation">
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox"
                               wire:model="autoSlug"
                               id="autoSlug"
                               class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                        <label for="autoSlug" class="ml-2 text-sm font-medium text-gray-700 whitespace-nowrap">
                            Auto-generate
                        </label>
                    </div>
                </div>
                @error('slug')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-xs text-gray-500">
                    Custom URL-friendly version. Leave empty to auto-generate from film title.
                </p>
            </div>

            <!-- Film Type -->
            <div>
                <label for="film_type_id" class="block text-sm font-medium text-gray-700 mb-1">Film Type <span class="text-red-500">*</span></label>
                <select wire:model="film_type_id" id="film_type_id"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('film_type_id') border-red-500 @enderror">
                    <option value="">Select Film Type</option>
                    @foreach($filmTypes as $type)
                        <option value="{{ $type->id }}">{{ $type->type }}</option>
                    @endforeach
                </select>
                @error('film_type_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Duration -->
            <div>
                <label for="duration" class="block text-sm font-medium text-gray-700 mb-1">Duration (minutes) <span class="text-red-500">*</span></label>
                <input type="number" wire:model="duration" id="duration" min="1"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('duration') border-red-500 @enderror"
                    placeholder="e.g., 120">
                @error('duration')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </header>

    <!-- Form -->
    <main class="px-4 sm:px-6 lg:px-8 pb-12">
        <form wire:submit="save" class="space-y-6">

            <!-- Section: Basic -->
            <div class="bg-white rounded-xl border shadow-sm">
                <div class="px-4 py-3 border-b">
                    <h3 class="text-sm font-semibold text-slate-800">Basic Details</h3>
                    <p class="text-xs text-slate-500">Core identifiers used across the system.</p>
                </div>
                <div class="p-4 grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="md:col-span-2">
                        <label class="block text-xs font-medium text-slate-600 mb-1">Film Title <span class="text-rose-600">*</span></label>
                        <input type="text" wire:model.live="film_title"
                               class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 @error('film_title') border-rose-400 @enderror"
                               placeholder="e.g. The Highlands Run">
                        @error('film_title') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                        
            <!-- Genre - Text Input -->
            <div>
                <label for="genre" class="block text-sm font-medium text-gray-700 mb-1">Genre</label>
                <input type="text" wire:model="genre" id="genre"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('genre') border-red-500 @enderror"
                    placeholder="e.g., Action, Drama, Comedy">
                @error('genre')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-xs text-gray-500">
                    You can enter multiple genres separated by commas
                </p>
            </div>

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
                </div>
            </div>

            <!-- Section: Specs -->
            <div class="bg-white rounded-xl border shadow-sm">
                <div class="px-4 py-3 border-b">
                    <h3 class="text-sm font-semibold text-slate-800">Technical Specs & Classification Inputs</h3>
                    <p class="text-xs text-slate-500">Duration, language, and other details that affect rating decisions.</p>
                </div>
                <div class="p-4 grid grid-cols-1 md:grid-cols-4 gap-4">
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

                    <div>
                        <label class="block text-xs font-medium text-slate-600 mb-1">Duration (minutes) <span class="text-rose-600">*</span></label>
                        <input type="number" min="1" wire:model.live="duration"
                               class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 @error('duration') border-rose-400 @enderror"
                               placeholder="e.g. 120">
                        @error('duration') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                    </div>

            <!-- Country - Text Input -->
            <div>
                <label for="country" class="block text-sm font-medium text-gray-700 mb-1">Country</label>
                <input type="text" wire:model="country" id="country"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('country') border-red-500 @enderror"
                    placeholder="e.g., Philippines, USA">
                @error('country')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

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

                    <div class="md:col-span-2">
                        <label class="block text-xs font-medium text-slate-600 mb-1">Genre</label>
                        <input type="text" wire:model.live="genre"
                               class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 @error('genre') border-rose-400 @enderror"
                               placeholder="e.g. Action, Drama, Comedy">
                        @error('genre') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-xs font-medium text-slate-600 mb-1">Country</label>
                        <input type="text" wire:model.live="country"
                               class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 @error('country') border-rose-400 @enderror"
                               placeholder="e.g. Philippines, USA">
                        @error('country') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                    </div>

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

            <!-- Section: Creative -->
            <div class="bg-white rounded-xl border shadow-sm">
                <div class="px-4 py-3 border-b">
                    <h3 class="text-sm font-semibold text-slate-800">Creative & Credits</h3>
                    <p class="text-xs text-slate-500">People and descriptors that help officers decide quickly.</p>
                </div>
                <div class="p-4 grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-medium text-slate-600 mb-1">Director</label>
                        <input type="text" wire:model.live="director"
                               class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 @error('director') border-rose-400 @enderror"
                               placeholder="Director's name">
                        @error('director') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-slate-600 mb-1">Producer</label>
                        <input type="text" wire:model.live="producer"
                               class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 @error('producer') border-rose-400 @enderror"
                               placeholder="Producer's name">
                        @error('producer') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-slate-600 mb-1">Production Company</label>
                        <input type="text" wire:model.live="production_company"
                               class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 @error('production_company') border-rose-400 @enderror"
                               placeholder="e.g. Pacific Films Ltd">
                        @error('production_company') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="md:col-span-3">
                        <label class="block text-xs font-medium text-slate-600 mb-1">Cast</label>
                        <textarea rows="3" wire:model.live="casts"
                                  class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 @error('casts') border-rose-400 @enderror"
                                  placeholder="Enter cast members, separated by commas"></textarea>
                        @error('casts') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                    </div>

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
                    <div>
                        <label class="block text-xs font-medium text-slate-600 mb-1">Film Poster</label>
                        <input type="file" wire:model="poster" accept="image/*"
                               class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 @error('poster') border-rose-400 @enderror">
                        @error('poster') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                        @if ($poster)
                            <div class="mt-2">
                                <p class="text-xs text-slate-600">Preview:</p>
                                <img src="{{ $poster->temporaryUrl() }}" class="mt-1 h-32 object-cover rounded-lg border">
                            </div>
                        @endif
                        <p class="mt-1 text-[11px] text-slate-500">Supported: JPEG/PNG/GIF. Max 2MB.</p>
                    </div>

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
                        class="px-3 py-2 text-sm rounded-lg border border-slate-200 hover:bg-slate-50">
                    Reset
                </button>
                <a href="{{ route('admin.classifications.films') }}"
                   class="px-3 py-2 text-sm rounded-lg border border-slate-200 hover:bg-slate-50">
                    Cancel
                </a>
                <button type="submit"
                        class="inline-flex items-center px-4 py-2 text-sm rounded-lg bg-blue-600 text-white hover:bg-blue-700 shadow">
                    <svg wire:loading wire:target="save" class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                    </svg>
                    Create Film
                </button>
            </div>
        </form>
    </main>
    
        <!-- Form Actions -->
        <div class="flex justify-end space-x-3 pt-6 border-t border-gray-200">
            <button type="button" wire:click="resetForm"
                class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                Reset
            </button>
            <a href="{{ route('admin.classifications.films') }}"
                class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                Cancel
            </a>
            <button type="submit"
                class="px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-lg shadow-sm hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 flex items-center">
                <svg wire:loading wire:target="save" class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Create Film
            </button>
        </div>
    </form>
</div>
