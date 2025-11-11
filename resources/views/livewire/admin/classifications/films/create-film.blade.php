<div class="p-6">
    @if (session()->has('success'))
        <div class="mb-6 p-4 bg-green-50 text-green-700 rounded-lg border border-green-200">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="mb-6 p-4 bg-red-50 text-red-700 rounded-lg border border-red-200">
            {{ session('error') }}
        </div>
    @endif

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
                <label for="film_title" class="block text-sm font-medium text-gray-700 mb-1">Film Title *</label>
                <input type="text" wire:model="film_title" id="film_title"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('film_title') border-red-500 @enderror"
                    placeholder="Enter film title">
                @error('film_title')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Film Type -->
            <div>
                <label for="film_type_id" class="block text-sm font-medium text-gray-700 mb-1">Film Type *</label>
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
                <label for="duration" class="block text-sm font-medium text-gray-700 mb-1">Duration (minutes) *</label>
                <input type="number" wire:model="duration" id="duration" min="1"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('duration') border-red-500 @enderror"
                    placeholder="e.g., 120">
                @error('duration')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Release Year -->
            <div>
                <label for="release_year" class="block text-sm font-medium text-gray-700 mb-1">Release Year</label>
                <select wire:model="release_year" id="release_year"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('release_year') border-red-500 @enderror">
                    <option value="">Select Year</option>
                    @foreach($years as $year)
                        <option value="{{ $year }}">{{ $year }}</option>
                    @endforeach
                </select>
                @error('release_year')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Genre -->
            <div>
                <label for="genre" class="block text-sm font-medium text-gray-700 mb-1">Genre</label>
                <input type="text" wire:model="genre" id="genre"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('genre') border-red-500 @enderror"
                    placeholder="e.g., Action, Drama, Comedy">
                @error('genre')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Language -->
            <div>
                <label for="language" class="block text-sm font-medium text-gray-700 mb-1">Language</label>
                <select wire:model="language" id="language"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('language') border-red-500 @enderror">
                    <option value="">Select Language</option>
                    @foreach($languages as $key => $value)
                        <option value="{{ $value }}">{{ $value }}</option>
                    @endforeach
                </select>
                @error('language')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Color -->
            <div>
                <label for="color" class="block text-sm font-medium text-gray-700 mb-1">Color</label>
                <select wire:model="color" id="color"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('color') border-red-500 @enderror">
                    <option value="">Select Color Type</option>
                    @foreach($colors as $key => $value)
                        <option value="{{ $value }}">{{ $value }}</option>
                    @endforeach
                </select>
                @error('color')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Country -->
            <div>
                <label for="country" class="block text-sm font-medium text-gray-700 mb-1">Country</label>
                <input type="text" wire:model="country" id="country"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('country') border-red-500 @enderror"
                    placeholder="e.g., Philippines, USA">
                @error('country')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Director -->
            <div>
                <label for="director" class="block text-sm font-medium text-gray-700 mb-1">Director</label>
                <input type="text" wire:model="director" id="director"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('director') border-red-500 @enderror"
                    placeholder="Enter director's name">
                @error('director')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Producer -->
            <div>
                <label for="producer" class="block text-sm font-medium text-gray-700 mb-1">Producer</label>
                <input type="text" wire:model="producer" id="producer"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('producer') border-red-500 @enderror"
                    placeholder="Enter producer's name">
                @error('producer')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Production Company -->
            <div>
                <label for="production_company" class="block text-sm font-medium text-gray-700 mb-1">Production Company</label>
                <input type="text" wire:model="production_company" id="production_company"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('production_company') border-red-500 @enderror"
                    placeholder="Enter production company name">
                @error('production_company')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Has Subtitle -->
            <div class="flex items-center">
                <input wire:model="has_subtitle" id="has_subtitle" type="checkbox"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                <label for="has_subtitle" class="ml-2 text-sm font-medium text-gray-700">Film has subtitles</label>
                @error('has_subtitle')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Casts -->
            <div class="md:col-span-2">
                <label for="casts" class="block text-sm font-medium text-gray-700 mb-1">Casts</label>
                <textarea wire:model="casts" id="casts" rows="3"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('casts') border-red-500 @enderror"
                    placeholder="Enter cast members, separated by commas"></textarea>
                @error('casts')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Theme -->
            <div class="md:col-span-2">
                <label for="theme" class="block text-sm font-medium text-gray-700 mb-1">Theme</label>
                <textarea wire:model="theme" id="theme" rows="3"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('theme') border-red-500 @enderror"
                    placeholder="Enter film theme or subject matter"></textarea>
                @error('theme')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Poster Upload -->
            <div class="md:col-span-2">
                <label for="poster" class="block text-sm font-medium text-gray-700 mb-1">Film Poster</label>
                <input type="file" wire:model="poster" id="poster" accept="image/*"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('poster') border-red-500 @enderror">
                @error('poster')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                @if ($poster)
                    <div class="mt-2">
                        <p class="text-sm text-gray-600">Preview:</p>
                        <img src="{{ $poster->temporaryUrl() }}" class="mt-1 h-32 object-cover rounded-lg border">
                    </div>
                @endif
                <p class="mt-1 text-xs text-gray-500">Supported formats: JPEG, PNG, JPG, GIF (Max: 2MB)</p>
            </div>

            <!-- Trailer URL -->
            <div class="md:col-span-2">
                <label for="trailer_url" class="block text-sm font-medium text-gray-700 mb-1">Trailer URL</label>
                <input type="url" wire:model="trailer_url" id="trailer_url"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('trailer_url') border-red-500 @enderror"
                    placeholder="https://youtube.com/watch?v=...">
                @error('trailer_url')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

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
