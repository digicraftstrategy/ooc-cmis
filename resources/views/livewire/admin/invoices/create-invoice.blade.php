<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-semibold">Create Invoice</h2>
    </div>

    @if (session()->has('message'))
        <div class="px-4 py-3 text-green-800 bg-green-100 border border-green-300 rounded">
            {{ session('message') }}
        </div>
    @endif

    @error('general')
        <div class="px-4 py-3 text-red-800 bg-red-100 border border-red-300 rounded">
            {{ $message }}
        </div>
    @enderror

    {{-- Invoice context --}}
    <div class="bg-white shadow rounded p-4 space-y-4">
        <h3 class="text-lg font-semibold mb-2">Invoice Context</h3>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Invoice Type</label>
                <select wire:model="invoice_type"
                        class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="premises">Premises (Registration / Renewal)</option>
                    <option value="classification">Classification of Films & Publications</option>
                </select>
                @error('invoice_type') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Invoice Date</label>
                <input type="date" wire:model="invoice_date"
                       class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @error('invoice_date') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Due Date</label>
                <input type="date" wire:model="due_date"
                       class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @error('due_date') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>
        </div>
    </div>

    {{-- Billing --}}
    <div class="bg-white shadow rounded p-4 space-y-4">
        <h3 class="text-lg font-semibold mb-2">Billing Details</h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Owner</label>
                <select wire:model="owner_id"
                        class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="">-- Select Owner --</option>
                    @foreach($owners as $owner)
                        <option value="{{ $owner->id }}">{{ $owner->owners_name ?? 'Owner #'.$owner->id }}</option>
                    @endforeach
                </select>
                @error('owner_id') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            @if($invoice_type === 'premises')
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Premises</label>
                    <select wire:model="premises_id"
                            class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">-- Select Premises --</option>
                        @foreach($premisesOptions as $premises)
                            <option value="{{ $premises->id }}">{{ $premises->premises_name ?? 'Premises #'.$premises->id }}</option>
                        @endforeach
                    </select>
                    @error('premises_id') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>
            @else
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Classification Item</label>
                    <select wire:model="classification_item_id"
                            class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">-- Select Classification --</option>
                        @foreach($classificationItems as $item)
                            <option value="{{ $item->id }}">
                                {{ $item->id }} - {{ $item->title ?? 'Classification #'.$item->id }}
                            </option>
                        @endforeach
                    </select>
                    @error('classification_item_id') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>
            @endif
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Billing Email</label>
                <input type="email" wire:model="billing_email"
                       class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @error('billing_email') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Billing Address</label>
                <textarea wire:model="billing_address" rows="2"
                          class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                @error('billing_address') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Notes</label>
            <textarea wire:model="notes" rows="2"
                      class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"></textarea>
            @error('notes') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
        </div>
    </div>

    {{-- Items --}}
    <div class="bg-white shadow rounded p-4 space-y-4">
        <div class="flex justify-between items-center mb-2">
            <h3 class="text-lg font-semibold">Invoice Items</h3>
            <button type="button" wire:click="addItemRow"
                    class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-white bg-indigo-600 rounded hover:bg-indigo-700">
                + Add Item
            </button>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
    <thead class="bg-gray-50">
        <tr>
            <th class="px-3 py-2 text-left font-medium text-gray-700">Activity</th>

            @if($invoice_type === 'classification')
                <th class="px-3 py-2 text-left font-medium text-gray-700">Classification Item</th>
            @endif

            <th class="px-3 py-2 text-left font-medium text-gray-700">Description</th>
            <th class="px-3 py-2 text-center font-medium text-gray-700">Qty</th>
            <th class="px-3 py-2 text-right font-medium text-gray-700">Unit Amount</th>
            <th class="px-3 py-2 text-right font-medium text-gray-700">Line Total</th>
            <th class="px-3 py-2"></th>
        </tr>
    </thead>
    <tbody class="divide-y divide-gray-200">
        @forelse($items as $index => $item)
            <tr>
                {{-- Activity --}}
                <td class="px-3 py-2">
                    <select wire:model="items.{{ $index }}.prescribed_activity_id"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
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

                {{-- Classification item per line (only for classification invoices) --}}
                @if($invoice_type === 'classification')
                    <td class="px-3 py-2">
                        <select wire:model="items.{{ $index }}.classification_item_id"
                                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">-- Select Classification --</option>
                            @foreach($classificationItems as $class)
                                <option value="{{ $class->id }}">
                                    {{ $class->id }} - {{ $class->title ?? 'Classification #'.$class->id }}
                                </option>
                            @endforeach
                        </select>
                        @error("items.$index.classification_item_id")
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </td>
                @endif

                {{-- Description --}}
                <td class="px-3 py-2">
                    <input type="text" wire:model="items.{{ $index }}.description"
                           class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    @error("items.$index.description")
                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </td>

                {{-- Qty --}}
                <td class="px-3 py-2 text-center">
                    <input type="number" min="1" wire:model="items.{{ $index }}.quantity"
                           class="w-20 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-center">
                    @error("items.$index.quantity")
                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </td>

                {{-- Unit --}}
                <td class="px-3 py-2 text-right">
                    <input type="number" step="0.01" min="0"
                           wire:model="items.{{ $index }}.unit_amount"
                           class="w-28 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-right">
                    @error("items.$index.unit_amount")
                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </td>

                {{-- Line total --}}
                <td class="px-3 py-2 text-right">
                    K {{ number_format($item['line_total'] ?? 0, 2) }}
                </td>

                <td class="px-3 py-2 text-right">
                    @if(count($items) > 1)
                        <button type="button" wire:click="removeItemRow({{ $index }})"
                                class="text-red-600 hover:text-red-800 text-xs">
                            Remove
                        </button>
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="px-3 py-4 text-center text-gray-500">
                    No items. Click "Add Item" to begin.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
        </div>

        {{-- Totals --}}
        <div class="flex flex-col items-end space-y-2 mt-4">
            <div class="flex justify-end space-x-4 w-full md:w-1/2">
                <span class="text-sm text-gray-600">Subtotal:</span>
                <span class="font-semibold">K {{ number_format($subtotal, 2) }}</span>
            </div>
            <div class="flex justify-end space-x-4 w-full md:w-1/2">
                <span class="text-sm text-gray-600">Tax:</span>
                <input type="number" step="0.01" min="0" wire:model="tax"
                       class="w-32 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-right">
                @error('tax') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="flex justify-end space-x-4 w-full md:w-1/2">
                <span class="text-sm text-gray-700 font-semibold">Total:</span>
                <span class="text-lg font-bold">K {{ number_format($total, 2) }}</span>
            </div>
        </div>
    </div>

    {{-- Submit --}}
    <div class="flex justify-end">
        <button type="button" wire:click="save"
                class="px-6 py-2 text-white bg-indigo-600 rounded-md shadow hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            Save Invoice
        </button>
    </div>
</div>
