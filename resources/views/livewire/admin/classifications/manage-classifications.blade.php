{{-- resources/views/livewire/admin/classifications/manage-classifications.blade.php --}}
<div class="p-6 space-y-6">
    <!-- Header Section -->
    <div class="mb-6">
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-xl shadow-lg overflow-hidden">
            <div class="px-6 py-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <h1 class="text-xl md:text-2xl font-bold text-white mb-1">Manage Classifications</h1>
                        <p class="text-blue-100 opacity-90 text-sm">View and manage Films, TV Series, Video Games, Advertisement Matters, and Audio.</p>
                    </div>
                    <button wire:click="openCreateModal"
                        class="px-4 py-2 bg-white text-blue-600 hover:bg-blue-50 border-transparent shadow font-medium rounded-lg transition-all duration-200 flex items-center text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                        </svg>
                        Add Classification
                    </button>
                </div>
            </div>
        </div>
    </div>
    {{-- Tabs --}}
    <div class="flex items-center justify-between flex-wrap gap-3 m-5">
        <div class="inline-flex rounded-xl border border-gray-200 bg-white shadow-sm overflow-hidden">
            @php
                $tabs = [
                    'films' => 'Films',
                    'tv'    => 'TV Series',
                    'games' => 'Video Games',
                    'ads'   => 'Advertisement Matters',
                    'audio' => 'Audio',
                ];
            @endphp

            @foreach($tabs as $key => $label)
                <button
                    wire:click="setTab('{{ $key }}')"
                    class="px-4 py-2 text-sm font-medium focus:outline-none transition
                           {{ $activeTab === $key
                                ? 'bg-blue-600 text-white'
                                : 'bg-white text-gray-700 hover:bg-gray-50' }}">
                    {{ $label }}
                </button>
            @endforeach
        </div>

        {{-- Search + Per-page --}}
        <div class="flex items-center gap-2">
            <input
                type="text"
                placeholder="Search title…"
                wire:model.debounce.400ms="search"
                class="w-56 rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm"
            />
            <select wire:model="perPage"
                class="rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm">
                <option value="10">10 / page</option>
                <option value="25">25 / page</option>
                <option value="50">50 / page</option>
            </select>
        </div>
    </div>

    {{-- Stats Cards (react to $activeTab) --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        @foreach($stats as $label => $value)
        <div class="rounded-xl bg-white border border-gray-200 shadow-sm p-4">
            <div class="flex items-center">
                <div class="p-2 bg-blue-100 rounded-lg">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <div class="text-sm text-gray-500">{{ $label }}</div>
                    <div class="mt-1 text-2xl font-semibold text-gray-900">{{ number_format($value) }}</div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Data Table --}}
    {{-- TABLE SECTION --}}
    <div class="bg-white rounded-lg shadow overflow-hidden">

        {{-- FILMS TAB --}}
        @if($activeTab === 'films')
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gradient-to-r from-blue-50 to-indigo-50">
                        <tr>
                            <th class="w-12 px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider text-left">#</th>
                            <th class="px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider text-left">Film Title</th>
                            {{--<th class="w-24 px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider text-left">Film Type</th>--}}
                            <th class="px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider text-left">Main Actor/Actress</th>
                            <th class="w-20 px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider text-left">Duration</th>
                            <th class="px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider text-left">Director</th>
                            <th class="px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider text-left">Producer</th>
                            <th class="px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider text-left">Production Company</th>
                            <th class="px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider text-left">Classification</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">

                        @forelse ($rows as $row)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-3 py-2 text-sm text-gray-900 text-center">
                                    {{ $loop->iteration + ($rows->currentPage() - 1) * $rows->perPage() }}
                                </td>

                                <td class="px-3 py-2">
                                    <div class="font-400 text-gray-700">{{ $row->film_title }}</div>
                                    <div class="text-xs text-gray-500">{{ $row->filmType->type ?? 'N/A'}}</div>
                                </td>

                                   {{--<td class="px-3 py-2">
                                    <span class="inline-flex items-center px-2 py-0.5 bg-blue-100 text-blue-800 rounded text-xs">
                                        {{ $row->filmType->type ?? 'N/A' }}
                                    </span>
                                </td>--}}

                                <td class="px-3 py-2 text-sm text-gray-700 truncate" title="{{ $row->casts }}">
                                    {{ $row->casts }}
                                </td>

                                <td class="px-3 py-2 text-sm text-gray-700 whitespace-nowrap">
                                    {{ $row->duration }} min
                                </td>

                                <td class="px-3 py-2 text-sm text-gray-700 truncate" title="{{ $row->director }}">
                                    {{ $row->director }}
                                </td>

                                <td class="px-3 py-2 text-sm text-gray-700 truncate" title="{{ $row->producer }}">
                                    {{ $row->producer }}
                                </td>

                                <td class="px-3 py-2 text-sm text-gray-700 truncate" title="{{ $row->production_company }}">
                                    {{ $row->production_company }}
                                </td>

                                {{-- Classification Cell --}}
                                <td class="px-3 py-2 whitespace-nowrap text-right text-sm">
                                    @php
                                        $rating = optional($row->classification?->rating)->code ?? '—';
                                        $status = optional($row->classification?->status)->label ?? 'Unclassified';
                                    @endphp

                                    <div class="flex items-center justify-end gap-2">

                                        {{-- Show current rating --}}
                                        <span class="px-2 py-0.5 rounded-full text-xs
                                            {{ $rating !== '—' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-500' }}">
                                            {{ $rating }}
                                        </span>

                                        {{-- CLASSIFY ACTION --}}
                                        <button
                                            wire:click="openClassificationModal({{ $row->id }}, 'Film')"
                                            class="px-2 py-1 text-xs font-medium text-indigo-600 hover:text-indigo-800 hover:underline">
                                            Classify
                                        </button>
                                    </div>

                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="9" class="px-3 py-10 text-center text-gray-500 text-sm">
                                    No films found.
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>

            @if($rows->hasPages())
                <div class="px-4 py-3 bg-gray-50 border-t border-gray-200">
                    {{ $rows->links('vendor.pagination.tailwind') }}
                </div>
            @endif

        @endif

        {{-- TV Series TAB --}}
        @if($activeTab === 'tv')
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gradient-to-r from-blue-50 to-indigo-50">
                        <tr>
                            <th class="w-12 px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider text-left">#</th>
                            <th class="px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider text-left">Series Title</th>
                            <th class="w-20 px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider text-left">Season No.</th>
                            <th class="px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider text-left">Season Title</th>
                            <th class="px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider text-left">Episodes #</th>
                            <th class="px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider text-left">Duration</th>
                            <th class="px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider text-left">Casts</th>
                            <th class="w-12 px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider text-left">Director</th>
                            <th class="px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider text-left">Producer</th>
                            <th class="px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider text-left">Producer</th>
                            <th class="w-20 px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider text-left">Language</th>
                            <th class="px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider text-left">Theme</th>
                            <th class="px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider text-left">Released Year</th>
                            <th class="px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider text-left">Genre</th>
                            <th class="px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider text-left">Created at</th>
                            <th class="px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider text-left">Updated at</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">

                        @forelse ($rows as $row)
                            <tr class="hover:bg-gray-50 transition">
                                <!-- # -->
                                <td class="px-3 py-2 text-sm text-slate-700 align-top text-left w-12">
                                    {{ $loop->iteration + ($rows->currentPage() - 1) * $rows->perPage() }}
                                </td>

                                <!-- Title + Slug -->
                                <td class="px-3 py-2 text-sm text-slate-700 align-top text-left w-56">
                                    <div class="font-semibold text-gray-900 truncate" title="{{ $row->tv_series_title }}">
                                        {{ $row->tv_series_title }}
                                    </div>
                                    <div class="text-xs text-gray-500 truncate" title="{{ $row->slug }}">{{ $row->slug }}</div>
                                </td>

                                <!-- Season No. -->
                                <td class="px-3 py-2 text-sm text-slate-700 align-top text-left w-20">
                                    {{ $row->season_number }}
                                </td>

                                <!-- Season Title -->
                                <td class="px-3 py-2 text-sm text-slate-700 align-top text-left w-56">
                                    <div class="truncate" title="{{ $row->season_title }}">{{ $row->season_title }}</div>
                                </td>

                                <!-- No. of Episodes -->
                                <td class="px-3 py-2 text-sm text-slate-700 align-top text-left w-24">
                                    {{ $row->number_of_episodes }}
                                </td>

                                <!-- Duration -->
                                <td class="px-3 py-2 text-sm text-slate-700 align-top text-left whitespace-nowrap w-24">
                                    {{ $row->duration }} min
                                </td>

                                <!-- Casts -->
                                <td class="px-3 py-2 text-sm text-slate-700 align-top text-left w-56">
                                    <div class="truncate" title="{{ $row->casts }}">{{ $row->casts }}</div>
                                </td>

                                <!-- Director -->
                                <td class="px-3 py-2 text-sm text-slate-700 align-top text-left w-40">
                                    <div class="truncate" title="{{ $row->director }}">{{ $row->director }}</div>
                                </td>

                                <!-- Producer -->
                                <td class="px-3 py-2 text-sm text-slate-700 align-top text-left w-40">
                                    <div class="truncate" title="{{ $row->producer }}">{{ $row->producer }}</div>
                                </td>

                                <!-- Production Company -->
                                <td class="px-3 py-2 text-sm text-slate-700 align-top text-left w-56">
                                    <div class="truncate" title="{{ $row->production_company }}">{{ $row->production_company }}</div>
                                </td>

                                <!-- Language -->
                                <td class="px-3 py-2 text-sm text-slate-700 align-top text-left w-32">
                                    <div class="truncate" title="{{ $row->language }}">{{ $row->language }}</div>
                                </td>

                                <!-- Theme (fixed width + wraps long phrases) -->
                                <td class="px-3 py-2 text-sm text-slate-700 align-top text-left w-64 whitespace-normal break-words">
                                    <!-- optional: clamp to 2 lines if you use the line-clamp plugin -->
                                    <!-- <p class="line-clamp-2" title="{{ $row->theme }}">{{ $row->theme }}</p> -->
                                    <p title="{{ $row->theme }}">{{ $row->theme }}</p>
                                </td>

                                <!-- Release Year -->
                                <td class="px-3 py-2 text-sm text-slate-700 align-top text-left w-28">
                                    {{ $row->release_year }}
                                </td>

                                <!-- Genre -->
                                <td class="px-3 py-2 text-sm text-slate-700 align-top text-left w-40">
                                    <div class="truncate" title="{{ $row->genre }}">{{ $row->genre }}</div>
                                </td>

                                <!-- Created at -->
                                <td class="px-3 py-2 text-xs text-slate-700 align-top text-left whitespace-nowrap w-40">
                                    {{ $row->created_at }}
                                </td>

                                <!-- Updated at -->
                                <td class="px-3 py-2 text-xs text-slate-700 align-top text-left whitespace-nowrap w-40">
                                    {{ $row->updated_at }}
                                </td>

                                <!-- Classification (right-aligned to match header) -->
                                <td class="px-3 py-2 text-sm text-slate-700 align-top text-right w-32">
                                    @php
                                        $rating = optional($row->classification?->rating)->code ?? '—';
                                        $status = optional($row->classification?->status)->label ?? 'Unclassified';
                                    @endphp
                                    <div class="flex items-center justify-end gap-2">
                                        <span class="px-2 py-0.5 rounded-full text-xs
                                            {{ $rating !== '—' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-500' }}">
                                            {{ $rating }}
                                        </span>
                                        <button
                                            wire:click="openClassificationModal({{ $row->id }}, 'Film')"
                                            class="px-2 py-1 text-xs font-medium text-indigo-600 hover:text-indigo-800 hover:underline">
                                            Classify
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="px-3 py-10 text-center text-gray-500 text-sm">
                                    No films found.
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>

            @if($rows->hasPages())
                <div class="px-4 py-3 bg-gray-50 border-t border-gray-200">
                    {{ $rows->links('vendor.pagination.tailwind') }}
                </div>
            @endif

        @endif

        {{-- Video Games TAB --}}
        @if($activeTab === 'games')
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gradient-to-r from-blue-50 to-indigo-50">
                        <tr>
                            <th class="w-12 px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider text-center">#</th>
                            <th class="px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider">Film Title</th>
                            <th class="w-24 px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider">Film Type</th>
                            <th class="px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider">Main Actor/Actress</th>
                            <th class="w-20 px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider">Duration</th>
                            <th class="px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider">Director</th>
                            <th class="px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider">Producer</th>
                            <th class="px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider">Production Company</th>
                            <th class="px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider text-right">Classification</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">

                        @forelse ($rows as $row)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-3 py-2 text-sm text-gray-900 text-center">
                                    {{ $loop->iteration + ($rows->currentPage() - 1) * $rows->perPage() }}
                                </td>

                                <td class="px-3 py-2">
                                    <div class="font-semibold text-gray-900">{{ $row->film_title }}</div>
                                    <div class="text-xs text-gray-500">{{ $row->slug }}</div>
                                </td>

                                <td class="px-3 py-2">
                                    <span class="inline-flex items-center px-2 py-0.5 bg-blue-100 text-blue-800 rounded text-xs">
                                        {{ $row->filmType->type ?? 'N/A' }}
                                    </span>
                                </td>

                                <td class="px-3 py-2 text-sm text-gray-700 truncate" title="{{ $row->main_actor_actress }}">
                                    {{ $row->main_actor_actress }}
                                </td>

                                <td class="px-3 py-2 text-sm text-gray-700 whitespace-nowrap">
                                    {{ $row->duration }} min
                                </td>

                                <td class="px-3 py-2 text-sm text-gray-700 truncate" title="{{ $row->director }}">
                                    {{ $row->director }}
                                </td>

                                <td class="px-3 py-2 text-sm text-gray-700 truncate" title="{{ $row->producer }}">
                                    {{ $row->producer }}
                                </td>

                                <td class="px-3 py-2 text-sm text-gray-700 truncate" title="{{ $row->production_company }}">
                                    {{ $row->production_company }}
                                </td>

                                {{-- Classification Cell --}}
                                <td class="px-3 py-2 whitespace-nowrap text-right text-sm">
                                    @php
                                        $rating = optional($row->classification?->rating)->code ?? '—';
                                        $status = optional($row->classification?->status)->label ?? 'Unclassified';
                                    @endphp

                                    <div class="flex items-center justify-end gap-2">

                                        {{-- Show current rating --}}
                                        <span class="px-2 py-0.5 rounded-full text-xs
                                            {{ $rating !== '—' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-500' }}">
                                            {{ $rating }}
                                        </span>

                                        {{-- CLASSIFY ACTION --}}
                                        <button
                                            wire:click="openClassificationModal({{ $row->id }}, 'Film')"
                                            class="px-2 py-1 text-xs font-medium text-indigo-600 hover:text-indigo-800 hover:underline">
                                            Classify
                                        </button>
                                    </div>

                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="9" class="px-3 py-10 text-center text-gray-500 text-sm">
                                    No films found.
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>

            @if($rows->hasPages())
                <div class="px-4 py-3 bg-gray-50 border-t border-gray-200">
                    {{ $rows->links('vendor.pagination.tailwind') }}
                </div>
            @endif

        @endif

        {{-- Ads TAB --}}
        @if($activeTab === 'ads')
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gradient-to-r from-blue-50 to-indigo-50">
                        <tr>
                            <th class="w-12 px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider text-center">#</th>
                            <th class="px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider">Film Title</th>
                            <th class="w-24 px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider">Film Type</th>
                            <th class="px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider">Main Actor/Actress</th>
                            <th class="w-20 px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider">Duration</th>
                            <th class="px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider">Director</th>
                            <th class="px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider">Producer</th>
                            <th class="px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider">Production Company</th>
                            <th class="px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider text-right">Classification</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">

                        @forelse ($rows as $row)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-3 py-2 text-sm text-gray-900 text-center">
                                    {{ $loop->iteration + ($rows->currentPage() - 1) * $rows->perPage() }}
                                </td>

                                <td class="px-3 py-2">
                                    <div class="font-semibold text-gray-900">{{ $row->film_title }}</div>
                                    <div class="text-xs text-gray-500">{{ $row->slug }}</div>
                                </td>

                                <td class="px-3 py-2">
                                    <span class="inline-flex items-center px-2 py-0.5 bg-blue-100 text-blue-800 rounded text-xs">
                                        {{ $row->filmType->type ?? 'N/A' }}
                                    </span>
                                </td>

                                <td class="px-3 py-2 text-sm text-gray-700 truncate" title="{{ $row->main_actor_actress }}">
                                    {{ $row->main_actor_actress }}
                                </td>

                                <td class="px-3 py-2 text-sm text-gray-700 whitespace-nowrap">
                                    {{ $row->duration }} min
                                </td>

                                <td class="px-3 py-2 text-sm text-gray-700 truncate" title="{{ $row->director }}">
                                    {{ $row->director }}
                                </td>

                                <td class="px-3 py-2 text-sm text-gray-700 truncate" title="{{ $row->producer }}">
                                    {{ $row->producer }}
                                </td>

                                <td class="px-3 py-2 text-sm text-gray-700 truncate" title="{{ $row->production_company }}">
                                    {{ $row->production_company }}
                                </td>

                                {{-- Classification Cell --}}
                                <td class="px-3 py-2 whitespace-nowrap text-right text-sm">
                                    @php
                                        $rating = optional($row->classification?->rating)->code ?? '—';
                                        $status = optional($row->classification?->status)->label ?? 'Unclassified';
                                    @endphp

                                    <div class="flex items-center justify-end gap-2">

                                        {{-- Show current rating --}}
                                        <span class="px-2 py-0.5 rounded-full text-xs
                                            {{ $rating !== '—' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-500' }}">
                                            {{ $rating }}
                                        </span>

                                        {{-- CLASSIFY ACTION --}}
                                        <button
                                            wire:click="openClassificationModal({{ $row->id }}, 'Film')"
                                            class="px-2 py-1 text-xs font-medium text-indigo-600 hover:text-indigo-800 hover:underline">
                                            Classify
                                        </button>
                                    </div>

                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="9" class="px-3 py-10 text-center text-gray-500 text-sm">
                                    No films found.
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>

            @if($rows->hasPages())
                <div class="px-4 py-3 bg-gray-50 border-t border-gray-200">
                    {{ $rows->links('vendor.pagination.tailwind') }}
                </div>
            @endif

        @endif

        {{-- Audio TAB --}}
        @if($activeTab === 'audio')
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gradient-to-r from-blue-50 to-indigo-50">
                        <tr>
                            <th class="w-12 px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider text-center">#</th>
                            <th class="px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider">Film Title</th>
                            <th class="w-24 px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider">Film Type</th>
                            <th class="px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider">Main Actor/Actress</th>
                            <th class="w-20 px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider">Duration</th>
                            <th class="px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider">Director</th>
                            <th class="px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider">Producer</th>
                            <th class="px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider">Production Company</th>
                            <th class="px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider text-right">Classification</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">

                        @forelse ($rows as $row)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-3 py-2 text-sm text-gray-900 text-center">
                                    {{ $loop->iteration + ($rows->currentPage() - 1) * $rows->perPage() }}
                                </td>

                                <td class="px-3 py-2">
                                    <div class="font-semibold text-gray-900">{{ $row->film_title }}</div>
                                    <div class="text-xs text-gray-500">{{ $row->slug }}</div>
                                </td>

                                <td class="px-3 py-2">
                                    <span class="inline-flex items-center px-2 py-0.5 bg-blue-100 text-blue-800 rounded text-xs">
                                        {{ $row->filmType->type ?? 'N/A' }}
                                    </span>
                                </td>

                                <td class="px-3 py-2 text-sm text-gray-700 truncate" title="{{ $row->main_actor_actress }}">
                                    {{ $row->main_actor_actress }}
                                </td>

                                <td class="px-3 py-2 text-sm text-gray-700 whitespace-nowrap">
                                    {{ $row->duration }} min
                                </td>

                                <td class="px-3 py-2 text-sm text-gray-700 truncate" title="{{ $row->director }}">
                                    {{ $row->director }}
                                </td>

                                <td class="px-3 py-2 text-sm text-gray-700 truncate" title="{{ $row->producer }}">
                                    {{ $row->producer }}
                                </td>

                                <td class="px-3 py-2 text-sm text-gray-700 truncate" title="{{ $row->production_company }}">
                                    {{ $row->production_company }}
                                </td>

                                {{-- Classification Cell --}}
                                <td class="px-3 py-2 whitespace-nowrap text-right text-sm">
                                    @php
                                        $rating = optional($row->classification?->rating)->code ?? '—';
                                        $status = optional($row->classification?->status)->label ?? 'Unclassified';
                                    @endphp

                                    <div class="flex items-center justify-end gap-2">

                                        {{-- Show current rating --}}
                                        <span class="px-2 py-0.5 rounded-full text-xs
                                            {{ $rating !== '—' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-500' }}">
                                            {{ $rating }}
                                        </span>

                                        {{-- CLASSIFY ACTION --}}
                                        <button
                                            wire:click="openClassificationModal({{ $row->id }}, 'Film')"
                                            class="px-2 py-1 text-xs font-medium text-indigo-600 hover:text-indigo-800 hover:underline">
                                            Classify
                                        </button>
                                    </div>

                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="9" class="px-3 py-10 text-center text-gray-500 text-sm">
                                    No films found.
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>

            @if($rows->hasPages())
                <div class="px-4 py-3 bg-gray-50 border-t border-gray-200">
                    {{ $rows->links('vendor.pagination.tailwind') }}
                </div>
            @endif

        @endif

    </div>
</div>
