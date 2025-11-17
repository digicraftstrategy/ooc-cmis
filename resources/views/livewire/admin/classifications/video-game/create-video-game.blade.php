<div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50">

    <!-- Header -->
    <header class="px-4 sm:px-6 lg:px-8 py-6">
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-2xl shadow-lg overflow-hidden">
            <div class="px-6 py-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <h1 class="text-2xl font-bold text-white">Create Video Game</h1>
                        <p class="text-blue-100 opacity-90 text-sm">
                            Register a new video game so officers can classify and rate.
                        </p>
                    </div>

                    <div class="flex items-center gap-2">
                        <a href="{{ route('admin.classifications.video-games') }}"
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
                            Save Game
                        </button>
                    </div>
                </div>
            </div>
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

    <!-- Main -->
    <main class="px-4 sm:px-6 lg:px-8 pb-16">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

            <!-- Left: form -->
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
                                Game Title <span class="text-rose-600">*</span>
                            </label>
                            <input type="text" wire:model.live="video_game_title"
                                   class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500"
                                   placeholder="e.g. Legends of the Highlands">
                            @error('video_game_title') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
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
                                       class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 disabled:bg-slate-50"
                                       placeholder="legends-of-the-highlands">
                                @error('slug') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                                <p class="text-[11px] text-slate-500 mt-1">Used in URLs and lookups. Must be unique.</p>
                            </div>
                        </div>

                        <div class="md:col-span-3">
                            <label class="block text-xs font-medium text-slate-600 mb-1">Main Characters</label>
                            <textarea rows="2" wire:model.live="main_characters"
                                      class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500"
                                      placeholder="List key playable characters, separated by commas."></textarea>
                            @error('main_characters') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </section>

                <!-- Production & Meta -->
                <section class="bg-white rounded-xl border shadow-sm overflow-hidden">
                    <div class="px-5 py-4 border-b">
                        <h2 class="text-sm font-semibold text-slate-800">Production & Metadata</h2>
                        <p class="text-xs text-slate-500">Studios, platforms and key technical details.</p>
                    </div>

                    <div class="p-5 grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1">Developer</label>
                            <input type="text" wire:model.live="developer"
                                   class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                            @error('developer') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1">Publisher</label>
                            <input type="text" wire:model.live="publisher"
                                   class="w-full text-sm border rounded-lg px-3 py-2">
                            @error('publisher') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1">Platform</label>
                            <input type="text" wire:model.live="platform"
                                   class="w-full text-sm border rounded-lg px-3 py-2"
                                   placeholder="e.g. PC, PS5, Xbox, Switch">
                            @error('platform') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1">Genre</label>
                            <input type="text" wire:model.live="genre"
                                   class="w-full text-sm border rounded-lg px-3 py-2"
                                   placeholder="e.g. Action RPG, Puzzle">
                            @error('genre') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1">Release Year</label>
                            <input type="number" min="1980" max="{{ now()->year + 1 }}"
                                   wire:model.live="release_year"
                                   class="w-full text-sm border rounded-lg px-3 py-2">
                            @error('release_year') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1">Release Date</label>
                            <input type="date" wire:model.live="release_date"
                                   class="w-full text-sm border rounded-lg px-3 py-2">
                            @error('release_date') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1">Average Playtime (hours)</label>
                            <input type="number" min="0" wire:model.live="average_playtime"
                                   class="w-full text-sm border rounded-lg px-3 py-2">
                            @error('average_playtime') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1">Game Mode</label>
                            <select wire:model.live="game_mode"
                                    class="w-full text-sm border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                                <option value="">-- Select --</option>
                                @foreach($gameModes as $mode)
                                    <option value="{{ $mode }}">{{ $mode }}</option>
                                @endforeach
                            </select>
                            @error('game_mode') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1">Language</label>
                            <input type="text" wire:model.live="language"
                                   class="w-full text-sm border rounded-lg px-3 py-2"
                                   placeholder="e.g. English">
                            @error('language') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="flex items-center mt-2">
                            <input type="checkbox" wire:model.live="has_subtitle"
                                   class="h-4 w-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                            <label class="ml-2 text-xs font-medium text-slate-700">
                                Game has subtitles
                            </label>
                        </div>
                    </div>
                </section>

                <!-- Attachments -->
                <section class="bg-white rounded-xl border shadow-sm overflow-hidden">
                    <div class="px-5 py-4 border-b">
                        <h2 class="text-sm font-semibold text-slate-800">Attachments</h2>
                        <p class="text-xs text-slate-500">
                            Artwork, screenshots or documentation. Multiple files allowed.
                        </p>
                    </div>

                    <div class="p-5">
                        <input type="file"
                               wire:model.live="cover_art_path"
                               multiple
                               accept=".jpg,.jpeg,.png,.gif,.webp,.mp4,.mov,.m4v,.avi,.mkv,.pdf,.doc,.docx"
                               class="w-full border rounded-lg p-2 text-sm">
                        @error('cover_art_path.*') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror

                        @if ($cover_art_path)
                            <div class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-4">
                                @foreach ($cover_art_path as $file)
                                    <div class="border rounded-lg p-2 text-xs bg-gray-50">
                                        <strong>{{ $file->getClientOriginalName() }}</strong><br>
                                        <span class="text-gray-500">{{ $file->getSize() }} bytes</span>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </section>

                <!-- Bottom actions -->
                <div class="bg-white rounded-xl border shadow-sm p-5">
                    <div class="flex justify-end gap-2">
                        <a href="{{ route('admin.classifications.video-games') }}"
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
                            Create Video Game
                        </button>
                    </div>
                </div>
            </div>

            <!-- Right: preview & tips -->
            <aside class="lg:col-span-4 space-y-6">
                <!-- Preview -->
                <div class="bg-white rounded-xl border shadow-sm overflow-hidden">
                    <div class="px-5 py-4 border-b">
                        <h3 class="text-sm font-semibold text-slate-800">Preview Card</h3>
                        <p class="text-xs text-slate-500">How this game might appear in lists.</p>
                    </div>
                    <div class="p-5">
                        <div class="rounded-lg border bg-gradient-to-b from-slate-50 to-white p-4">
                            <div class="flex items-start justify-between">
                                <div class="min-w-0">
                                    <p class="text-sm font-semibold text-slate-900 truncate">
                                        {{ $video_game_title ?: 'Game title' }}
                                    </p>
                                    <p class="text-xs text-slate-500 truncate">
                                        {{ $platform ?: 'Platform' }} · {{ $genre ?: 'Genre' }}
                                    </p>
                                </div>
                                <span class="text-[10px] px-2 py-0.5 rounded-full bg-blue-50 text-blue-700 border border-blue-200">
                                    {{ $game_mode ?: 'Mode' }}
                                </span>
                            </div>
                            <div class="mt-3 flex flex-wrap gap-2">
                                @if($release_year)
                                    <span class="text-[10px] px-2 py-0.5 rounded-full bg-slate-50 text-slate-700 border border-slate-200">
                                        {{ $release_year }}
                                    </span>
                                @endif
                                @if($language)
                                    <span class="text-[10px] px-2 py-0.5 rounded-full bg-slate-50 text-slate-700 border border-slate-200">
                                        {{ $language }}
                                    </span>
                                @endif
                                @if($average_playtime)
                                    <span class="text-[10px] px-2 py-0.5 rounded-full bg-slate-50 text-slate-700 border border-slate-200">
                                        ~{{ $average_playtime }}h
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tips -->
                <div class="bg-white rounded-xl border shadow-sm overflow-hidden">
                    <div class="px-5 py-4 border-b">
                        <h3 class="text-sm font-semibold text-slate-800">Submission Tips</h3>
                    </div>
                    <div class="p-5 text-sm text-slate-600 space-y-2">
                        <p>• Provide clear <strong>platform</strong>, <strong>genre</strong> and <strong>mode</strong> to help filtering.</p>
                        <p>• Use a readable <strong>slug</strong>; keep Auto-slug on unless you need a custom one.</p>
                        <p>• Attach at least one <strong>cover art</strong> or screenshot if available.</p>
                    </div>
                </div>
            </aside>

        </div>
    </main>
</div>

