<div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50 p-6">

    <!-- Notifications -->
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

    <!-- Form -->
    <div class="bg-white rounded-xl shadow p-6 space-y-8">

        <!-- Basic Info -->
        <div>
            <h3 class="text-lg font-semibold text-gray-800 mb-2">Basic Information</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <!-- Advertising Matter Title -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Advertising Matter Title *
                    </label>
                    <input type="text" wire:model.live="advertising_matter"
                           class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500"
                           placeholder="e.g. Pacific Gold Promo Ad">
                    @error('advertising_matter') <p class="text-xs text-red-600">{{ $message }}</p> @enderror
                </div>

                <!-- Auto-slug + slug -->
                <div class="space-y-1">
                    <label class="block text-sm font-medium text-gray-700">Auto-slug</label>
                    <label class="inline-flex items-center text-xs">
                        <input type="checkbox" wire:model.live="autoSlug" class="mr-2">
                        Generate from title
                    </label>

                    <input type="text" wire:model.live="slug" @disabled($this->autoSlug)
                           class="w-full text-sm border rounded-lg px-3 py-2 disabled:bg-gray-100"
                           placeholder="pacific-gold-promo-ad">
                    @error('slug') <p class="text-xs text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Description -->
            <div class="mt-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea wire:model.live="description" rows="3"
                          class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500"
                          placeholder="Brief description of the advert..."></textarea>
                @error('description') <p class="text-xs text-red-600">{{ $message }}</p> @enderror
            </div>
        </div>

        <!-- Creative Team -->
        <div>
            <h3 class="text-lg font-semibold text-gray-800 mb-2">Creative & Production</h3>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Main Actor/Actress</label>
                    <input type="text" wire:model.live="main_actor_actress"
                           class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                    @error('main_actor_actress') <p class="text-xs text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Director</label>
                    <input type="text" wire:model.live="director"
                           class="w-full text-sm border rounded-lg px-3 py-2">
                    @error('director') <p class="text-xs text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Producer</label>
                    <input type="text" wire:model.live="producer"
                           class="w-full text-sm border rounded-lg px-3 py-2">
                    @error('producer') <p class="text-xs text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Production Company</label>
                    <input type="text" wire:model.live="production_company"
                           class="w-full text-sm border rounded-lg px-3 py-2">
                    @error('production_company') <p class="text-xs text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Client Company</label>
                    <input type="text" wire:model.live="client_company"
                           class="w-full text-sm border rounded-lg px-3 py-2">
                    @error('client_company') <p class="text-xs text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        <!-- Additional Metadata -->
        <div>
            <h3 class="text-lg font-semibold text-gray-800 mb-2">Metadata</h3>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Release Year</label>
                    <input type="number" min="1900" max="{{ now()->year + 1 }}"
                           wire:model.live="release_year"
                           class="w-full text-sm border rounded-lg px-3 py-2">
                    @error('release_year') <p class="text-xs text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Duration (seconds)</label>
                    <input type="number" min="1" wire:model.live="duration"
                           class="w-full text-sm border rounded-lg px-3 py-2">
                    @error('duration') <p class="text-xs text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Genre</label>
                    <input type="text" wire:model.live="genre"
                           class="w-full text-sm border rounded-lg px-3 py-2">
                    @error('genre') <p class="text-xs text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Language</label>
                    <input type="text" wire:model.live="language"
                           class="w-full text-sm border rounded-lg px-3 py-2">
                    @error('language') <p class="text-xs text-red-600">{{ $message }}</p> @enderror
                </div>

                <!-- Has Subtitle -->
                <div class="flex items-center">
                    <input type="checkbox" wire:model.live="has_subtitle"
                           class="h-4 w-4 text-blue-600 border-gray-300 rounded">
                    <label class="ml-2 text-sm text-gray-700">Has Subtitles</label>
                    @error('has_subtitle') <p class="text-xs text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Brand Promoted</label>
                    <input type="text" wire:model.live="brand_promoted"
                           class="w-full text-sm border rounded-lg px-3 py-2">
                    @error('brand_promoted') <p class="text-xs text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Product Promoted</label>
                    <input type="text" wire:model.live="product_promoted"
                           class="w-full text-sm border rounded-lg px-3 py-2">
                    @error('product_promoted') <p class="text-xs text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Theme -->
            <div class="mt-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Theme / Message</label>
                <textarea rows="3" wire:model.live="theme"
                          class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500"
                          placeholder="Describe the main message or classification factors..."></textarea>
                @error('theme') <p class="text-xs text-red-600">{{ $message }}</p> @enderror
            </div>
        </div>

        <!-- Attachments -->
        <div>
            <h3 class="text-lg font-semibold text-gray-800 mb-2">Attachments</h3>
            <p class="text-xs text-gray-500 mb-2">
                Allowed: <strong>JPG, PNG, MP4, PDF, DOCX</strong> — Multiple files allowed.
            </p>

            <input type="file"
                   wire:model.live="poster_path"
                   multiple
                   accept=".jpg,.jpeg,.png,.mp4,.pdf,.doc,.docx"
                   class="w-full border rounded-lg p-2 text-sm">

            @error('poster_path.*') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror

            <!-- Preview -->
            @if ($poster_path)
                <div class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-4">
                    @foreach ($poster_path as $file)
                        <div class="border rounded-lg p-2 text-xs bg-gray-50">
                            <strong>{{ $file->getClientOriginalName() }}</strong><br>
                            <span class="text-gray-500">{{ $file->getSize() }} bytes</span>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Actions -->
        <div class="flex justify-end gap-2 pt-4 border-t">
            <a href="{{ url()->previous() }}"
               class="px-4 py-2 text-sm rounded-lg border border-gray-300 bg-white hover:bg-gray-50">
                Cancel
            </a>

            <button wire:click="save"
                    wire:loading.attr="disabled"
                    class="px-4 py-2 text-sm rounded-lg bg-blue-600 text-white hover:bg-blue-700 shadow">
                Save Advertisement
            </button>
        </div>

    </div>
</div>
