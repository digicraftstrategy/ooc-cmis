<div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50 py-6 px-4 sm:px-6 lg:px-8">
    <!-- Header Section -->
    <div class="mb-6">
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-xl shadow-lg overflow-hidden">
            <div class="px-6 py-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <h1 class="text-xl md:text-2xl font-bold text-white mb-1">Manage Films</h1>
                        <p class="text-blue-100 opacity-90 text-sm">Manage all registered films in the system</p>
                    </div>
                    <button wire:click="openCreateModal"
                        class="px-4 py-2 bg-white text-blue-600 hover:bg-blue-50 border-transparent shadow font-medium rounded-lg transition-all duration-200 flex items-center text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                        </svg>
                        Add New Film
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Search and Filter Section -->
    <div class="mb-4 bg-white rounded-lg shadow-sm p-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <input wire:model.live.debounce.300ms="search" type="text"
                    class="block w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 text-sm"
                    placeholder="Search films...">
            </div>

            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </div>
                <select wire:model.live="filmTitleFilter"
                    class="block w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 appearance-none text-sm">
                    <option value="">All Film Types</option>
                    @foreach($filmTypes as $filmType)
                        <option value="{{ $filmType->id }}">{{ $filmType->type }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex items-center justify-end">
                <span class="text-sm text-gray-500">
                    {{ $films->total() }} films found
                </span>
            </div>
        </div>
    </div>

    <!-- Event-based Message Display -->
    {{--@if ($message)
        <div class="p-3 mb-3 bg-green-50 border border-green-200 rounded-lg"
            x-data="{ show: true }"
            x-init="setTimeout(() => { show = false }, 5000)"
            x-show="show"
            x-transition:enter="transition ease-out duration-300"
            x-transition:leave="transition ease-in duration-200">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <div class="w-4 h-4 bg-green-500 rounded-full flex items-center justify-center mt-0.5">
                        <svg class="w-2.5 h-2.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                </div>
                <div class="ml-2 flex-1">
                    <p class="text-sm font-medium text-green-800">{{ $message }}</p>
                </div>
                <button @click="show = false; $wire.clearMessage()" class="flex-shrink-0 text-green-500 hover:text-green-700">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
    @endif

    @if (session()->has('error'))
        <div x-data="{ show: true }" x-show="show"
            class="p-3 mb-3 text-red-700 bg-red-100 border border-red-200 rounded-lg"
            role="alert">
            <div class="flex items-center justify-between">
                <span class="text-sm">{{ session('error') }}</span>
                <button @click="show = false" class="text-red-500 hover:text-red-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    @endif--}}

    <!-- Compact Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gradient-to-r from-blue-50 to-indigo-50">
                    <tr>
                        <th scope="col" class="w-12 px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider">
                            #
                        </th>
                        <th scope="col" class="px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider cursor-pointer"
                            wire:click="sortBy('film_title')">
                            <div class="flex items-center space-x-1">
                                <span>Film Title</span>
                                @if ($sortField === 'film_title')
                                    <span class="text-xs">{!! $sortDirection === 'asc' ? '↑' : '↓' !!}</span>
                                @endif
                            </div>
                        </th>
                        <th scope="col" class="w-24 px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider">
                            Film Type
                        </th>
                        <th scope="col" class="px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider">
                            Main Actor/Actress
                        </th>
                        <th scope="col" class="w-20 px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider">
                            Duration
                        </th>
                        <th scope="col" class="px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider">
                            Director
                        </th>
                        <th scope="col" class="px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider">
                            Producer
                        </th>
                        <th scope="col" class="px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider">
                            Production Company
                        </th>
                        <th scope="col" class="w-20 px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($films as $film)
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-3 py-2 whitespace-nowrap text-sm font-medium text-gray-900 text-center">
                                {{ $loop->iteration + ($films->currentPage() - 1) * $films->perPage() }}
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap">
                                <div class="text-sm font-semibold text-gray-900">{{ $film->film_title }}</div>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap">
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ $film->filmType->type ?? 'N/A' }}
                                </span>
                            </td>
                            <td class="px-3 py-2">
                                <div class="text-sm text-gray-700 max-w-xs truncate" title="{{ $film->main_actor_actress }}">
                                    {{ $film->main_actor_actress }}
                                </div>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap">
                                <div class="text-sm text-gray-700">{{ $film->duration }} min</div>
                            </td>
                            <td class="px-3 py-2">
                                <div class="text-sm text-gray-700 max-w-xs truncate" title="{{ $film->director }}">
                                    {{ $film->director }}
                                </div>
                            </td>
                            <td class="px-3 py-2">
                                <div class="text-sm text-gray-700 max-w-xs truncate" title="{{ $film->producer }}">
                                    {{ $film->producer }}
                                </div>
                            </td>
                            <td class="px-3 py-2">
                                <div class="text-sm text-gray-700 max-w-xs truncate" title="{{ $film->production_company }}">
                                    {{ $film->production_company }}
                                </div>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex justify-end space-x-1">
                                    <button wire:click="openViewModal({{ $film->id }})" 
                                        class="text-blue-600 hover:text-blue-900 p-1 rounded hover:bg-blue-50"
                                        title="View">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </button>

                                    <button wire:click="openEditModal({{ $film->id }})"
                                        class="text-green-600 hover:text-green-900 p-1 rounded hover:bg-green-50"
                                        title="Edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </button>

                                    <button wire:click="openDeleteModal({{ $film->id }})"
                                        class="text-red-600 hover:text-red-900 p-1 rounded hover:bg-red-50"
                                        title="Delete">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="px-3 py-8 text-center">
                                <div class="flex flex-col items-center justify-center text-gray-400">
                                    <svg class="w-12 h-12 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z" />
                                    </svg>
                                    <p class="text-sm font-medium text-gray-500">No films found</p>
                                    <p class="text-xs mt-1">Try adjusting your search criteria or add a new film</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($films->hasPages())
            <div class="px-4 py-3 bg-gray-50 border-t border-gray-200">
                {{ $films->links('vendor.pagination.tailwind') }}
            </div>
        @endif
    </div>
</div>