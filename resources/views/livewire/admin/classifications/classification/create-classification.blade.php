<div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex items-center mb-2">
                <a
                    href="{{ route('admin.classifications.classified-items') }}"
                    class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 mr-4"
                >
                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Classifications
                </a>
            </div>
            <h1 class="text-3xl font-bold text-gray-900">Create New Classification</h1>
            <p class="mt-2 text-gray-600">Add a new content classification to the system</p>
        </div>

        <!-- Success Message -->
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

        <!-- Form Section -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
            <form wire:submit="save" class="p-6">
                <div class="space-y-6">
                    <!-- Media Type and Item Selection -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Media Type -->
                        <div>
                            <label for="classifiable_type" class="block text-sm font-medium text-gray-700 mb-2">
                                Media Type <span class="text-red-500">*</span>
                            </label>
                            <select
                                id="classifiable_type"
                                wire:model.live="classifiable_type"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                required
                            >
                                <option value="">Select Media Type</option>
                                @foreach($mediaTypes as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                            @error('classifiable_type')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Item Selection -->
                        <div>
                            <label for="classifiable_id" class="block text-sm font-medium text-gray-700 mb-2">
                                Item <span class="text-red-500">*</span>
                            </label>
                            <select
                                id="classifiable_id"
                                wire:model="classifiable_id"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                required
                                {{ !$classifiable_type ? 'disabled' : '' }}
                            >
                                <option value="">Select Item</option>
                                @foreach($items as $item)
                                    <option value="{{ $item->id }}">
                                        @if($classifiable_type === 'season')
                                            {{ optional($item->tvSeries)->tv_series_title ?? 'N/A' }} - {{ $item->season_title ?? 'N/A' }}
                                        @elseif($classifiable_type  === 'film')
                                            {{ $item->title ?? $item->film_title ?? 'N/A' }}
                                        @elseif($classifiable_type === 'advertisement_matter')
                                            {{ $item->title ?? $item->advertising_matter ?? 'N/A' }}
                                        @elseif($classifiable_type === 'video_gaming')
                                            {{ $item->title ?? $item->video_game_title ?? 'N/A' }}
                                        @else
                                            {{ $item->title ?? $item->name ?? 'Item #' . $item->id }}
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                            @error('classifiable_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror

                            @if($classifiable_type && $items->isEmpty())
                                <p class="mt-2 text-sm text-amber-600">
                                    No items found for the selected media type.
                                </p>
                            @endif
                        </div>
                    </div>

                    <!-- Rating and Category -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Rating -->
                        <div>
                            <label for="classification_rating_id" class="block text-sm font-medium text-gray-700 mb-2">
                                Rating <span class="text-red-500">*</span>
                            </label>
                            <select
                                id="classification_rating_id"
                                wire:model="classification_rating_id"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                required
                            >
                                <option value="">Select Rating</option>
                                @foreach($ratings as $rating)
                                    <option value="{{ $rating->id }}">{{ $rating->rating }}</option>
                                @endforeach
                            </select>
                            @error('classification_rating_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Category -->
                        <div>
                            <label for="classification_category_id" class="block text-sm font-medium text-gray-700 mb-2">
                                Category <span class="text-red-500">*</span>
                            </label>
                            <select
                                id="classification_category_id"
                                wire:model="classification_category_id"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                required
                            >
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('classification_category_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Status and Date -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Status -->
                        <div>
                            <label for="classification_status" class="block text-sm font-medium text-gray-700 mb-2">
                                Status <span class="text-red-500">*</span>
                            </label>
                            <select
                                id="classification_status"
                                wire:model="classification_status"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                required
                            >
                                <option value="Approved">Approved</option>
                                <option value="Rejected">Rejected</option>
                            </select>
                            @error('classification_status')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Date -->
                        <div>
                            <label for="classification_date" class="block text-sm font-medium text-gray-700 mb-2">
                                Classification Date
                            </label>
                            <input
                                type="date"
                                id="classification_date"
                                wire:model="classification_date"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                            >
                            @error('classification_date')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Reason and Viewed By -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Reason -->
                        <div>
                            <label for="classification_reason" class="block text-sm font-medium text-gray-700 mb-2">
                                Reason
                            </label>
                            <input
                                type="text"
                                id="classification_reason"
                                wire:model="classification_reason"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                placeholder="Enter classification reason"
                            >
                            @error('classification_reason')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Viewed By -->
                        <div>
                            <label for="viewed_by" class="block text-sm font-medium text-gray-700 mb-2">
                                Viewed By
                            </label>
                            <input
                                type="text"
                                id="viewed_by"
                                wire:model="viewed_by"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                placeholder="Person who viewed the content"
                            >
                            @error('viewed_by')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Second Opinion Section -->
                    <div class="border border-gray-200 rounded-xl p-6 bg-gray-50">
                        <div class="flex items-center mb-4">
                            <input
                                type="checkbox"
                                id="is_second_opinion"
                                wire:model="is_second_opinion"
                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                            >
                            <label for="is_second_opinion" class="ml-2 block text-sm font-medium text-gray-700">
                                This classification requires second opinion
                            </label>
                        </div>

                        @if($is_second_opinion)
                        <div class="mt-4">
                            <label for="second_opinion_by" class="block text-sm font-medium text-gray-700 mb-2">
                                Second Opinion By
                            </label>
                            <input
                                type="text"
                                id="second_opinion_by"
                                wire:model="second_opinion_by"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                placeholder="Person providing second opinion"
                            >
                            @error('second_opinion_by')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        @endif
                    </div>

                    <!-- Notes -->
                    <div>
                        <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">
                            Additional Notes
                        </label>
                        <textarea
                            id="notes"
                            wire:model="notes"
                            rows="4"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                            placeholder="Any additional notes or comments about this classification..."
                        ></textarea>
                        @error('notes')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="mt-8 flex flex-col-reverse sm:flex-row sm:justify-end sm:space-x-4">
                    <a
                        href="{{ route('admin.classifications.classified-items') }}"
                        class="mt-3 sm:mt-0 inline-flex justify-center items-center px-6 py-3 border border-gray-300 shadow-sm text-base font-medium rounded-xl text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200"
                    >
                        Cancel
                    </a>
                    <button
                        type="submit"
                        class="inline-flex justify-center items-center px-6 py-3 border border-transparent text-base font-medium rounded-xl shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200"
                    >
                        <svg wire:loading.remove class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <svg wire:loading class="-ml-1 mr-2 h-5 w-5 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2v4m0 12v4m8-10h-4M6 12H2"></path>
                        </svg>
                        Create Classification
                    </button>
                </div>
            </form>
        </div>

        <!-- Loading State -->
        <div wire:loading class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 flex items-center justify-center">
            <div class="bg-white p-6 rounded-2xl shadow-lg max-w-sm mx-auto">
                <div class="flex items-center">
                    <svg class="animate-spin h-8 w-8 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2v4m0 12v4m8-10h-4M6 12H2"></path>
                    </svg>
                    <div>
                        <h3 class="text-lg font-medium text-gray-900">Processing</h3>
                        <p class="text-gray-600">Creating classification...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
