<div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50">

    <!-- Page Header -->
    <header class="px-4 sm:px-6 lg:px-8 py-6">
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-2xl shadow-lg overflow-hidden">
            <div class="px-6 py-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <h1 class="text-2xl font-bold text-white">
                            Edit Advertisement
                        </h1>
                        <p class="text-blue-100 opacity-90 text-sm">
                            Update an existing advertisement matter so officers can classify and rate correctly.
                        </p>
                    </div>

                    <div class="flex items-center gap-2">
                        <a href="{{ route('admin.classifications.advertisements') }}"
                           class="px-3 py-2 text-sm rounded-lg bg-white/10 text-white hover:bg-white/20 border border-white/20 transition">
                            Back to Advertisements
                        </a>
                        <button
                            wire:click="save"
                            wire:loading.attr="disabled"
                            class="inline-flex items-center px-4 py-2 text-sm rounded-lg bg-white text-blue-700 hover:bg-blue-50 shadow disabled:opacity-50">
                            <svg wire:loading wire:target="save" class="animate-spin -ml-1 mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                            </svg>
                            Update Advertisement
                        </button>
                    </div>
                </div>

                <!-- Breadcrumb -->
                <nav class="mt-4 text-xs text-blue-100">
                    <ol class="flex items-center gap-2">
                        <li><a href="{{ route('admin.classifications.advertisements') }}" class="hover:underline">Advertisements</a></li>
                        <li>/</li>
                        <li class="text-white font-medium">Edit</li>
                        <li>/</li>
                        <li class="text-blue-100 truncate max-w-[180px]">
                            {{ $advertising_matter ?: 'Untitled' }}
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </header>

    <!-- Notifications -->
    @if (session()->has('success'))
        <div class="mx-4 sm:mx-6 lg:px-8 -mt-2">
            <div class="rounded-lg bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 shadow">
                {{ session('success') }}
            </div>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="mx-4 sm:mx-6 lg:px-8 -mt-2">
            <div class="rounded-lg bg-red-50 border border-red-200 text-red-700 px-4 py-3 shadow">
                {{ session('error') }}
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <main class="px-4 sm:px-6 lg:px-8 pb-16">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

            <!-- Left: Form sections -->
            <div class="lg:col-span-8 space-y-6">

                {{-- BASIC INFORMATION --}}
                <section class="bg-white rounded-xl border shadow-sm overflow-hidden">
                    <div class="px-5 py-4 border-b">
                        <h2 class="text-sm font-semibold text-slate-800">Basic Information</h2>
                        <p class="text-xs text-slate-500">
                            Core identifiers and narrative summary used across CMIS.
                        </p>
                    </div>

                    <div class="p-5 space-y-4">

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="md:col-span-2">
                                <label class="block text-xs font-medium text-slate-600 mb-1">
                                    Advertising Matter Title <span class="text-rose-600">*</span>
                                </label>
                                <input type="text"
                                       wire:model.live="advertising_matter"
                                       class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500"
                                       placeholder="e.g. Pacific Breeze Soft Drink TVC">
                                @error('advertising_matter') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div class="space-y-1">
                                <label class="block text-xs font-medium text-slate-600">Auto-slug</label>
                                <label class="inline-flex items-center text-xs">
                                    <input type="checkbox" wire:model.live="autoSlug" class="mr-2 rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                                    Generate from title
                                </label>
                                <div>
                                    <label class="block text-xs font-medium text-slate-600 mb-1">Slug <span class="text-rose-600">*</span></label>
                                    <input type="text"
                                           wire:model.live="slug"
                                           @disabled($autoSlug)
                                           class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 disabled:bg-slate-50 disabled:text-slate-500"
                                           placeholder="pacific-breeze-soft-drink-tvc">
                                    @error('slug') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                                    <p class="text-[11px] text-slate-500 mt-1">Used in URLs and references; must be unique.</p>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1">Description</label>
                            <textarea
                                wire:model.live="description"
                                rows="3"
                                class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500"
                                placeholder="Brief description of the advertisement, key visuals or scenes."></textarea>
                            @error('description') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                    </div>
                </section>

                {{-- CREATIVE & PRODUCTION --}}
                <section class="bg-white rounded-xl border shadow-sm overflow-hidden">
                    <div class="px-5 py-4 border-b">
                        <h2 class="text-sm font-semibold text-slate-800">Creative & Production</h2>
                        <p class="text-xs text-slate-500">
                            Main talent and production companies involved in this advertisement.
                        </p>
                    </div>

                    <div class="p-5 grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1">Main Actor / Actress</label>
                            <input type="text"
                                   wire:model.live="casts"
                                   class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500"
                                   placeholder="e.g. John Kila">
                            @error('casts') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1">Director</label>
                            <input type="text"
                                   wire:model.live="director"
                                   class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500"
                                   placeholder="e.g. Maria Sungi">
                            @error('director') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1">Producer</label>
                            <input type="text"
                                   wire:model.live="producer"
                                   class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500"
                                   placeholder="e.g. Ocean Wave Media">
                            @error('producer') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1">Production Company</label>
                            <input type="text"
                                   wire:model.live="production_company"
                                   class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500"
                                   placeholder="e.g. Island Vision Studios">
                            @error('production_company') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1">Client Company</label>
                            <input type="text"
                                   wire:model.live="client_company"
                                   class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500"
                                   placeholder="e.g. Pacific Breeze Beverages Ltd">
                            @error('client_company') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </section>

                {{-- METADATA --}}
                <section class="bg-white rounded-xl border shadow-sm overflow-hidden">
                    <div class="px-5 py-4 border-b">
                        <h2 class="text-sm font-semibold text-slate-800">Metadata</h2>
                        <p class="text-xs text-slate-500">
                            Timing, language, genre and promoted brand / product.
                        </p>
                    </div>

                    <div class="p-5 grid grid-cols-1 md:grid-cols-3 gap-4">

                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1">Release Year</label>
                            <input type="number"
                                   min="1980"
                                   max="{{ now()->year + 1 }}"
                                   wire:model.live="release_year"
                                   class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                            @error('release_year') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1">Duration (seconds)</label>
                            <input type="number"
                                   min="1"
                                   wire:model.live="duration"
                                   class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500"
                                   placeholder="e.g. 30">
                            @error('duration') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1">Genre</label>
                            <input type="text"
                                   wire:model.live="genre"
                                   class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500"
                                   placeholder="e.g. Commercial, PSA, Promotional">
                            @error('genre') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1">Language</label>
                            <input type="text"
                                   wire:model.live="language"
                                   class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500"
                                   placeholder="e.g. English, Tok Pisin">
                            @error('language') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="flex items-center mt-2">
                            <input type="checkbox"
                                   wire:model.live="has_subtitle"
                                   class="h-4 w-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                            <label class="ml-2 text-xs font-medium text-slate-700">
                                Advertisement has subtitles
                            </label>
                            @error('has_subtitle') <p class="text-xs text-rose-600 mt-1 ml-2">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1">Brand Promoted</label>
                            <input type="text"
                                   wire:model.live="brand_promoted"
                                   class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500"
                                   placeholder="e.g. Pacific Breeze">
                            @error('brand_promoted') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1">Product Promoted</label>
                            <input type="text"
                                   wire:model.live="product_promoted"
                                   class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500"
                                   placeholder="e.g. Carbonated Soft Drink">
                            @error('product_promoted') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="px-5 pb-5">
                        <label class="block text-xs font-medium text-slate-600 mb-1">Theme / Message</label>
                        <textarea rows="3"
                                  wire:model.live="theme"
                                  class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500"
                                  placeholder="Describe the main message, themes and classification-relevant content."></textarea>
                        @error('theme') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                        <p class="text-[11px] text-slate-500 mt-1">
                            Tip: include notes on violence, language, sexual content, drugs, gambling, etc.
                        </p>
                    </div>
                </section>

                {{-- ATTACHMENTS --}}
                <section class="bg-white rounded-xl border shadow-sm overflow-hidden">
                    <div class="px-5 py-4 border-b">
                        <h2 class="text-sm font-semibold text-slate-800">Attachments</h2>
                        <p class="text-xs text-slate-500">
                            Option A — One “Attachments” field. Upload media files submitted with this advertisement.
                        </p>
                    </div>

                    <div class="p-5 space-y-3">
                        <p class="text-xs text-slate-600">
                            Allowed formats:
                            <strong>JPG, PNG</strong> (images),
                            <strong>MP4</strong> (video),
                            <strong>PDF, DOCX</strong> (documents).
                            Max size: 50MB per file. Multiple files allowed.
                        </p>

                        <input type="file"
                               wire:model.live="poster_path"
                               multiple
                               accept=".jpg,.jpeg,.png,.mp4,.pdf,.doc,.docx,.mov,.m4v,.avi,.mkv"
                               class="block w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">

                        @error('poster_path.*') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror

                        {{-- Existing main file (if any) --}}
                        @if ($advertisement->poster_path ?? false)
                            <div class="mt-3 text-xs text-slate-600">
                                <p class="font-semibold mb-1">Current primary attachment:</p>
                                <p class="truncate bg-slate-50 border border-slate-200 rounded px-3 py-2">
                                    {{ $advertisement->poster_path }}
                                </p>
                                <p class="text-[11px] text-slate-500 mt-1">
                                    Uploading new files will replace this as the main stored file path.
                                </p>
                            </div>
                        @endif

                        {{-- New uploaded files preview --}}
                        @if ($poster_path)
                            <div class="mt-3 grid grid-cols-1 md:grid-cols-3 gap-3">
                                @foreach ($poster_path as $file)
                                    <div class="border rounded-lg p-2 text-xs bg-slate-50">
                                        <p class="font-semibold truncate">
                                            {{ $file->getClientOriginalName() }}
                                        </p>
                                        <p class="text-slate-500">
                                            {{ number_format($file->getSize() / 1024, 1) }} KB
                                        </p>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </section>

                {{-- Bottom Actions --}}
                <div class="bg-white rounded-xl border shadow-sm p-5">
                    <div class="flex justify-end gap-2">
                        <a href="{{ route('admin.classifications.advertisements') }}"
                           class="px-3 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-200 rounded-lg shadow-sm hover:bg-slate-50">
                            Cancel
                        </a>
                        <button type="button"
                                wire:click="save"
                                wire:loading.attr="disabled"
                                class="px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-lg shadow-sm hover:bg-blue-700 flex items-center">
                            <svg wire:loading wire:target="save" class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Update Advertisement
                        </button>
                    </div>
                </div>

            </div>

            <!-- Right: Preview & Tips -->
            <aside class="lg:col-span-4 space-y-6">

                {{-- Preview Card --}}
                <div class="bg-white rounded-xl border shadow-sm overflow-hidden">
                    <div class="px-5 py-4 border-b">
                        <h3 class="text-sm font-semibold text-slate-800">Advertisement Preview</h3>
                        <p class="text-xs text-slate-500">How this advertisement might appear in CMIS lists.</p>
                    </div>
                    <div class="p-5">
                        <div class="rounded-lg border bg-gradient-to-b from-slate-50 to-white p-4">
                            <div class="flex items-start justify-between">
                                <div class="min-w-0">
                                    <p class="text-sm font-semibold text-slate-900 truncate">
                                        {{ $advertising_matter ?: 'Advertisement title' }}
                                    </p>
                                    <p class="text-xs text-slate-500 truncate">
                                        {{ $brand_promoted ?: 'Brand' }} — {{ $product_promoted ?: 'Product' }}
                                    </p>
                                </div>
                                <span class="text-[10px] px-2 py-0.5 rounded-full bg-blue-50 text-blue-700 border border-blue-200">
                                    {{ $language ?: 'Language' }}
                                </span>
                            </div>

                            <div class="mt-3 flex flex-wrap gap-2">
                                @if($genre)
                                    <span class="text-[10px] px-2 py-0.5 rounded-full bg-indigo-50 text-indigo-700 border border-indigo-200">
                                        {{ $genre }}
                                    </span>
                                @endif
                                @if($release_year)
                                    <span class="text-[10px] px-2 py-0.5 rounded-full bg-slate-50 text-slate-700 border border-slate-200">
                                        Year: {{ $release_year }}
                                    </span>
                                @endif
                                @if($duration)
                                    <span class="text-[10px] px-2 py-0.5 rounded-full bg-slate-50 text-slate-700 border border-slate-200">
                                        Duration: {{ $duration }}s
                                    </span>
                                @endif
                                @if($has_subtitle)
                                    <span class="text-[10px] px-2 py-0.5 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200">
                                        Subtitled
                                    </span>
                                @endif
                            </div>

                            <p class="mt-3 text-xs text-slate-600 line-clamp-4">
                                {{ $theme ?: 'A short synopsis will help classification officers quickly understand the message and potential issues.' }}
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Tips --}}
                <div class="bg-white rounded-xl border shadow-sm overflow-hidden">
                    <div class="px-5 py-4 border-b">
                        <h3 class="text-sm font-semibold text-slate-800">Submission Tips</h3>
                    </div>
                    <div class="p-5 text-sm text-slate-600 space-y-2">
                        <p>• Clearly describe any sensitive content (violence, sexual content, language, substances, gambling, etc.).</p>
                        <p>• Ensure <strong>brand</strong> and <strong>product</strong> fields are specific and consistent with the materials.</p>
                        <p>• Keep <strong>slugs</strong> short, unique and readable.</p>
                        <p>• Attach at least one representative file (video, script, storyboard, or key visual) where available.</p>
                    </div>
                </div>

                {{-- Quick Save --}}
                <div class="bg-white rounded-xl border shadow-sm p-5">
                    <div class="flex items-center gap-2">
                        <a href="{{ route('admin.classifications.advertisements') }}"
                           class="px-3 py-2 text-sm rounded-lg border border-slate-200 hover:bg-slate-50">
                            Cancel
                        </a>
                        <button
                            wire:click="save"
                            wire:loading.attr="disabled"
                            class="ml-auto inline-flex items-center px-4 py-2 text-sm rounded-lg bg-blue-600 text-white hover:bg-blue-700 shadow disabled:opacity-50">
                            <svg wire:loading wire:target="save" class="animate-spin -ml-1 mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                            </svg>
                            Update Advertisement
                        </button>
                    </div>
                </div>

            </aside>
        </div>
    </main>
</div>

