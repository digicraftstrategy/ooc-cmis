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

    <form wire:submit="save" class="space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Film Title -->
            <div class="md:col-span-2">
                <label for="film_title" class="block text-sm font-medium text-gray-700 mb-1">Film Title *</label>
                <input type="text" wire:model="film_title" id="film_title"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('film_title') border-red-500 @enderror">
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
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('duration') border-red-500 @enderror">
                @error('duration')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Director -->
            <div>
                <label for="director" class="block text-sm font-medium text-gray-700 mb-1">Director *</label>
                <input type="text" wire:model="director" id="director"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('director') border-red-500 @enderror">
                @error('director')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Producer -->
            <div>
                <label for="producer" class="block text-sm font-medium text-gray-700 mb-1">Producer *</label>
                <input type="text" wire:model="producer" id="producer"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('producer') border-red-500 @enderror">
                @error('producer')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Production Company -->
            <div>
                <label for="production_company" class="block text-sm font-medium text-gray-700 mb-1">Production Company *</label>
                <input type="text" wire:model="production_company" id="production_company"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('production_company') border-red-500 @enderror">
                @error('production_company')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Distributor -->
            <div>
                <label for="distributor" class="block text-sm font-medium text-gray-700 mb-1">Distributor</label>
                <input type="text" wire:model="distributor" id="distributor"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('distributor') border-red-500 @enderror">
                @error('distributor')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Origin Country -->
            <div>
                <label for="origin_country" class="block text-sm font-medium text-gray-700 mb-1">Origin Country *</label>
                <input type="text" wire:model="origin_country" id="origin_country"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('origin_country') border-red-500 @enderror">
                @error('origin_country')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Film Color -->
            <div>
                <label for="film_color" class="block text-sm font-medium text-gray-700 mb-1">Film Color *</label>
                <select wire:model="film_color" id="film_color"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('film_color') border-red-500 @enderror">
                    <option value="">Select Color</option>
                    <option value="Color">Color</option>
                    <option value="Black & White">Black & White</option>
                    <option value="Both">Both</option>
                </select>
                @error('film_color')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Casts -->
            <div class="md:col-span-2">
                <label for="casts" class="block text-sm font-medium text-gray-700 mb-1">Casts *</label>
                <textarea wire:model="casts" id="casts" rows="3"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('casts') border-red-500 @enderror"
                    placeholder="Enter cast members, separated by commas"></textarea>
                @error('casts')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Synopsis -->
            <div class="md:col-span-2">
                <label for="synopsis" class="block text-sm font-medium text-gray-700 mb-1">Synopsis *</label>
                <textarea wire:model="synopsis" id="synopsis" rows="5"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('synopsis') border-red-500 @enderror"
                    placeholder="Enter film synopsis"></textarea>
                @error('synopsis')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submission File -->
            <div class="md:col-span-2">
                <label for="submission_file" class="block text-sm font-medium text-gray-700 mb-1">Submission File</label>
                <input type="file" wire:model="submission_file" id="submission_file"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('submission_file') border-red-500 @enderror">
                @error('submission_file')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                @if ($submission_file)
                    <p class="mt-2 text-sm text-gray-600">Selected file: {{ $submission_file->getClientOriginalName() }}</p>
                @endif
                <p class="mt-1 text-xs text-gray-500">Supported formats: PDF, DOC, DOCX (Max: 10MB)</p>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="flex justify-end space-x-3 pt-6 border-t border-gray-200">
            <button type="button" wire:click="$dispatch('close-modal')"
                class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                Cancel
            </button>
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
=======
<div x-data class="@unless($open) hidden @endunless">
    <!-- Backdrop -->
    <div class="fixed inset-0 bg-black/40 z-40" @click="$wire.close()"></div>

    <!-- Modal -->
    <div class="fixed inset-0 z-50 flex items-center justify-center p-4">
        <div class="w-full max-w-3xl bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="px-6 py-4 border-b">
                <h2 class="text-lg font-semibold">Add New Film</h2>
            </div>

            <div class="p-6 space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Film Title *</label>
                        <input type="text" wire:model.defer="film_title"
                               class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        @error('film_title') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Film Type</label>
                        <select wire:model.defer="film_type_id"
                                class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="">— Select —</option>
                            @foreach($filmTypes as $t)
                                <option value="{{ $t->id }}">{{ $t->type }}</option>
                            @endforeach
                        </select>
                        @error('film_type_id') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Main Actor/Actress</label>
                        <input type="text" wire:model.defer="main_actor_actress"
                               class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Duration (min)</label>
                        <input type="number" wire:model.defer="duration" min="1"
                               class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        @error('duration') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Director</label>
                        <input type="text" wire:model.defer="director"
                               class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Producer</label>
                        <input type="text" wire:model.defer="producer"
                               class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Production Company</label>
                        <input type="text" wire:model.defer="production_company"
                               class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Genre</label>
                        <input type="text" wire:model.defer="genre"
                               class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Language</label>
                        <input type="text" wire:model.defer="language"
                               class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Release Year</label>
                        <input type="number" wire:model.defer="release_year"
                               class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        @error('release_year') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Poster URL</label>
                        <input type="url" wire:model.defer="poster_url"
                               class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        @error('poster_url') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Trailer URL</label>
                        <input type="url" wire:model.defer="trailer_url"
                               class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        @error('trailer_url') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Theme</label>
                        <input type="text" wire:model.defer="theme"
                               class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Synopsis</label>
                        <textarea wire:model.defer="synopsis" rows="3"
                                  class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
                    </div>

                    <div class="flex items-center space-x-2 md:col-span-2">
                        <input id="has_subtitle" type="checkbox" wire:model.defer="has_subtitle"
                               class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        <label for="has_subtitle" class="text-sm text-gray-700">Has subtitle</label>
                    </div>
                </div>
            </div>

            <div class="px-6 py-4 bg-gray-50 border-t flex justify-end gap-2">
                <button type="button" wire:click="close"
                        class="px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-100">
                    Cancel
                </button>
                <button type="button" wire:click="save"
                        class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700">
                    Save Film
                </button>
            </div>
        </div>
    </div>
</div>
