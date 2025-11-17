{{-- resources/views/livewire/admin/classifications/video-game/view-video-game.blade.php --}}

<div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50">

    <!-- Page Header -->
    <header class="px-4 sm:px-6 lg:px-8 py-6">
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-2xl shadow-lg overflow-hidden">
            <div class="px-6 py-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <h1 class="text-2xl font-bold text-white">
                            Video Game Details
                        </h1>
                        <p class="text-blue-100 opacity-90 text-sm">
                            Full record for this video game as registered in CMIS.
                        </p>
                    </div>

                    <div class="flex items-center gap-2">
                        <a href="{{ route('admin.classifications.video-games') }}"
                           class="px-3 py-2 text-sm rounded-lg bg-white/10 text-white hover:bg-white/20 border border-white/20 transition">
                            Back to List
                        </a>

                        <a href="{{ route('admin.classifications.video-games.edit', $game->id) }}"
                           class="inline-flex items-center px-4 py-2 text-sm rounded-lg bg-white text-blue-700 hover:bg-blue-50 shadow">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Edit Game
                        </a>
                    </div>
                </div>

                <!-- Breadcrumb -->
                <nav class="mt-4 text-xs text-blue-100">
                    <ol class="flex items-center gap-2">
                        <li>
                            <a href="{{ route('admin.classifications.video-games') }}" class="hover:underline">
                                Video Games
                            </a>
                        </li>
                        <li>/</li>
                        <li class="text-white font-medium">
                            {{ $game->video_game_title }}
                        </li>
                    </ol>
                </nav>
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

    @if (session('error'))
        <div class="mx-4 sm:mx-6 lg:px-8 -mt-2">
            <div class="rounded-lg bg-red-50 border border-red-200 text-red-700 px-4 py-3 shadow">
                {{ session('error') }}
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <main class="px-4 sm:px-6 lg:px-8 pb-16">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

            <!-- Left: Core details -->
            <div class="lg:col-span-8 space-y-6">

                <!-- Overview -->
                <section class="bg-white rounded-xl border shadow-sm overflow-hidden">
                    <div class="px-5 py-4 border-b flex items-start justify-between gap-3">
                        <div>
                            <h2 class="text-sm font-semibold text-slate-800">Overview</h2>
                            <p class="text-xs text-slate-500">
                                Core identifiers and high-level info for this video game.
                            </p>
                        </div>
                        <div class="flex flex-wrap gap-2 justify-end">
                            @if($game->game_mode)
                                <span class="inline-flex items-center rounded-full bg-indigo-50 text-indigo-700 border border-indigo-200 px-2 py-0.5 text-[11px] font-medium">
                                    {{ $game->game_mode }}
                                </span>
                            @endif
                            @if($game->platform)
                                <span class="inline-flex items-center rounded-full bg-blue-50 text-blue-700 border border-blue-200 px-2 py-0.5 text-[11px] font-medium">
                                    {{ $game->platform }}
                                </span>
                            @endif
                            @if($game->has_subtitle)
                                <span class="inline-flex items-center rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200 px-2 py-0.5 text-[11px] font-medium">
                                    Subtitles Available
                                </span>
                            @else
                                <span class="inline-flex items-center rounded-full bg-slate-50 text-slate-600 border border-slate-200 px-2 py-0.5 text-[11px] font-medium">
                                    No Subtitles
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="p-5 space-y-4">
                        <div>
                            <h3 class="text-base font-semibold text-slate-900">
                                {{ $game->video_game_title }}
                            </h3>
                            @if($game->slug)
                                <p class="mt-1 text-xs text-slate-500">
                                    Slug:
                                    <span class="font-mono text-[11px] bg-slate-50 border border-slate-200 px-1.5 py-0.5 rounded">
                                        {{ $game->slug }}
                                    </span>
                                </p>
                            @endif
                        </div>

                        @if($game->release_year || $game->release_date)
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-sm text-slate-700">
                                @if($game->release_year)
                                    <div>
                                        <p class="text-xs font-medium text-slate-600 mb-1">Release Year</p>
                                        <p>{{ $game->release_year }}</p>
                                    </div>
                                @endif
                                @if($game->release_date)
                                    <div>
                                        <p class="text-xs font-medium text-slate-600 mb-1">Release Date</p>
                                        <p>{{ \Illuminate\Support\Carbon::parse($game->release_date)->format('d M Y') }}</p>
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>
                </section>

                <!-- Characters & Production -->
                <section class="bg-white rounded-xl border shadow-sm overflow-hidden">
                    <div class="px-5 py-4 border-b">
                        <h2 class="text-sm font-semibold text-slate-800">Characters & Production</h2>
                        <p class="text-xs text-slate-500">
                            Principal characters and organisations involved in the game.
                        </p>
                    </div>

                    <div class="p-5 grid grid-cols-1 md:grid-cols-2 gap-4">
                        @if($game->main_characters)
                            <div class="md:col-span-2">
                                <p class="text-xs font-medium text-slate-600 mb-1">Main Characters</p>
                                <p class="text-sm text-slate-800">
                                    {{ $game->main_characters }}
                                </p>
                            </div>
                        @endif

                        @if($game->developer)
                            <div>
                                <p class="text-xs font-medium text-slate-600 mb-1">Developer</p>
                                <p class="text-sm text-slate-800">
                                    {{ $game->developer }}
                                </p>
                            </div>
                        @endif

                        @if($game->publisher)
                            <div>
                                <p class="text-xs font-medium text-slate-600 mb-1">Publisher</p>
                                <p class="text-sm text-slate-800">
                                    {{ $game->publisher }}
                                </p>
                            </div>
                        @endif
                    </div>
                </section>

                <!-- Content Metadata -->
                <section class="bg-white rounded-xl border shadow-sm overflow-hidden">
                    <div class="px-5 py-4 border-b">
                        <h2 class="text-sm font-semibold text-slate-800">Content Metadata</h2>
                        <p class="text-xs text-slate-500">
                            Technical and descriptive information used for classification and filters.
                        </p>
                    </div>

                    <div class="p-5 grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <p class="text-xs font-medium text-slate-600 mb-1">Genre</p>
                            <p class="text-sm text-slate-800">
                                {{ $game->genre ?: '—' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs font-medium text-slate-600 mb-1">Platform</p>
                            <p class="text-sm text-slate-800">
                                {{ $game->platform ?: '—' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs font-medium text-slate-600 mb-1">Language</p>
                            <p class="text-sm text-slate-800">
                                {{ $game->language ?: '—' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs font-medium text-slate-600 mb-1">Average Playtime</p>
                            <p class="text-sm text-slate-800">
                                {{ $game->average_playtime ? $game->average_playtime . ' hrs' : '—' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs font-medium text-slate-600 mb-1">Game Mode</p>
                            <p class="text-sm text-slate-800">
                                {{ $game->game_mode ?: '—' }}
                            </p>
                        </div>
                    </div>
                </section>

            </div>

            <!-- Right: Cover art & metadata -->
            <aside class="lg:col-span-4 space-y-6">

                <!-- Cover Art -->
                <section class="bg-white rounded-xl border shadow-sm overflow-hidden">
                    <div class="px-5 py-4 border-b">
                        <h3 class="text-sm font-semibold text-slate-800">Cover Art</h3>
                        <p class="text-xs text-slate-500">
                            Primary artwork used to visually identify this game.
                        </p>
                    </div>
                    <div class="p-5">
                        @if($game->cover_art_path)
                            <div class="rounded-lg border border-slate-200 overflow-hidden bg-slate-50">
                                <img src="{{ asset('storage/' . ltrim($game->cover_art_path, '/')) }}"
                                     alt="Cover art for {{ $game->video_game_title }}"
                                     class="w-full h-64 object-cover">
                            </div>
                            <p class="mt-2 text-[11px] text-slate-500 break-all">
                                Stored path:
                                <span class="font-mono">{{ $game->cover_art_path }}</span>
                            </p>
                        @else
                            <p class="text-xs text-slate-500">
                                No cover art has been uploaded for this video game.
                            </p>
                        @endif
                    </div>
                </section>

                <!-- Record Metadata -->
                <section class="bg-white rounded-xl border shadow-sm overflow-hidden">
                    <div class="px-5 py-4 border-b">
                        <h3 class="text-sm font-semibold text-slate-800">Record Metadata</h3>
                        <p class="text-xs text-slate-500">
                            System tracking information about when this game was registered or updated.
                        </p>
                    </div>
                    <div class="p-5 space-y-2 text-xs text-slate-600">
                        {{-- If you later add user_id + relation, you can replace "Unknown User" --}}
                        <div class="flex items-center justify-between">
                            <span class="font-medium text-slate-700">Created by</span>
                            <span>
                                {{ optional($game->user)->name ?? 'Unknown User' }}
                            </span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="font-medium text-slate-700">Created at</span>
                            <span>
                                {{ optional($game->created_at)->format('d M Y, H:i') ?? '—' }}
                            </span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="font-medium text-slate-700">Last updated</span>
                            <span>
                                {{ optional($game->updated_at)->format('d M Y, H:i') ?? '—' }}
                            </span>
                        </div>
                    </div>
                </section>

                <!-- Quick actions -->
                <section class="bg-white rounded-xl border shadow-sm p-5">
                    <div class="flex items-center gap-2">
                        <a href="{{ route('admin.classifications.video-games') }}"
                           class="px-3 py-2 text-sm rounded-lg border border-slate-200 hover:bg-slate-50">
                            Back to List
                        </a>
                        <a href="{{ route('admin.classifications.video-games.edit', $game->id) }}"
                           class="ml-auto inline-flex items-center px-4 py-2 text-sm rounded-lg bg-blue-600 text-white hover:bg-blue-700 shadow">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Edit Game
                        </a>
                    </div>
                </section>

            </aside>
        </div>
    </main>
</div>
