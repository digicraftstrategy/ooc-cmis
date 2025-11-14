<div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50">
    <!-- Page Header -->
    <header class="px-4 sm:px-6 lg:px-8 py-6">
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-2xl shadow-lg overflow-hidden">
            <div class="px-6 py-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <h1 class="text-2xl font-bold text-white">Create Advertisement</h1>
                        <p class="text-blue-100 opacity-90 text-sm">
                            Register a new advertisement matter for classification.
                        </p>
                    </div>

                    <div class="flex items-center gap-2">
                        <a href="{{ url()->previous() }}"
                           class="px-3 py-2 text-sm rounded-lg bg-white/10 text-white hover:bg-white/20 border border-white/20 transition">
                            Back
                        </a>

                        <button wire:click="save"
                                wire:loading.attr="disabled"
                                class="inline-flex items-center px-4 py-2 text-sm rounded-lg bg-white text-blue-700 hover:bg-blue-50 shadow disabled:opacity-50">
                            <svg wire:loading wire:target="save" class="animate-spin -ml-1 mr-2 h-4 w-4"
                                 xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10"
                                        stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                      d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                            </svg>
                            Save Advertisement
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Notifications -->
    @if (session()->has('success'))
        <div class="mx-4 sm:mx-6 lg:mx-8 -mt-2">
            <div class="rounded-lg bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 shadow">
                {{ session('success') }}
            </div>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="mx-4 sm:mx-6 lg:mx-8 mt-2">
            <div class="rounded-lg bg-red-50 border border-red-200 text-red-700 px-4 py-3 shadow">
                {{ session('error') }}
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <main class="px-4 sm:px-6 lg:px-8 pb-16 mt-4">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

            <!-- Left: Form sections -->
            <div class="lg:col-span-8 space-y-6">

                <!-- Basic Information -->
                <section class="bg-white rounded-xl border shadow-sm overflow-hidden">
                    <div class="px-5 py-4 border-b">
                        <h3 class="text-sm font-semibold text-slate-800">Basic Information</h3>
                        <p class="text-xs text-slate-500">Core details used to identify this advertisement matter.</p>
                    </div>

                    <div class="p-5 space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Advertising Matter Title -->
                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1">
                                    Advertising Matter Title <span class="text-rose-600">*</span>
                                </label>
                                <input type="text" wire:model.live="advertising_matter"
                                       class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500"
                                       placeholder="e.g. Pacific Gold Promo Ad">
                                @error('advertising_matter') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                            </div>

                            <!-- Auto-slug + slug -->
                            <div class="space-y-2">
                                <label class="block text-xs font-medium text-slate-600">Auto-slug</label>
                                <label class="inline-flex items-center text-xs">
                                    <input type="checkbox" wire:model.live="autoSlug" class="mr-2">
                                    Generate from title
                                </label>

                                <div>
                                    <label class="block text-xs font-medium text-slate-600 mb-1">Slug <span class="text-rose-600">*</span></label>
                                    <input type="text" wire:model.live="slug" @disabled($this->autoSlug)
                                           class="w-full text-sm border rounded-lg px-3 py-2 disabled:bg-slate-50 disabled:text-slate-500"
                                           placeholder="pacific-gold-promo-ad">
                                    @error('slug') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                                    <p class="text-[11px] text-slate-500 mt-1">Used in URLs and lookups. Must be unique.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Description -->
                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1">Description</label>
                            <textarea wire:model.live="description" rows="3"
                                      class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500"
                                      placeholder="Brief description of the advert..."></textarea>
                            @error('description') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </section>

                <!-- Creative & Production -->
                <section class="bg-white rounded-xl border shadow-sm overflow-hidden">
                    <div class="px-5 py-4 border-b">
                        <h3 class="text-sm font-semibold text-slate-800">Creative & Production</h3>
                        <p class="text-xs text-slate-500">Key people and organisations involved in this advertisement.</p>
                    </div>

                    <div class="p-5 grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1">Main Actor/Actress</label>
                            <input type="text" wire:model.live="casts"
                                   class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                            @error('casts') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1">Director</label>
                            <input type="text" wire:model.live="director"
                                   class="w-full text-sm border rounded-lg px-3 py-2">
                            @error('director') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1">Producer</label>
                            <input type="text" wire:model.live="producer"
                                   class="w-full text-sm border rounded-lg px-3 py-2">
                            @error('producer') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1">Production Company</label>
                            <input type="text" wire:model.live="production_company"
                                   class="w-full text-sm border rounded-lg px-3 py-2">
                            @error('production_company') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1">Client Company</label>
                            <input type="text" wire:model.live="client_company"
                                   class="w-full text-sm border rounded-lg px-3 py-2">
                            @error('client_company') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </section>

                <!-- Metadata & Theme -->
                <section class="bg-white rounded-xl border shadow-sm overflow-hidden">
                    <div class="px-5 py-4 border-b">
                        <h3 class="text-sm font-semibold text-slate-800">Metadata & Message</h3>
                        <p class="text-xs text-slate-500">Technical details and classification-relevant content.</p>
                    </div>

                    <div class="p-5 space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1">Release Year</label>
                                <input type="number" min="1900" max="{{ now()->year + 1 }}"
                                       wire:model.live="release_year"
                                       class="w-full text-sm border rounded-lg px-3 py-2">
                                @error('release_year') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1">Duration (seconds)</label>
                                <input type="number" min="1" wire:model.live="duration"
                                       class="w-full text-sm border rounded-lg px-3 py-2">
                                @error('duration') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1">Genre</label>
                                <input type="text" wire:model.live="genre"
                                       class="w-full text-sm border rounded-lg px-3 py-2">
                                @error('genre') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1">Language</label>
                                <input type="text" wire:model.live="language"
                                       class="w-full text-sm border rounded-lg px-3 py-2">
                                @error('language') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                            </div>

                            <!-- Has Subtitle -->
                            <div class="flex items-center">
                                <input type="checkbox" wire:model.live="has_subtitle"
                                       class="h-4 w-4 text-blue-600 border-gray-300 rounded">
                                <label class="ml-2 text-xs font-medium text-slate-700">Has Subtitles</label>
                                @error('has_subtitle') <p class="text-xs text-rose-600 mt-1 ml-2">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1">Brand Promoted</label>
                                <input type="text" wire:model.live="brand_promoted"
                                       class="w-full text-sm border rounded-lg px-3 py-2">
                                @error('brand_promoted') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1">Product Promoted</label>
                                <input type="text" wire:model.live="product_promoted"
                                       class="w-full text-sm border rounded-lg px-3 py-2">
                                @error('product_promoted') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <!-- Theme -->
                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1">Theme / Message</label>
                            <textarea rows="3" wire:model.live="theme"
                                      class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500"
                                      placeholder="Describe the main message or classification factors..."></textarea>
                            @error('theme') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                            <p class="text-[11px] text-slate-500 mt-1">
                                Tip: include content notes (nudity, violence, substances, language, political messaging, etc.).
                            </p>
                        </div>
                    </div>
                </section>

                <!-- Attachments -->
                <section class="bg-white rounded-xl border shadow-sm overflow-hidden">
                    <div class="px-5 py-4 border-b">
                        <h3 class="text-sm font-semibold text-slate-800">Attachments</h3>
                        <p class="text-xs text-slate-500">
                            Upload reference materials for this advertisement (video cut, script, storyboard, etc.).
                        </p>
                    </div>

                    <div class="p-5 space-y-3">
                        <p class="text-xs text-slate-500">
                            Allowed: <strong>JPG, PNG, MP4, PDF, DOCX</strong> — Multiple files allowed.
                        </p>

                        <input type="file"
                               wire:model.live="poster_path"
                               multiple
                               accept=".jpg,.jpeg,.png,.mp4,.pdf,.doc,.docx"
                               class="w-full border rounded-lg p-2 text-sm focus:ring-2 focus:ring-blue-500">

                        @error('poster_path.*') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror

                        <!-- Preview -->
                        @if ($poster_path)
                            <div class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-4">
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

            </div>

            <!-- Right: Preview & Tips & Sticky actions -->
            <aside class="lg:col-span-4 space-y-6">

                <!-- Live Preview Card -->
                <div class="bg-white rounded-xl border shadow-sm overflow-hidden">
                    <div class="px-5 py-4 border-b">
                        <h3 class="text-sm font-semibold text-slate-800">Preview Card</h3>
                        <p class="text-xs text-slate-500">How this advertisement might appear in lists.</p>
                    </div>
                    <div class="p-5">
                        <div class="rounded-lg border bg-gradient-to-b from-slate-50 to-white p-4">
                            <div class="flex items-start justify-between">
                                <div class="min-w-0">
                                    <p class="text-sm font-semibold text-slate-900 truncate">
                                        {{ $advertising_matter ?: 'Advertising matter title' }}
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
                                        {{ $duration }}s
                                    </span>
                                @endif

                                @if($has_subtitle)
                                    <span class="text-[10px] px-2 py-0.5 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200">
                                        Subtitles
                                    </span>
                                @endif
                            </div>

                            <p class="mt-3 text-xs text-slate-600 line-clamp-3">
                                {{ $theme ?: 'A short description of the message and content helps officers assess classification quickly.' }}
                            </p>

                            @if($client_company || $production_company)
                                <p class="mt-2 text-[11px] text-slate-500">
                                    {{ $client_company ?: 'Client company' }} @if($production_company) • Produced by {{ $production_company }} @endif
                                </p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Submission Tips -->
                <div class="bg-white rounded-xl border shadow-sm overflow-hidden">
                    <div class="px-5 py-4 border-b">
                        <h3 class="text-sm font-semibold text-slate-800">Submission Tips</h3>
                    </div>
                    <div class="p-5 text-sm text-slate-600 space-y-2">
                        <p>• Clearly describe any <strong>sensitive content</strong>: nudity, violence, language, substances, or political messaging.</p>
                        <p>• Ensure the <strong>brand</strong> and <strong>product promoted</strong> match the client company’s application.</p>
                        <p>• Use a short but descriptive <strong>title</strong> and unique <strong>slug</strong> for easier search.</p>
                        <p>• Attach the best available <strong>video cut / script / storyboard</strong> to support classification.</p>
                    </div>
                </div>

                <!-- Sticky Save / Actions -->
                <div class="bg-white rounded-xl border shadow-sm p-5">
                    <div class="flex items-center gap-2">
                        <a href="{{ url()->previous() }}"
                           class="px-3 py-2 text-sm rounded-lg border border-slate-200 hover:bg-slate-50">
                            Cancel
                        </a>

                        <button wire:click="save"
                                wire:loading.attr="disabled"
                                class="ml-auto inline-flex items-center px-4 py-2 text-sm rounded-lg bg-blue-600 text-white hover:bg-blue-700 shadow disabled:opacity-50">
                            <svg wire:loading wire:target="save" class="animate-spin -ml-1 mr-2 h-4 w-4"
                                 xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10"
                                        stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                      d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                            </svg>
                            Save Advertisement
                        </button>
                    </div>
                </div>

            </aside>
        </div>
    </main>
</div>
