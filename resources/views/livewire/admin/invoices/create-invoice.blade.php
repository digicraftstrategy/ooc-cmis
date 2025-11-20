<div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50 py-6 px-4 sm:px-6 lg:px-8">
    <!-- Header Section -->
    <div class="mb-6">
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-xl shadow-lg overflow-hidden">
            <div class="px-6 py-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <h1 class="text-xl md:text-2xl font-bold text-white mb-1">Create New Invoice</h1>
                        <p class="text-blue-100 opacity-90 text-sm">
                            Create and manage invoices for premises registration, renewal, and film classification
                        </p>
                    </div>

                    <div class="flex items-center gap-3">
                        <a href="{{ route('admin.invoices.list') ?? '#' }}"
                           class="px-4 py-2 text-blue-100 hover:text-white hover:bg-blue-500 border border-blue-400 font-medium rounded-lg transition-all duration-200 flex items-center text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Back to Invoices
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Success/Error Messages -->
    @if (session()->has('message'))
        <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 rounded-lg shadow-sm">
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

    @error('general')
        <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-lg shadow-sm">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-red-700">{{ $message }}</p>
                </div>
            </div>
        </div>
    @enderror

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Form Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Invoice Context Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <div class="flex items-center mb-4">
                    <div class="bg-blue-100 p-2 rounded-lg mr-3">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">Invoice Context</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Invoice Type</label>
                        <select wire:model.live="invoice_type"
                                class="block w-full pl-3 pr-10 py-2.5 text-base border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                            <option value="premises">Premises (Registration / Renewal)</option>
                            <option value="classification">Classification of Films & Publications</option>
                        </select>
                        @error('invoice_type') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Invoice Date</label>
                        <input type="date" wire:model.live="invoice_date"
                               class="block w-full px-3 py-2.5 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                        @error('invoice_date') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Due Date</label>
                        <input type="date" wire:model.live="due_date"
                               class="block w-full px-3 py-2.5 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                        @error('due_date') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            <!-- Billing Details Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <div class="flex items-center mb-4">
                    <div class="bg-green-100 p-2 rounded-lg mr-3">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">Billing Details</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Owner <span class="text-red-500">*</span>
                        </label>
                        <select wire:model.live="owner_id"
                                class="block w-full pl-3 pr-10 py-2.5 text-base border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                            <option value="">-- Select Owner --</option>
                            @foreach($owners as $owner)
                                <option value="{{ $owner->id }}">{{ $owner->owners_name ?? 'Owner #'.$owner->id }}</option>
                            @endforeach
                        </select>
                        @error('owner_id') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    @if($invoice_type === 'premises')
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Premises <span class="text-red-500">*</span>
                            </label>
                            <select wire:model.live="premises_id"
                                    class="block w-full pl-3 pr-10 py-2.5 text-base border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                                    @if(!$owner_id) disabled @endif>
                                <option value="">
                                    @if(!$owner_id)
                                        -- Select an owner first --
                                    @elseif($premisesOptions->isEmpty())
                                        -- No premises found for this owner --
                                    @else
                                        -- Select Premises --
                                    @endif
                                </option>
                                @foreach($premisesOptions as $premises)
                                    <option value="{{ $premises->id }}">{{ $premises->premises_name ?? 'Premises #'.$premises->id }}</option>
                                @endforeach
                            </select>
                            @error('premises_id') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                            @if($owner_id && $premisesOptions->isEmpty())
                                <p class="text-sm text-amber-600 mt-1">This owner has no registered premises.</p>
                            @endif
                        </div>
                    @endif
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Billing Email</label>
                        <input type="email" wire:model.blur="billing_email"
                               class="block w-full px-3 py-2.5 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                               placeholder="email@example.com">
                        @error('billing_email') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Billing Address</label>
                        <textarea wire:model.blur="billing_address" rows="2"
                                  class="block w-full px-3 py-2.5 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                                  placeholder="Enter billing address"></textarea>
                        @error('billing_address') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Notes</label>
                    <textarea wire:model.blur="notes" rows="2"
                              class="block w-full px-3 py-2.5 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                              placeholder="Add any additional notes or instructions"></textarea>
                    @error('notes') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Invoice Items Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center">
                        <div class="bg-purple-100 p-2 rounded-lg mr-3">
                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900">Invoice Items</h3>
                    </div>
                    <button type="button" wire:click="addItemRow"
                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-blue-600 to-indigo-600 rounded-lg shadow-sm hover:from-blue-700 hover:to-indigo-700 transition-all duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                        </svg>
                        Add Item
                    </button>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 text-sm">
                        <thead class="bg-gradient-to-r from-blue-50 to-indigo-50">
                            <tr>
                                <th class="px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider whitespace-nowrap text-left">
                                    Activity <span class="text-red-500">*</span>
                                </th>

                                @if($invoice_type === 'classification')
                                    <th class="px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider whitespace-nowrap text-left">
                                        Classification Item <span class="text-red-500">*</span>
                                    </th>
                                @endif

                                <th class="px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider whitespace-nowrap text-left">
                                    Description <span class="text-red-500">*</span>
                                </th>
                                <th class="px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider whitespace-nowrap text-center">
                                    Qty <span class="text-red-500">*</span>
                                </th>
                                <th class="px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider whitespace-nowrap text-right">
                                    Unit Amount <span class="text-red-500">*</span>
                                </th>
                                <th class="px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider whitespace-nowrap text-right">
                                    Line Total
                                </th>
                                <th class="px-3 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider whitespace-nowrap"></th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($items as $index => $item)
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <!-- Activity -->
                                    <td class="px-3 py-2">
                                        <select wire:model.live="items.{{ $index }}.prescribed_activity_id"
                                                class="w-full px-2 py-1.5 text-sm border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                                            <option value="">-- Select Activity --</option>
                                            @foreach($availableActivities as $activity)
                                                <option value="{{ $activity->id }}">
                                                    {{ $activity->activity_type }} (K {{ number_format($activity->prescribed_fee, 2) }})
                                                </option>
                                            @endforeach
                                        </select>
                                        @error("items.$index.prescribed_activity_id")
                                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                                        @enderror
                                    </td>

                                    <!-- Classification item per line (only for classification invoices) -->
                                    @if($invoice_type === 'classification')
                                        <td class="px-3 py-2">
                                            <select wire:model.live="items.{{ $index }}.classification_item_id"
                                                    class="w-full px-2 py-1.5 text-sm border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                                                <option value="">-- Select Classification --</option>
                                                @foreach($classificationItems as $class)
                                                    <option value="{{ $class->id }}">
                                                        {{ $class->id }} - {{ $class->item_title }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error("items.$index.classification_item_id")
                                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                                            @enderror
                                        </td>
                                    @endif

                                    <!-- Description -->
                                    <td class="px-3 py-2">
                                        <input type="text" wire:model.blur="items.{{ $index }}.description"
                                               class="w-full px-2 py-1.5 text-sm border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                                               placeholder="Item description">
                                        @error("items.$index.description")
                                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                                        @enderror
                                    </td>

                                    <!-- Qty -->
                                    <td class="px-3 py-2 text-center">
                                        <input type="number" min="1" wire:model.live="items.{{ $index }}.quantity"
                                               class="w-16 px-2 py-1.5 text-sm border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-center transition-colors duration-200">
                                        @error("items.$index.quantity")
                                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                                        @enderror
                                    </td>

                                    <!-- Unit -->
                                    <td class="px-3 py-2 text-right">
                                        <input type="number" step="0.01" min="0"
                                               wire:model.live="items.{{ $index }}.unit_amount"
                                               class="w-24 px-2 py-1.5 text-sm border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-right transition-colors duration-200">
                                        @error("items.$index.unit_amount")
                                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                                        @enderror
                                    </td>

                                    <!-- Line total -->
                                    <td class="px-3 py-2 text-right text-sm font-medium text-gray-900">
                                        K {{ number_format($item['line_total'] ?? 0, 2) }}
                                    </td>

                                    <td class="px-3 py-2 text-right">
                                        @if(count($items) > 1)
                                            <button type="button" wire:click="removeItemRow({{ $index }})"
                                                    class="text-red-600 hover:text-red-800 text-xs font-medium transition-colors duration-150">
                                                Remove
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="{{ $invoice_type === 'classification' ? 7 : 6 }}" class="px-3 py-8 text-center">
                                        <div class="flex flex-col items-center justify-center text-gray-400">
                                            <svg class="w-12 h-12 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
                                            </svg>
                                            <p class="text-sm font-medium text-gray-500">No items added</p>
                                            <p class="text-xs mt-1">Click "Add Item" to begin creating your invoice</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @error('items')
                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Sidebar Summary -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 sticky top-6">
                <div class="flex items-center mb-4">
                    <div class="bg-amber-100 p-2 rounded-lg mr-3">
                        <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 8l3 5m0 0l3-5m-3 5v4m-3-5h6m-6 3h6m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">Invoice Summary</h3>
                </div>

                <div class="space-y-4">
                    <div class="flex justify-between items-center pb-3 border-b border-gray-200">
                        <span class="text-sm text-gray-600">Subtotal:</span>
                        <span class="font-semibold text-gray-900">K {{ number_format($subtotal, 2) }}</span>
                    </div>

                    <div class="pb-3 border-b border-gray-200">
                        <div class="flex justify-between items-center mb-2">
                            <label class="text-sm text-gray-600">Tax:</label>
                        </div>
                        <input type="number" step="0.01" min="0" wire:model.live="tax"
                               class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-right transition-colors duration-200"
                               placeholder="0.00">
                        @error('tax') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex justify-between items-center pt-2">
                        <span class="text-base font-semibold text-gray-900">Total:</span>
                        <span class="text-xl font-bold text-blue-700">K {{ number_format($total, 2) }}</span>
                    </div>

                    <div class="pt-4 mt-4 border-t border-gray-200">
                        <button type="button" wire:click="save"
                                class="w-full px-4 py-3 text-base font-medium text-white bg-gradient-to-r from-blue-600 to-indigo-600 rounded-lg shadow-sm hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 inline-block mr-2 -mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Save Invoice
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
