{{-- <div class="p-6">
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

    <form wire:submit="update" class="space-y-6">
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

            <!-- Current File -->
            @if($film->submission_file_path)
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Current Submission File</label>
                    <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg border">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-900">{{ $film->original_file_name }}</p>
                            <p class="text-xs text-gray-500">Uploaded {{ $film->created_at->format('M j, Y') }}</p>
                        </div>
                        <a href="{{ route('admin.classifications.films.download', $film->id) }}"
                           class="px-3 py-1 text-sm text-blue-600 hover:text-blue-800 border border-blue-300 rounded hover:bg-blue-50 transition-colors duration-200">
                            Download
                        </a>
                    </div>
                </div>
            @endif

            <!-- New Submission File -->
            <div class="md:col-span-2">
                <label for="submission_file" class="block text-sm font-medium text-gray-700 mb-1">
                    {{ $film->submission_file_path ? 'Replace Submission File' : 'Submission File' }}
                </label>
                <input type="file" wire:model="submission_file" id="submission_file"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('submission_file') border-red-500 @enderror">
                @error('submission_file')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                @if ($submission_file)
                    <p class="mt-2 text-sm text-gray-600">New file: {{ $submission_file->getClientOriginalName() }}</p>
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
                <svg wire:loading wire:target="update" class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Update Film
            </button>
        </div>
    </form>
</div> --}}

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
                        <h1 class="text-2xl font-bold text-white">Edit Film</h1>
                        <p class="text-blue-100 opacity-90 text-sm">
                            Update details for <span class="font-semibold">{{ $film->film_title }}</span>.
                        </p>
                    </div>

                    <div class="flex items-center gap-2">
                        <a href="{{ route('admin.classifications.films') }}"
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
                            Update Film
                        </button>
                    </div>
                </div>

                <!-- Breadcrumb -->
                <nav class="mt-4 text-xs text-blue-100">
                    <ol class="flex items-center gap-2">
                        <li><a href="{{ route('admin.classifications.films') }}" class="hover:underline">Films</a></li>
                        <li>/</li>
                        <li class="text-white font-medium">Edit</li>
                    </ol>
                </nav>
            </div>
        </div>
    </header>

    <!-- Form -->
    <main class="px-4 sm:px-6 lg:px-8 pb-12">
        <form wire:submit="update" class="space-y-6">

            <!-- Section: Basic Details -->
            <div class="bg-white rounded-xl border shadow-sm">
                <div class="px-4 py-3 border-b">
                    <h3 class="text-sm font-semibold text-slate-800">Basic Details</h3>
                    <p class="text-xs text-slate-500">Core identifiers used across the system.</p>
                </div>
                <div class="p-4 grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Film Title -->
                    <div class="md:col-span-2">
                        <label class="block text-xs font-medium text-slate-600 mb-1">
                            Film Title <span class="text-rose-600">*</span>
                        </label>
                        <input type="text" wire:model.live="film_title"
                               class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 @error('film_title') border-rose-400 @enderror"
                               placeholder="e.g. The Highlands Run">
                        @error('film_title')
                        <p class="text-xs text-rose-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Film Type -->
                    <div>
                        <label class="block text-xs font-medium text-slate-600 mb-1">
                            Film Type <span class="text-rose-600">*</span>
                        </label>
                        <select wire:model.live="film_type_id"
                                class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 @error('film_type_id') border-rose-400 @enderror">
                            <option value="">Select Film Type</option>
                            @foreach($filmTypes as $type)
                                <option value="{{ $type->id }}">{{ $type->type }}</option>
                            @endforeach
                        </select>
                        @error('film_type_id')
                        <p class="text-xs text-rose-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Duration -->
                    <div>
                        <label class="block text-xs font-medium text-slate-600 mb-1">
                            Duration (minutes) <span class="text-rose-600">*</span>
                        </label>
                        <input type="number" min="1" wire:model.live="duration"
                               class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 @error('duration') border-rose-400 @enderror"
                               placeholder="e.g. 120">
                        @error('duration')
                        <p class="text-xs text-rose-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Origin Country -->
                    <div>
                        <label class="block text-xs font-medium text-slate-600 mb-1">
                            Origin Country <span class="text-rose-600">*</span>
                        </label>
                        <input type="text" wire:model.live="origin_country"
                               class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 @error('origin_country') border-rose-400 @enderror"
                               placeholder="e.g. Papua New Guinea">
                        @error('origin_country')
                        <p class="text-xs text-rose-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Film Color -->
                    <div>
                        <label class="block text-xs font-medium text-slate-600 mb-1">
                            Film Color <span class="text-rose-600">*</span>
                        </label>
                        <input type="text" wire:model.live="film_color"
                               class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 @error('film_color') border-rose-400 @enderror"
                               placeholder="e.g. Color, Black &amp; White">
                        @error('film_color')
                        <p class="text-xs text-rose-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Distributor -->
                    <div>
                        <label class="block text-xs font-medium text-slate-600 mb-1">
                            Distributor <span class="text-gray-400 font-normal">(optional)</span>
                        </label>
                        <input type="text" wire:model.live="distributor"
                               class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 @error('distributor') border-rose-400 @enderror"
                               placeholder="Distributor or License holder">
                        @error('distributor')
                        <p class="text-xs text-rose-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Section: Creative & Credits -->
            <div class="bg-white rounded-xl border shadow-sm">
                <div class="px-4 py-3 border-b">
                    <h3 class="text-sm font-semibold text-slate-800">Creative & Credits</h3>
                    <p class="text-xs text-slate-500">Key creatives and descriptive information for classifiers.</p>
                </div>
                <div class="p-4 grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Director -->
                    <div>
                        <label class="block text-xs font-medium text-slate-600 mb-1">
                            Director <span class="text-rose-600">*</span>
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
                            Producer <span class="text-rose-600">*</span>
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
                            Production Company <span class="text-rose-600">*</span>
                        </label>
                        <input type="text" wire:model.live="production_company"
                               class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 @error('production_company') border-rose-400 @enderror"
                               placeholder="e.g. Pacific Films Ltd">
                        @error('production_company')
                        <p class="text-xs text-rose-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Cast -->
                    <div class="md:col-span-3">
                        <label class="block text-xs font-medium text-slate-600 mb-1">
                            Cast <span class="text-rose-600">*</span>
                        </label>
                        <textarea rows="3" wire:model.live="casts"
                                  class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 @error('casts') border-rose-400 @enderror"
                                  placeholder="Enter cast members, separated by commas"></textarea>
                        @error('casts')
                        <p class="text-xs text-rose-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Synopsis -->
                    <div class="md:col-span-3">
                        <label class="block text-xs font-medium text-slate-600 mb-1">
                            Synopsis / Theme <span class="text-rose-600">*</span>
                        </label>
                        <textarea rows="4" wire:model.live="synopsis"
                                  class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 @error('synopsis') border-rose-400 @enderror"
                                  placeholder="Brief narrative summary and key themes that influence classification."></textarea>
                        @error('synopsis')
                        <p class="text-xs text-rose-600 mt-1">{{ $message }}</p>
                        @enderror
                        <p class="text-[11px] text-slate-500 mt-1">
                            Tip: include any content notes (violence, horror, language, substances, etc.).
                        </p>
                    </div>
                </div>
            </div>

            <!-- Section: Submission File -->
            <div class="bg-white rounded-xl border shadow-sm">
                <div class="px-4 py-3 border-b">
                    <h3 class="text-sm font-semibold text-slate-800">Submission File</h3>
                    <p class="text-xs text-slate-500">
                        Upload or replace the official submission document for this film.
                    </p>
                </div>
                <div class="p-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Upload -->
                    <div>
                        <label class="block text-xs font-medium text-slate-600 mb-1">
                            Submission File <span class="text-gray-400 font-normal">(PDF / DOC / DOCX)</span>
                        </label>
                        <input type="file" wire:model="submission_file"
                               accept=".pdf,.doc,.docx"
                               class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 @error('submission_file') border-rose-400 @enderror">
                        @error('submission_file')
                        <p class="text-xs text-rose-600 mt-1">{{ $message }}</p>
                        @enderror

                        <p class="mt-1 text-[11px] text-slate-500">
                            Max size: 10MB. Upload only if you need to replace the existing file.
                        </p>

                        @if ($submission_file)
                            <p class="mt-2 text-xs text-slate-700">
                                New file selected:
                                <span class="font-semibold">{{ $submission_file->getClientOriginalName() }}</span>
                            </p>
                        @endif
                    </div>

                    <!-- Existing file info -->
                    <div class="md:text-sm text-xs">
                        <label class="block text-xs font-medium text-slate-600 mb-1">
                            Current Submission
                        </label>

                        @if ($film->submission_file_path)
                            <div class="rounded-lg border bg-slate-50 px-3 py-2">
                                <p class="text-slate-700 break-all">
                                    {{ $film->original_file_name ?? 'Existing submission file' }}
                                </p>
                                <button type="button"
                                        wire:click="downloadFile"
                                        class="mt-2 inline-flex items-center px-3 py-1.5 text-xs rounded-lg bg-blue-600 text-white hover:bg-blue-700">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5 5m0 0l5-5m-5 5V4"/>
                                    </svg>
                                    Download current file
                                </button>
                            </div>
                        @else
                            <div class="rounded-lg border border-dashed border-slate-200 bg-slate-50 px-3 py-2">
                                <p class="text-slate-500">
                                    No submission file has been uploaded yet.
                                </p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex justify-end gap-2 pt-6">
                <a href="{{ route('admin.classifications.films') }}"
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
                    Update Film
                </button>
            </div>
        </form>
    </main>
</div>

