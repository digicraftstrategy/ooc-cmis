<div class="px-6 py-4">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h3 class="text-lg font-medium text-gray-900">Edit Classification Rating</h3>
            <p class="mt-1 text-sm text-gray-600">Update rating details</p>
        </div>
        <button wire:click="closeModal" class="text-gray-400 hover:text-gray-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>

    @if($classificationRating)
        <form wire:submit="update" class="space-y-6">
            <div class="bg-white space-y-6">
                <!-- Rating & Slug -->
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <div>
                        <label for="rating" class="block text-sm font-medium text-gray-700">Rating Name *</label>
                        <input type="text" wire:model="rating" id="rating"
                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-blue-500 focus:border-blue-500">
                        @error('rating') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="slug" class="block text-sm font-medium text-gray-700">Slug *</label>
                        <div class="mt-1 flex rounded-md shadow-sm">
                            <input type="text" wire:model="slug" id="slug"
                                   class="flex-1 min-w-0 block w-full border border-gray-300 rounded-l-md py-2 px-3 focus:ring-blue-500 focus:border-blue-500">
                            <button type="button" wire:click="generateSlug"
                                    class="inline-flex items-center px-3 py-2 border border-l-0 border-gray-300 rounded-r-md bg-gray-50 text-gray-500 text-sm hover:bg-gray-100">
                                Generate
                            </button>
                        </div>
                        @error('slug') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea wire:model="description" id="description" rows="3"
                              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-blue-500 focus:border-blue-500"></textarea>
                    @error('description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <!-- Icon Upload -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Rating Icon</label>

                    <!-- Current Icon -->
                    @if($existingIcon)
                        <div class="mt-2 flex items-center space-x-4">
                            <img src="{{ $existingIcon }}" class="w-16 h-16 object-contain border rounded-lg">
                            <button type="button" wire:click="removeIcon"
                                    class="text-red-600 hover:text-red-800 text-sm font-medium">
                                Remove Icon
                            </button>
                        </div>
                    @endif

                    <!-- New Icon Upload -->
                    <div class="mt-4">
                        <input type="file" wire:model="icon"
                               class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        @error('icon') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror

                        @if ($icon)
                            <div class="mt-2">
                                <p class="text-sm text-gray-600">New Icon Preview:</p>
                                <img src="{{ $icon->temporaryUrl() }}" class="mt-1 w-16 h-16 object-contain border rounded">
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Active Status -->
                <div class="flex items-center">
                    <input wire:model="is_active" id="is_active" type="checkbox"
                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    <label for="is_active" class="ml-2 block text-sm text-gray-900">
                        Active Rating
                    </label>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex justify-end space-x-3 pt-6 border-t">
                <button type="button" wire:click="closeModal"
                        class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Cancel
                </button>
                <button type="submit"
                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Update Rating
                </button>
            </div>
        </form>
    @else
        <div class="text-center py-8">
            <p class="text-gray-500">Loading rating details...</p>
        </div>
    @endif
</div>
