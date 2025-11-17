<div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50">

    <!-- Page Header -->
    <header class="px-4 sm:px-6 lg:px-8 py-6">
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-2xl shadow-lg overflow-hidden">
            <div class="px-6 py-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-white">Create Literature</h1>
                    <p class="text-blue-100 opacity-90 text-sm">
                        Register a new literature record so officers can classify and reference it.
                    </p>
                </div>

                <div class="flex items-center gap-2">
                    <a href="{{ route('admin.classifications.literatures') }}"
                       class="px-3 py-2 text-sm rounded-lg bg-white/10 text-white hover:bg-white/20 border border-white/20 transition">
                        Back
                    </a>
                    <button
                        wire:click="save"
                        wire:loading.attr="disabled"
                        class="inline-flex items-center px-4 py-2 text-sm rounded-lg bg-white text-blue-700 hover:bg-blue-50 shadow disabled:opacity-50">
                        <svg wire:loading wire:target="save" class="animate-spin -ml-1 mr-2 h-4 w-4"
                             xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10"
                                    stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor"
                                  d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                        </svg>
                        Save Literature
                    </button>
                </div>
            </div>

            <!-- Breadcrumb -->
            <nav class="px-6 mt-2 pb-4 text-xs text-blue-100">
                <ol class="flex items-center gap-2">
                    <li><a href="{{ route('admin.classifications.literatures') }}" class="hover:underline">Literatures</a></li>
                    <li>/</li>
                    <li class="text-white font-medium">Create</li>
                </ol>
            </nav>
        </div>
    </header>

    <!-- Notifications -->
    @if (session('success'))
        <div class="mx-4 sm:mx-6 lg:px-8 -mt-2">
            <div class="rounded-lg bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 shadow">
                {{ session('success') }}
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <main class="px-4 sm:px-6 lg:px-8 pb-16">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

            <!-- Left: Form -->
            <div class="lg:col-span-8 space-y-6">

                <!-- Basic Details -->
                <section class="bg-white rounded-xl border shadow-sm overflow-hidden">
                    <div class="px-5 py-4 border-b">
                        <h2 class="text-sm font-semibold text-slate-800">Basic Details</h2>
                        <p class="text-xs text-slate-500">Core identifiers used across the system.</p>
                    </div>

                    <div class="p-5 grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="md:col-span-2">
                            <label class="block text-xs font-medium text-slate-600 mb-1">
                                Literature Title <span class="text-rose-600">*</span>
                            </label>
                            <input type="text" wire:model.live="literature_title"
                                   class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500"
                                   placeholder="e.g. Guardians of the Highlands">
                            @error('literature_title') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
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
                                       placeholder="guardians-of-the-highlands">
                                @error('slug') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                                <p class="text-[11px] text-slate-500 mt-1">Used in URLs and lookups. Must be unique.</p>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Publication Details -->
                <section class="bg-white rounded-xl border shadow-sm overflow-hidden">
                    <div class="px-5 py-4 border-b">
                        <h2 class="text-sm font-semibold text-slate-800">Publication Details</h2>
                        <p class="text-xs text-slate-500">Author, publisher and publication year.</p>
                    </div>

                    <div class="p-5 grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1">Author</label>
                            <input type="text" wire:model.live="author"
                                   class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                            @error('author') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1">Publisher</label>
                            <input type="text" wire:model.live="publisher"
                                   class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                            @error('publisher') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1">Publication Year</label>
                            <input type="number" wire:model.live="publication_year" min="1800" max="{{ now()->year + 1 }}"
                                   class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                            @error('publication_year') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1">Pages</label>
                            <input type="number" wire:model.live="pages" min="1"
                                   class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                            @error('pages') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-xs font-medium text-slate-600 mb-1">Genre</label>
                            <input type="text" wire:model.live="genre"
                                   class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500"
                                   placeholder="e.g. Historical fiction, Poetry">
                            @error('genre') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </section>

                <!-- Summary -->
                <section class="bg-white rounded-xl border shadow-sm overflow-hidden">
                    <div class="px-5 py-4 border-b">
                        <h2 class="text-sm font-semibold text-slate-800">Summary</h2>
                        <p class="text-xs text-slate-500">Narrative summary and notes relevant to classification.</p>
                    </div>
                    <div class="p-5">
                        <textarea rows="5" wire:model.live="summary"
                                  class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500"
                                  placeholder="Brief synopsis, themes, and any notes that influence classification."></textarea>
                        @error('summary') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                    </div>
                </section>

                <!-- Cover Art -->
                <section class="bg-white rounded-xl border shadow-sm overflow-hidden">
                    <div class="px-5 py-4 border-b">
                        <h2 class="text-sm font-semibold text-slate-800">Cover Art</h2>
                        <p class="text-xs text-slate-500">Optional cover image for lists and detail views.</p>
                    </div>
                    <div class="p-5">
                        <input type="file" wire:model="cover_art" accept="image/*"
                               class="block w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                        @error('cover_art') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror

                        @if($cover_art)
                            <div class="mt-3">
                                <p class="text-xs text-slate-500 mb-1">Preview:</p>
                                <img src="{{ $cover_art->temporaryUrl() }}"
                                     class="h-40 rounded-lg shadow border object-cover">
                            </div>
                        @endif
                        <p class="text-[11px] text-slate-500 mt-2">Supported formats: JPEG, PNG (Max: 2MB).</p>
                    </div>
                </section>

                <!-- Bottom Actions -->
                <div class="bg-white rounded-xl border shadow-sm p-5">
                    <div class="flex justify-end gap-2">
                        <a href="{{ route('admin.classifications.literatures') }}"
                           class="px-3 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-200 rounded-lg shadow-sm hover:bg-slate-50">
                            Cancel
                        </a>
                        <button
                            type="button"
                            wire:click="save"
                            wire:loading.attr="disabled"
                            class="px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-lg shadow-sm hover:bg-blue-700 flex items-center">
                            <svg wire:loading wire:target="save" class="animate-spin -ml-1 mr-2 h-4 w-4 text-white"
                                 xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10"
                                        stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                      d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Save Literature
                        </button>
                    </div>
                </div>
            </div>

            <!-- Right: Preview / Tips -->
            <aside class="lg:col-span-4 space-y-6">
                <!-- Preview -->
                <section class="bg-white rounded-xl border shadow-sm overflow-hidden">
                    <div class="px-5 py-4 border-b">
                        <h3 class="text-sm font-semibold text-slate-800">Preview Card</h3>
                        <p class="text-xs text-slate-500">How this literature might appear in lists.</p>
                    </div>
                    <div class="p-5">
                        <div class="rounded-lg border bg-gradient-to-b from-slate-50 to-white p-4 flex gap-4">
                            <div class="w-20 h-28 rounded-md overflow-hidden bg-slate-100 border border-slate-200 flex items-center justify-center text-[10px] text-slate-400">
                                @if($cover_art)
                                    <img src="{{ $cover_art->temporaryUrl() }}" class="w-full h-full object-cover">
                                @else
                                    No cover
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-semibold text-slate-900 truncate">
                                    {{ $literature_title ?: 'Literature title' }}
                                </p>
                                <p class="text-xs text-slate-500 truncate mt-0.5">
                                    {{ $author ?: 'Author' }} @if($publication_year) • {{ $publication_year }} @endif
                                </p>
                                <p class="mt-2 text-xs text-slate-600 line-clamp-3">
                                    {{ $summary ?: 'A short summary will help officers assess this record quickly.' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Tips -->
                <section class="bg-white rounded-xl border shadow-sm overflow-hidden">
                    <div class="px-5 py-4 border-b">
                        <h3 class="text-sm font-semibold text-slate-800">Submission Tips</h3>
                    </div>
                    <div class="p-5 text-sm text-slate-600 space-y-2">
                        <p>• Provide a clear <strong>summary</strong> and note any sensitive themes.</p>
                        <p>• Make sure the <strong>slug</strong> is human readable; keep Auto-slug on unless necessary.</p>
                        <p>• Fill in accurate <strong>publication year</strong>, <strong>pages</strong> and <strong>genre</strong> for better filtering.</p>
                    </div>
                </section>
            </aside>
        </div>
    </main>
</div>

