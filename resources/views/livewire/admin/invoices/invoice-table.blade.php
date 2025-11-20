<div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50 py-6 px-4 sm:px-6 lg:px-8">
    <!-- Header Section -->
    <div class="mb-6">
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-xl shadow-lg overflow-hidden">
            <div class="px-6 py-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <h1 class="text-xl md:text-2xl font-bold text-white mb-1">Invoice Management</h1>
                        <p class="text-blue-100 opacity-90 text-sm">
                            Manage and track all invoices here including premises and classification invoices
                        </p>
                    </div>

                    <!-- Add New Invoice Button -->
                    <a href="{{ route('admin.invoices.create') ?? '#' }}"
                       class="px-4 py-2 bg-white text-blue-600 hover:bg-blue-50 border-transparent shadow font-medium rounded-lg transition-all duration-200 flex items-center text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                        </svg>
                        Create New Invoice
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards Section -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <!-- Total Invoices -->
        <div class="bg-white p-4 rounded-lg shadow border-l-4 border-blue-500">
            <div class="flex items-center">
                <div class="bg-blue-100 p-3 rounded-lg mr-4">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Invoices</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['total'] }}</p>
                </div>
            </div>
        </div>

        <!-- Paid Invoices -->
        <div class="bg-white p-4 rounded-lg shadow border-l-4 border-green-500">
            <div class="flex items-center">
                <div class="bg-green-100 p-3 rounded-lg mr-4">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Paid</p>
                    <p class="text-2xl font-bold text-green-600">{{ $stats['paid'] }}</p>
                </div>
            </div>
        </div>

        <!-- Pending Invoices -->
        <div class="bg-white p-4 rounded-lg shadow border-l-4 border-amber-500">
            <div class="flex items-center">
                <div class="bg-amber-100 p-3 rounded-lg mr-4">
                    <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Pending</p>
                    <p class="text-2xl font-bold text-amber-600">{{ $stats['pending'] }}</p>
                </div>
            </div>
        </div>

        <!-- Overdue Invoices -->
        <div class="bg-white p-4 rounded-lg shadow border-l-4 border-red-500">
            <div class="flex items-center">
                <div class="bg-red-100 p-3 rounded-lg mr-4">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Overdue</p>
                    <p class="text-2xl font-bold text-red-600">{{ $stats['overdue'] }}</p>
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
                <input
                    wire:model.live.debounce.300ms="search"
                    type="text"
                    class="block w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 text-sm"
                    placeholder="Search invoices, owners, premises..."
                >
            </div>

            <div class="grid grid-cols-2 gap-2">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                    <select
                        wire:model.live="typeFilter"
                        class="block w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 appearance-none text-sm"
                    >
                        <option value="">All Types</option>
                        <option value="premises">Premises</option>
                        <option value="classification">Classification</option>
                    </select>
                </div>

                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                    <select
                        wire:model.live="statusFilter"
                        class="block w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 appearance-none text-sm"
                    >
                        <option value="">All Statuses</option>
                        <option value="pending">Pending</option>
                        <option value="paid">Paid</option>
                        <option value="overdue">Overdue</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                </div>
            </div>

            <div class="flex items-center justify-between">
                <span class="text-sm text-gray-500">
                    {{ $invoices->total() }} invoice{{ $invoices->total() === 1 ? '' : 's' }} found
                </span>
                <select
                    wire:model.live="perPage"
                    class="block px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 text-sm"
                >
                    <option value="10">10 / page</option>
                    <option value="25">25 / page</option>
                    <option value="50">50 / page</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Success/Error Messages -->
    @if (session()->has('message'))
        <div class="mb-4 p-4 bg-green-50 border-l-4 border-green-500 rounded-lg shadow-sm">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-green-700">{{ session('message') }}</p>
                </div>
            </div>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="mb-4 p-4 bg-red-50 border-l-4 border-red-500 rounded-lg shadow-sm">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-red-700">{{ session('error') }}</p>
                </div>
            </div>
        </div>
    @endif

    <!-- Compact Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gradient-to-r from-blue-50 to-indigo-50">
                    <tr>
                        <th scope="col" class="px-3 py-3 text-left text-xs font-semibold text-blue-700 uppercase tracking-wider whitespace-nowrap">
                            <button type="button" wire:click="sortBy('invoice_number')" class="flex items-center gap-1 group focus:outline-none">
                                Invoice #
                                <svg class="h-4 w-4 transition-transform duration-200 {{ $sortField === 'invoice_number' ? 'text-blue-600' : 'text-gray-400 group-hover:text-gray-500' }} {{ $sortField === 'invoice_number' && $sortDirection === 'desc' ? 'rotate-180' : '' }}"
                                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"></path>
                                </svg>
                            </button>
                        </th>
                        <th scope="col" class="px-3 py-3 text-left text-xs font-semibold text-blue-700 uppercase tracking-wider whitespace-nowrap">
                            <button type="button" wire:click="sortBy('invoice_date')" class="flex items-center gap-1 group focus:outline-none">
                                Date
                                <svg class="h-4 w-4 transition-transform duration-200 {{ $sortField === 'invoice_date' ? 'text-blue-600' : 'text-gray-400 group-hover:text-gray-500' }} {{ $sortField === 'invoice_date' && $sortDirection === 'desc' ? 'rotate-180' : '' }}"
                                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"></path>
                                </svg>
                            </button>
                        </th>
                        <th scope="col" class="px-3 py-3 text-left text-xs font-semibold text-blue-700 uppercase tracking-wider whitespace-nowrap">
                            Type
                        </th>
                        <th scope="col" class="px-3 py-3 text-left text-xs font-semibold text-blue-700 uppercase tracking-wider whitespace-nowrap">
                            Owner
                        </th>
                        <th scope="col" class="px-3 py-3 text-left text-xs font-semibold text-blue-700 uppercase tracking-wider whitespace-nowrap">
                            Premises / Classifications
                        </th>
                        <th scope="col" class="px-3 py-3 text-left text-xs font-semibold text-blue-700 uppercase tracking-wider whitespace-nowrap">
                            <button type="button" wire:click="sortBy('total')" class="flex items-center gap-1 group focus:outline-none">
                                Total
                                <svg class="h-4 w-4 transition-transform duration-200 {{ $sortField === 'total' ? 'text-blue-600' : 'text-gray-400 group-hover:text-gray-500' }} {{ $sortField === 'total' && $sortDirection === 'desc' ? 'rotate-180' : '' }}"
                                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"></path>
                                </svg>
                            </button>
                        </th>
                        <th scope="col" class="px-3 py-3 text-left text-xs font-semibold text-blue-700 uppercase tracking-wider whitespace-nowrap">
                            Status
                        </th>
                        <th scope="col" class="px-3 py-3 text-center text-xs font-semibold text-blue-700 uppercase tracking-wider whitespace-nowrap">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($invoices as $invoice)
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <!-- Invoice Number -->
                            <td class="px-3 py-2 whitespace-nowrap text-sm font-medium text-gray-900">
                                <div class="flex items-center">
                                    <div class="bg-blue-100 p-2 rounded-lg mr-2">
                                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                    </div>
                                    <span class="font-semibold text-blue-700">{{ $invoice->invoice_number }}</span>
                                </div>
                            </td>

                            <!-- Date -->
                            <td class="px-3 py-2 whitespace-nowrap">
                                <div class="text-sm text-gray-700">
                                    {{ $invoice->invoice_date?->format('M d, Y') ?? 'N/A' }}
                                </div>
                                <div class="text-xs text-gray-500">
                                    Due: {{ $invoice->due_date?->format('M d, Y') ?? 'N/A' }}
                                </div>
                            </td>

                            <!-- Type -->
                            <td class="px-3 py-2 whitespace-nowrap">
                                @if($invoice->invoice_type === 'premises')
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800">
                                        <svg class="mr-1 h-3 w-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-2a1 1 0 00-1-1H9a1 1 0 00-1 1v2a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z" clip-rule="evenodd"></path>
                                        </svg>
                                        Premises
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-purple-100 text-purple-800">
                                        <svg class="mr-1 h-3 w-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                                        </svg>
                                        Classification
                                    </span>
                                @endif
                            </td>

                            <!-- Owner -->
                            <td class="px-3 py-2 whitespace-nowrap">
                                <div class="text-sm text-gray-700">
                                    {{ $invoice->owner->owners_name ?? '—' }}
                                </div>
                            </td>

                            <!-- Premises / Classifications -->
                            <td class="px-3 py-2">
                                <div class="text-sm text-gray-700">
                                    @if($invoice->invoice_type === 'premises')
                                        {{ $invoice->premises->premises_name ?? '—' }}
                                    @else
                                        @php
                                            // Get all classification items from invoice items
                                            $classificationItems = $invoice->items
                                                ->filter(fn($item) => !is_null($item->classification_item_id))
                                                ->map(fn($item) => $item->classificationItem)
                                                ->filter()
                                                ->unique('id');

                                            $classCount = $classificationItems->count();
                                        @endphp

                                        @if($classCount > 0)
                                            <div class="space-y-1">
                                                @foreach($classificationItems->take(2) as $classItem)
                                                    <div class="flex items-start text-xs">
                                                        <span class="inline-flex items-center justify-center h-5 w-5 rounded-full bg-purple-100 text-purple-800 text-xs font-medium mr-2 flex-shrink-0">
                                                            {{ $classItem->id }}
                                                        </span>
                                                        <span class="line-clamp-1">{{ $classItem->item_title }}</span>
                                                    </div>
                                                @endforeach

                                                @if($classCount > 2)
                                                    <div class="text-xs text-gray-500 pl-7">
                                                        +{{ $classCount - 2 }} more
                                                    </div>
                                                @endif
                                            </div>
                                        @else
                                            <span class="text-gray-400 text-xs">No classification items</span>
                                        @endif
                                    @endif
                                </div>
                            </td>

                            <!-- Total -->
                            <td class="px-3 py-2 whitespace-nowrap">
                                <div class="text-sm font-semibold text-gray-900">
                                    K {{ number_format($invoice->total, 2) }}
                                </div>
                            </td>

                            <!-- Status -->
                            <td class="px-3 py-2 whitespace-nowrap">
                                @php
                                    $status = $invoice->status;
                                    $badgeClasses = match($status) {
                                        'paid'      => 'bg-green-100 text-green-800',
                                        'pending'   => 'bg-yellow-100 text-yellow-800',
                                        'overdue'   => 'bg-red-100 text-red-800',
                                        'cancelled' => 'bg-gray-100 text-gray-600',
                                        default     => 'bg-gray-100 text-gray-600',
                                    };
                                @endphp
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium {{ $badgeClasses }}">
                                    @if($status === 'paid')
                                        <svg class="mr-1 h-3 w-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                        </svg>
                                    @elseif($status === 'pending')
                                        <svg class="mr-1 h-3 w-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                        </svg>
                                    @elseif($status === 'overdue')
                                        <svg class="mr-1 h-3 w-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                        </svg>
                                    @endif
                                    {{ ucfirst($status) }}
                                </span>
                            </td>

                            <!-- Actions -->
                            <td class="px-3 py-2 whitespace-nowrap text-center text-sm font-medium">
                                <div class="flex justify-center">
                                    <!-- Dropdown menu -->
                                    <div class="relative" x-data="{ open: false }">
                                        <button
                                            @click="open = !open"
                                            @click.outside="open = false"
                                            class="inline-flex items-center p-1.5 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-lg transition-colors duration-150"
                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z" />
                                            </svg>
                                        </button>

                                        <!-- Dropdown panel -->
                                        <div
                                            x-show="open"
                                            x-transition:enter="transition ease-out duration-100"
                                            x-transition:enter-start="transform opacity-0 scale-95"
                                            x-transition:enter-end="transform opacity-100 scale-100"
                                            x-transition:leave="transition ease-in duration-75"
                                            x-transition:leave-start="transform opacity-100 scale-100"
                                            x-transition:leave-end="transform opacity-0 scale-95"
                                            class="absolute right-0 z-10 mt-1 w-48 bg-white rounded-lg shadow-lg border border-gray-200 py-1"
                                            style="display: none;"
                                        >
                                            <!-- View option -->
                                            <a
                                                href="#"
                                                @click="open = false"
                                                class="flex items-center w-full px-3 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition-colors duration-150"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                                View Details
                                            </a>

                                            <!-- Mark as Paid (only for pending/overdue) -->
                                            @if(in_array($invoice->status, ['pending', 'overdue']))
                                                <button
                                                    wire:click="markAsPaid({{ $invoice->id }})"
                                                    wire:confirm="Mark this invoice as paid?"
                                                    @click="open = false"
                                                    class="flex items-center w-full px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition-colors duration-150"
                                                >
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                    Mark as Paid
                                                </button>
                                            @endif

                                            <!-- Mark as Cancelled (only for pending/overdue) -->
                                            @if(in_array($invoice->status, ['pending', 'overdue']))
                                                <button
                                                    wire:click="markAsCancelled({{ $invoice->id }})"
                                                    wire:confirm="Cancel this invoice?"
                                                    @click="open = false"
                                                    class="flex items-center w-full px-3 py-2 text-sm text-gray-700 hover:bg-amber-50 hover:text-amber-700 transition-colors duration-150"
                                                >
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                                                    </svg>
                                                    Cancel Invoice
                                                </button>
                                            @endif

                                            <!-- Edit option (only for pending/overdue) -->
                                            @if(in_array($invoice->status, ['pending', 'overdue']))
                                                <a
                                                    href="#"
                                                    @click="open = false"
                                                    class="flex items-center w-full px-3 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 transition-colors duration-150"
                                                >
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                    Edit
                                                </a>
                                            @endif

                                            <!-- Delete option -->
                                            <div class="border-t border-gray-200 my-1"></div>
                                            <button
                                                wire:click="deleteInvoice({{ $invoice->id }})"
                                                wire:confirm="Are you sure you want to delete this invoice? This action cannot be undone."
                                                @click="open = false"
                                                class="flex items-center w-full px-3 py-2 text-sm text-red-600 hover:bg-red-50 hover:text-red-700 transition-colors duration-150"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                                Delete
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-3 py-8 text-center">
                                <div class="flex flex-col items-center justify-center text-gray-400">
                                    <svg class="w-12 h-12 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
                                    </svg>
                                    <p class="text-sm font-medium text-gray-500">No invoices found</p>
                                    <p class="text-xs mt-1">Try adjusting your search criteria or create a new invoice</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($invoices->hasPages())
            <div class="px-4 py-3 bg-gray-50 border-t border-gray-200">
                {{ $invoices->links() }}
            </div>
        @endif
    </div>
</div>
