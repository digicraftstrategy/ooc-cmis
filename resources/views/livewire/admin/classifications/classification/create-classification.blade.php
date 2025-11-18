<div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50">

    <!-- Header -->
    <header class="px-4 sm:px-6 lg:px-8 py-6">
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-2xl shadow-lg overflow-hidden">
            <div class="px-6 py-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <h1 class="text-2xl font-bold text-white">Create New Classification</h1>
                        <p class="text-blue-100 opacity-90 text-sm">Add a new content classification to the system. 
                            Choose the media item, apply a rating,
                            and record key review information.</p>
                    </div>

                    <div class="flex items-center gap-2">
                        <a href="{{ route('admin.classifications.classified-items') }}"
                        class="px-3 py-2 text-sm rounded-lg bg-white/10 text-white hover:bg-white/20 border border-white/20 transition">
                            Back
                        </a>
                        <button
                            wire:click="save"
                            wire:loading.attr="disabled"
                            class="inline-flex items-center px-4 py-2 text-sm rounded-lg bg-white text-blue-700 hover:bg-blue-50 shadow disabled:opacity-50">
                            <svg wire:loading wire:target="save" class="animate-spin -ml-1 mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                            </svg>
                            Save Classification
                        </button>
                    </div>
                </div>

                <!-- Breadcrumb -->
                <nav class="mt-4 text-xs text-blue-100">
                    <ol class="flex items-center gap-2">
                        <li><a href="{{ route('admin.classifications.classified-items') }}" class="hover:underline">Classifications</a></li>
                        <li>/</li>
                        <li class="text-white font-medium">Create</li>
                    </ol>
                </nav>
            </div>
        </div>
    </header>

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
    <main class="px-4 sm:px-6 lg:px-8 pb-12">
        <form wire:submit="save" class="space-y-6">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                {{-- 1️⃣ Select Media Type --}}
                <section class="bg-gray-50 rounded-xl border border-gray-200 p-5">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <h2 class="text-sm font-semibold text-slate-800">1. Select Media Type</h2>
                            <p class="text-xs text-slate-500">
                                Choose what kind of content you are classifying (Film, TV Series, Literature, etc.).
                            </p>
                        </div>
                    </div>

                    <div>
                        <div>
                            <label for="classifiable_type" class="block text-sm font-medium text-gray-700 mb-2">
                                Media Type <span class="text-red-500">*</span>
                            </label>
                            <select
                                id="classifiable_type"
                                wire:model.live="classifiable_type"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
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
                    </div>
                </section>

                {{-- 2️⃣ Select Item --}}
                <section class="bg-gray-50 rounded-xl border border-gray-200 p-5">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <h2 class="text-sm font-semibold text-slate-800">2. Select Item</h2>
                            <p class="text-xs text-slate-500">
                                After choosing a media type, pick the specific item being classified.
                            </p>
                        </div>
                    </div>

                    <div>
                        <div>
                            <label for="classifiable_id" class="block text-sm font-medium text-gray-700 mb-2">
                                Item <span class="text-red-500">*</span>
                            </label>
                            <select
                                id="classifiable_id"
                                wire:model="classifiable_id"
                                @disabled(!$classifiable_type)
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                required
                            >
                                <option value="">Select Item</option>
                                @foreach($items as $item)
                                    <option value="{{ $item->id }}">
                                        {{-- Prefer a display_title accessor if it exists, otherwise fall back --}}
                                        {{ $item->display_title
                                            ?? $item->film_title
                                            ?? $item->season_title
                                            ?? $item->tv_series_title
                                            ?? $item->literature_title
                                            ?? $item->advertising_matter
                                            ?? $item->video_game_title
                                            ?? $item->audio_title
                                            ?? 'Item #'.$item->id
                                        }}
                                    </option>
                                @endforeach
                            </select>
                            @error('classifiable_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror

                            @if($classifiable_type && $items->isEmpty())
                                <p class="mt-2 text-sm text-amber-600">
                                    No unclassified items found for the selected media type.  
                                    (All items of this type may have already been classified.)
                                </p>
                            @endif
                        </div>
                    </div>
                </section>
            </div>

            {{-- 3️⃣ Rating & Category --}}
            <section class="bg-gray-50 rounded-xl border border-gray-200 p-5">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h2 class="text-sm font-semibold text-slate-800">3. Rating &amp; Category</h2>
                        <p class="text-xs text-slate-500">
                            Apply the correct classification rating and category for reporting.
                        </p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Rating -->
                    <div>
                        <label for="classification_rating_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Rating <span class="text-red-500">*</span>
                        </label>
                        <select
                            id="classification_rating_id"
                            wire:model="classification_rating_id"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
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
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
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
            </section>

            {{-- 4️⃣ Status & Date --}}
            <section class="bg-gray-50 rounded-xl border border-gray-200 p-5">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h2 class="text-sm font-semibold text-slate-800">4. Status &amp; Date</h2>
                        <p class="text-xs text-slate-500">
                            Record the final decision and when the classification was made.
                        </p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Status -->
                    <div>
                        <label for="classification_status" class="block text-sm font-medium text-gray-700 mb-2">
                            Status <span class="text-red-500">*</span>
                        </label>
                        <select
                            id="classification_status"
                            wire:model="classification_status"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
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
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                        >
                        @error('classification_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </section>

            {{-- 5️⃣ Review Information --}}
            <section class="bg-gray-50 rounded-xl border border-gray-200 p-5">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h2 class="text-sm font-semibold text-slate-800">5. Review Information</h2>
                        <p class="text-xs text-slate-500">
                            Capture the core reasoning and the officer who reviewed the content.
                        </p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Reason -->
                    <div>
                        <label for="classification_reason" class="block text-sm font-medium text-gray-700 mb-2">
                            Reason
                        </label>
                        <input
                            type="text"
                            id="classification_reason"
                            wire:model="classification_reason"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
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
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                            placeholder="Person who viewed the content"
                        >
                        @error('viewed_by')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </section>

            {{-- 6️⃣ Second Opinion --}}
            <section class="bg-gray-50 rounded-xl border border-gray-200 p-5">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h2 class="text-sm font-semibold text-slate-800">6. Second Opinion</h2>
                        <p class="text-xs text-slate-500">
                            Flag if another officer needs to review or has reviewed this decision.
                        </p>
                    </div>
                </div>

                <div class="space-y-4">
                    <div class="flex items-center">
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
                        <div class="mt-2">
                            <label for="second_opinion_by" class="block text-sm font-medium text-gray-700 mb-2">
                                Second Opinion By
                            </label>
                            <input
                                type="text"
                                id="second_opinion_by"
                                wire:model="second_opinion_by"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                placeholder="Person providing second opinion"
                            >
                            @error('second_opinion_by')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    @endif
                </div>
            </section>

            {{-- 7️⃣ Notes --}}
            <section class="bg-gray-50 rounded-xl border border-gray-200 p-5">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h2 class="text-sm font-semibold text-slate-800">7. Notes</h2>
                        <p class="text-xs text-slate-500">
                            Record any extra comments that may help future reviewers.
                        </p>
                    </div>
                </div>

                <div>
                    <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">
                        Additional Notes
                    </label>
                    <textarea
                        id="notes"
                        wire:model="notes"
                        rows="4"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                        placeholder="Any additional notes or comments about this classification..."
                    ></textarea>
                    @error('notes')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </section>

            <!-- Form Actions -->
            <div class="pt-4 flex flex-col-reverse sm:flex-row sm:justify-end sm:space-x-4">
                <a
                    href="{{ route('admin.classifications.classified-items') }}"
                    class="mt-3 sm:mt-0 inline-flex justify-center items-center px-6 py-3 border border-gray-300 shadow-sm text-sm font-medium rounded-xl text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200"
                >
                    Cancel
                </a>
                <button
                    type="submit"
                    wire:loading.attr="disabled"
                    class="inline-flex justify-center items-center px-6 py-3 border border-transparent text-sm font-medium rounded-xl shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200"
                >
                    <svg wire:loading.remove class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <svg wire:loading class="-ml-1 mr-2 h-5 w-5 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2v4m0 12v4m8-10h-4M6 12H2"></path>
                    </svg>
                    Save Classification
                </button>
            </div>
        </form>
    </main>

    <!-- Loading State -->
    <div wire:loading class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 flex items-center justify-center">
        <div class="bg-white p-6 rounded-2xl shadow-lg max-w-sm mx-auto">
            <div class="flex items-center">
                <svg class="animate-spin h-8 w-8 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2v4m0 12v4m8-10h-4M6 12H2"></path>
                </svg>
                <div>
                    <h3 class="text-lg font-medium text-gray-900">Processing</h3>
                    <p class="text-gray-600">Saving classification...</p>
                </div>
            </div>
        </div>
    </div>
</div>
