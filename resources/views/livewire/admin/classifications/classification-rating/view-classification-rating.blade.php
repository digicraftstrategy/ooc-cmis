<div class="px-6 py-4">
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-lg font-medium text-gray-900">Rating Details</h3>
        <button wire:click="closeModal" class="text-gray-400 hover:text-gray-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>

    @if($classificationRating)
        <div class="space-y-4">
            <!-- Rating Display -->
            <div class="flex items-center space-x-4">
                @if($classificationRating->icon_path)
                    <img src="{{ $classificationRating->icon_path }}"
                         alt="{{ $classificationRating->rating }}"
                         class="w-16 h-16 object-contain border rounded-lg">
                @else
                    <div class="w-16 h-16 flex items-center justify-center bg-blue-100 border rounded-lg">
                        <span class="text-lg font-bold text-blue-700">
                            {{ substr($classificationRating->rating, 0, 2) }}
                        </span>
                    </div>
                @endif
                <div>
                    <h4 class="text-xl font-semibold text-gray-900">{{ $classificationRating->rating }}</h4>
                    <p class="text-sm text-gray-500 font-mono">{{ $classificationRating->slug }}</p>
                </div>
            </div>

            <!-- Description -->
            <div>
                <label class="text-sm font-medium text-gray-700">Description</label>
                <p class="mt-1 text-sm text-gray-900">{{ $classificationRating->description ?? 'No description provided' }}</p>
            </div>

            <!-- Status & Dates -->
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="text-sm font-medium text-gray-700">Status</label>
                    <p class="mt-1">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $classificationRating->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $classificationRating->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </p>
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-700">Created</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $classificationRating->created_at->format('M d, Y') }}</p>
                </div>
            </div>

            <!-- Additional Info -->
            <div class="border-t pt-4">
                <h5 class="text-sm font-medium text-gray-700 mb-2">Additional Information</h5>
                <div class="text-sm text-gray-600 space-y-1">
                    <div class="flex justify-between">
                        <span>Last Updated:</span>
                        <span>{{ $classificationRating->updated_at->diffForHumans() }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Database ID:</span>
                        <span class="font-mono">#{{ $classificationRating->id }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="mt-6 flex justify-end space-x-3">
            <button wire:click="closeModal"
                    type="button"
                    class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Close
            </button>
            <button wire:click="editRating"
                    type="button"
                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Edit Rating
            </button>
        </div>
    @else
        <div class="text-center py-4">
            <p class="text-gray-500">Loading rating details...</p>
        </div>
    @endif
</div>
