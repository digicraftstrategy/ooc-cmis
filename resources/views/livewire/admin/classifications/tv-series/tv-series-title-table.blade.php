<div>
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold">TV Series Seasons</h2>
        <a href="#" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Add New Season
        </a>
    </div>

    <div class="mb-4 flex justify-between">
        <div class="flex space-x-2">
            <input wire:model.live="search" type="text" placeholder="Search seasons..." class="border rounded px-3 py-2">
            <select wire:model.live="perPage" class="border rounded px-3 py-2">
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
            </select>
        </div>

        @if($selectedSeasons)
            <button wire:click="bulkDelete" wire:confirm="Are you sure you want to delete selected seasons?"
                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                Delete Selected ({{ count($selectedSeasons) }})
            </button>
        @endif
    </div>

    <div class="bg-white shadow-md rounded my-6">
        <table class="min-w-full table-auto">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">
                        <input type="checkbox" wire:model.live="selectAll">
                    </th>
                    <th class="py-3 px-6 text-left cursor-pointer" wire:click="sortBy('season_number')">
                        Season
                        @include('livewire.includes.sort-icon', ['field' => 'season_number'])
                    </th>
                    <th class="py-3 px-6 text-left cursor-pointer" wire:click="sortBy('season_title')">
                        Title
                        @include('livewire.includes.sort-icon', ['field' => 'season_title'])
                    </th>
                    <th class="py-3 px-6 text-left">TV Series</th>
                    <th class="py-3 px-6 text-left">Episodes</th>
                    <th class="py-3 px-6 text-left cursor-pointer" wire:click="sortBy('released_year')">
                        Year
                        @include('livewire.includes.sort-icon', ['field' => 'released_year'])
                    </th>
                    <th class="py-3 px-6 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                @forelse($seasons as $season)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6 text-left">
                            <input type="checkbox" wire:model.live="selectedSeasons" value="{{ $season->id }}">
                        </td>
                        <td class="py-3 px-6 text-left">
                            <span class="font-semibold">S{{ str_pad($season->season_number, 2, '0', STR_PAD_LEFT) }}</span>
                        </td>
                        <td class="py-3 px-6 text-left">
                            <div class="flex items-center">
                                @if($season->poster_path)
                                    <img class="w-10 h-10 rounded-full mr-3" src="{{ $season->poster_path }}" alt="{{ $season->season_title }}">
                                @endif
                                <div>
                                    <span class="font-medium">{{ $season->season_title }}</span>
                                    <p class="text-gray-500 text-xs">{{ $season->slug }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="py-3 px-6 text-left">
                            {{ $season->tvSeries->tv_series_title ?? 'N/A' }}
                        </td>
                        <td class="py-3 px-6 text-left">
                            {{ $season->number_of_episodes }} episodes
                        </td>
                        <td class="py-3 px-6 text-left">
                            {{ $season->release_year }}
                        </td>
                        <td class="py-3 px-6 text-center">
                            <div class="flex item-center justify-center space-x-2">
                                <a href="#"
                                   class="text-blue-500 hover:text-blue-700">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                                    </svg>
                                </a>
                                <button wire:click="deleteSeason({{ $season->id }})"
                                        wire:confirm="Are you sure you want to delete this season?"
                                        class="text-red-500 hover:text-red-700">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="py-4 px-6 text-center">No seasons found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $seasons->links() }}
    </div>

    @if (session()->has('message'))
        <div class="mt-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('message') }}</span>
        </div>
    @endif
</div>
