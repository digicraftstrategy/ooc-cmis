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
        <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded">
            {{ session('error') }}
        </div>
    @endif

    <form wire:submit="save" class="space-y-6">
        <!-- TV Series Selection -->
        <div class="bg-blue-50 p-4 rounded-lg">
            <div class="flex items-center mb-4">
                <input type="radio" id="new_series" wire:model.live="createNewSeries" value="1" class="mr-2">
                <label for="new_series" class="font-medium text-gray-700">Create New TV Series</label>
            </div>

            <div class="flex items-center mb-4">
                <input type="radio" id="existing_series" wire:model.live="createNewSeries" value="0" class="mr-2">
                <label for="existing_series" class="font-medium text-gray-700">Use Existing TV Series</label>
            </div>

            @if($createNewSeries)
                <!-- New TV Series Fields -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="tv_series_title" class="block text-sm font-medium text-gray-700 mb-1">
                            TV Series Title *
                        </label>
                        <input type="text" id="tv_series_title" wire:model.blur="tv_series_title"
                            class="w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        @error('tv_series_title') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <div class="flex items-center justify-between mb-1">
                            <label for="slug" class="block text-sm font-medium text-gray-700">Series Slug *</label>
                            <div class="flex items-center text-sm">
                                <input type="checkbox" id="auto_slug" wire:model.live="autoSlug" class="mr-1">
                                <label for="auto_slug" class="text-gray-600">Auto-generate</label>
                            </div>
                        </div>
                        <input type="text" id="slug" wire:model.blur="slug"
                            class="w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        @error('slug') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>
            @else
                <!-- Existing TV Series Selection -->
                <div>
                    <label for="selectedSeriesId" class="block text-sm font-medium text-gray-700 mb-1">
                        Select TV Series *
                    </label>
                    <select id="selectedSeriesId" wire:model.live="selectedSeriesId"
                        class="w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        <option value="">-- Select TV Series --</option>
                        @foreach($existingSeries as $series)
                            <option value="{{ $series->id }}">{{ $series->tv_series_title }}</option> {{-- Updated to tv_series_title --}}
                        @endforeach
                    </select>
                    @error('selectedSeriesId') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
            @endif
        </div>

        <!-- Season Information -->
        <div class="border-t pt-6">
            <h3 class="text-lg font-medium text-gray-800 mb-4">Season Information</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Season Title -->
                <div>
                    <label for="season_title" class="block text-sm font-medium text-gray-700 mb-1">
                        Season Title *
                    </label>
                    <input type="text" id="season_title" wire:model.blur="season_title"
                        class="w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    @error('season_title') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <!-- Season Slug -->
                <div>
                    <div class="flex items-center justify-between mb-1">
                        <label for="season_slug" class="block text-sm font-medium text-gray-700">Season Slug *</label>
                        <div class="flex items-center text-sm">
                            <input type="checkbox" id="auto_season_slug" wire:model.live="autoSeasonSlug" class="mr-1">
                            <label for="auto_season_slug" class="text-gray-600">Auto-generate</label>
                        </div>
                    </div>
                    <input type="text" id="season_slug" wire:model.blur="season_slug"
                        class="w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    @error('season_slug') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <!-- Season Number -->
                <div>
                    <label for="season_number" class="block text-sm font-medium text-gray-700 mb-1">
                        Season Number *
                    </label>
                    <input type="number" id="season_number" wire:model.blur="season_number" min="1"
                        class="w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    @error('season_number') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <!-- Number of Episodes -->
                <div>
                    <label for="number_of_episodes" class="block text-sm font-medium text-gray-700 mb-1">
                        Number of Episodes *
                    </label>
                    <input type="text" id="number_of_episodes" wire:model.blur="number_of_episodes" min="1"
                        class="w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    @error('number_of_episodes') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <!-- Duration -->
                <div>
                    <label for="duration" class="block text-sm font-medium text-gray-700 mb-1">
                        Duration (minutes)
                    </label>
                    <input type="number" id="duration" wire:model.blur="duration" min="1"
                        class="w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    @error('duration') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <!-- Released Year -->
                <div>
                    <label for="release_year" class="block text-sm font-medium text-gray-700 mb-1">
                        Release Year *
                    </label>
                    <input type="number" id="release_year" wire:model.blur="release_year"
                        min="1900" max="{{ date('Y') + 1 }}"
                        class="w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    @error('release_year') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <!-- Language -->
                <div>
                    <label for="language" class="block text-sm font-medium text-gray-700 mb-1">
                        Language
                    </label>
                    <input type="text" id="language" wire:model.blur="language"
                        class="w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    @error('language') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <!-- Has Subtitle -->
                <div class="flex items-center">
                    <input type="checkbox" id="has_subtitle" wire:model="has_subtitle" class="mr-2">
                    <label for="has_subtitle" class="text-sm font-medium text-gray-700">Has Subtitle</label>
                </div>
            </div>

            <!-- Additional Fields -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <!-- Casts -->
                <div>
                    <label for="casts" class="block text-sm font-medium text-gray-700 mb-1">
                        Casts
                    </label>
                    <input type="text" id="casts" wire:model.blur="casts"
                        class="w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Actor 1, Actor 2, Actor 3">
                </div>

                <!-- Genre -->
                <div>
                    <label for="genre" class="block text-sm font-medium text-gray-700 mb-1">
                        Genre
                    </label>
                    <input type="text" id="genre" wire:model.blur="genre"
                        class="w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Action, Drama, Comedy">
                </div>

                <!-- Director -->
                <div>
                    <label for="director" class="block text-sm font-medium text-gray-700 mb-1">
                        Director
                    </label>
                    <input type="text" id="director" wire:model.blur="director"
                        class="w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Producer -->
                <div>
                    <label for="producer" class="block text-sm font-medium text-gray-700 mb-1">
                        Producer
                    </label>
                    <input type="text" id="producer" wire:model.blur="producer"
                        class="w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>

            <!-- Production Company & Theme -->
            <div class="grid grid-cols-1 gap-4 mt-4">
                <div>
                    <label for="production_company" class="block text-sm font-medium text-gray-700 mb-1">
                        Production Company
                    </label>
                    <input type="text" id="production_company" wire:model.blur="production_company"
                        class="w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label for="theme" class="block text-sm font-medium text-gray-700 mb-1">
                        Theme
                    </label>
                    <textarea id="theme" wire:model.blur="theme" rows="3"
                        class="w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"></textarea>
                </div>
            </div>

            <!-- Poster Upload -->
            <div class="mt-4">
                <label for="poster_path" class="block text-sm font-medium text-gray-700 mb-1">
                    Season Poster
                </label>
                <input type="file" id="poster_path" wire:model="poster_path"
                    accept="image/*"
                    class="w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                @error('poster_path') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror

                @if ($poster_path)
                    <div class="mt-2">
                        <p class="text-sm text-gray-600">Preview:</p>
                        <img src="{{ $poster_path->temporaryUrl() }}" class="mt-1 h-32 rounded shadow">
                    </div>
                @endif
            </div>
        </div>

        <!-- Form Actions -->
        <div class="flex justify-end space-x-3 pt-6 border-t">
            <a href="{{ route('admin.classifications.tv-series') }}"
                class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Cancel
            </a>
            <button type="submit"
                class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Create TV Series Season
            </button>
        </div>
    </form>
</div>
