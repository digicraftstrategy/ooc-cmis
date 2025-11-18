<div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50 py-6 px-4 sm:px-6 lg:px-8">
    <livewire:admin.classifications.films-publication-navigation />

    <!-- Header -->
    <div class="mb-6">
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-xl shadow-lg overflow-hidden">
            <div class="px-6 py-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <h1 class="text-xl md:text-2xl font-bold text-white mb-1">
                            Manage Video Games
                        </h1>
                        <p class="text-blue-100 opacity-90 text-sm">
                            Manage all registered video games in the system.
                        </p>
                    </div>

                    <a href="{{ route('admin.classifications.video-games.create') }}"
                       class="px-4 py-2 bg-white text-blue-600 hover:bg-blue-50 border-transparent shadow font-medium rounded-lg transition-all duration-200 flex items-center text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                  d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                  clip-rule="evenodd" />
                        </svg>
                        Add New Video Game
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Flash messages -->
    @if (session()->has('success'))
        <div class="mb-4">
            <div class="rounded-lg bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 shadow-sm">
                {{ session('success') }}
            </div>
        </div>
    @endif
    @if (session()->has('error'))
        <div class="mb-4">
            <div class="rounded-lg bg-red-50 border border-red-200 text-red-700 px-4 py-3 shadow-sm">
                {{ session('error') }}
            </div>
        </div>
    @endif

    <!-- Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-white p-4 rounded-lg shadow">
            <p class="text-sm font-medium text-gray-500">Total Games</p>
            <p class="text-2xl font-bold text-gray-900">{{ $stats['total'] }}</p>
        </div>
        <div class="bg-white p-4 rounded-lg shadow">
            <p class="text-sm font-medium text-gray-500">Classified</p>
            <p class="text-2xl font-bold text-gray-900">{{ $stats['classified'] }}</p>
        </div>
        <div class="bg-white p-4 rounded-lg shadow">
            <p class="text-sm font-medium text-gray-500">Unclassified</p>
            <p class="text-2xl font-bold text-gray-900">{{ $stats['unclassified'] }}</p>
        </div>
        <div class="bg-white p-4 rounded-lg shadow">
            <p class="text-sm font-medium text-gray-500">Most Recent</p>
            <p class="text-lg font-semibold text-gray-900 truncate">
                {{ $stats['recent']?->video_game_title ?? 'N/A' }}
            </p>
            @if($stats['recent'])
                <p class="text-xs text-gray-500">{{ $stats['recent']->created_at->format('M d, Y') }}</p>
            @endif
        </div>
    </div>

    <!-- Search -->
    <div class="mb-4 bg-white rounded-lg shadow-sm p-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
            <div class="relative md:col-span-2">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <input
                    wire:model.live.debounce.300ms="search"
                    type="text"
                    class="block w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm"
                    placeholder="Search games, platforms, developers..."
                >
            </div>
            <div class="flex items-center justify-end">
                <span class="text-sm text-gray-500">
                    {{ $games->total() }} games found
                </span>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gradient-to-r from-blue-50 to-indigo-50">
                <tr>
                    <th class="px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider text-center">#</th>
                    <th class="px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider cursor-pointer"
                        wire:click="sortBy('video_game_title')">
                        <div class="flex items-center space-x-1">
                            <span>Title</span>
                            @if($sortField === 'video_game_title')
                                <span class="text-xs">{!! $sortDirection === 'asc' ? '↑' : '↓' !!}</span>
                            @endif
                        </div>
                    </th>
                    <th class="px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider">Platform</th>
                    <th class="px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider">Genre</th>
                    <th class="px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider">Mode</th>
                    <th class="px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider">Developer</th>
                    <th class="px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider">Release Year</th>
                    <th class="px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider">
                        Classification
                    </th>
                    <th class="px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider">Actions</th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                @forelse($games as $game)
                    <tr class="hover:bg-gray-50 transition-colors duration-150">
                        <td class="px-3 py-2 text-sm text-center">
                            {{ $loop->iteration + ($games->currentPage() - 1) * $games->perPage() }}
                        </td>
                        <td class="px-3 py-2">
                            <a href="{{ route('admin.classifications.video-games.view', $game->slug) }}"
                               class="text-sm font-semibold text-gray-900 hover:text-blue-700">
                                {{ $game->video_game_title }}
                            </a>
                            <p class="text-xs text-gray-500">
                                {{ $game->platform ?? '—' }}
                            </p>
                        </td>
                        <td class="px-3 py-2 text-sm text-gray-700">{{ $game->platform ?? '—' }}</td>
                        <td class="px-3 py-2 text-sm text-gray-700">{{ $game->genre ?? '—' }}</td>
                        <td class="px-3 py-2 text-sm text-gray-700">{{ $game->game_mode ?? '—' }}</td>
                        <td class="px-3 py-2 text-sm text-gray-700 truncate max-w-xs" title="{{ $game->developer }}">
                            {{ $game->developer ?? '—' }}
                        </td>
                        <td class="px-3 py-2 text-sm text-gray-700">{{ $game->release_year ?? '—' }}</td>
                        <!-- Classification status -->
                        <td class="px-3 py-2 text-sm text-gray-700">
                            @if($game->has_classified)
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">
                                    Classified
                                </span>
                            @else
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-amber-100 text-amber-800">
                                    Unclassified
                                </span>
                            @endif
                        </td>
                        <td class="px-3 py-2 text-sm text-right">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('admin.classifications.video-games.view', $game->slug) }}"
                                   class="px-2 py-1 text-xs rounded-lg border border-slate-200 hover:bg-blue-50 hover:text-blue-700">
                                    View
                                </a>
                                <a href="{{ route('admin.classifications.video-games.edit', $game->id) }}"
                                   class="px-2 py-1 text-xs rounded-lg border border-slate-200 hover:bg-green-50 hover:text-green-700">
                                    Edit
                                </a>
                                <button
                                    wire:click="openDeleteModal({{ $game->id }})"
                                    class="px-2 py-1 text-xs rounded-lg border border-slate-200 hover:bg-red-50 hover:text-red-700">
                                    Delete
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-3 py-8 text-center text-sm text-gray-500">
                            No video games found.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        @if($games->hasPages())
            <div class="px-4 py-3 bg-gray-50 border-t border-gray-200">
                {{ $games->links('vendor.pagination.tailwind') }}
            </div>
        @endif
    </div>

    <!-- Delete Modal -->
    @if($showDeleteModal && $selectedGame)
        <div class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white rounded-md shadow-lg max-w-md w-full p-4">
                <h3 class="text-lg font-medium text-gray-900 mb-2">Delete Video Game</h3>
                <p class="text-sm text-gray-600 mb-4">
                    Are you sure you want to delete "{{ $selectedGame->video_game_title }}"? This action cannot be undone.
                </p>
                <div class="flex justify-end gap-2">
                    <button wire:click="closeDeleteModal"
                            class="px-3 py-1.5 text-sm rounded-lg border border-slate-200 hover:bg-slate-50">
                        Cancel
                    </button>
                    <button wire:click="deleteGame"
                            class="px-3 py-1.5 text-sm rounded-lg bg-red-600 text-white hover:bg-red-700">
                        Delete
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
