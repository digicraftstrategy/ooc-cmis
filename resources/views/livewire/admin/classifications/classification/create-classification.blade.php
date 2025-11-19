<div 
x-data="{ showGuidelines: false, guidelineTab: 'overview' }"
class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50">

    <!-- Page Header -->
    <header class="px-4 sm:px-6 lg:px-8 py-6">
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-2xl shadow-lg overflow-hidden">
            <div class="px-6 py-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <h1 class="text-2xl font-bold text-white">Create New Classification</h1>
                        <p class="text-blue-100 opacity-90 text-sm">
                            Add a new content classification to the system.
                            Choose the media item, apply a rating,
                            and record key review information.
                        </p>

                        <!-- Breadcrumb -->
                        <nav class="mt-3 text-xs text-blue-100">
                            <ol class="flex items-center gap-2">
                                <li>
                                    <a href="{{ route('admin.classifications.classified-items') }}" class="hover:underline">Classifications</a>
                                </li>
                                <li>/</li>
                                <li class="text-white font-medium">Create</li>
                            </ol>
                        </nav>
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
                            <svg wire:loading wire:target="save" class="animate-spin -ml-1 mr-2 h-4 w-4"
                                 xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10"
                                        stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                      d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                            </svg>
                            Save Classification
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Notifications -->
    @if (session()->has('message'))
        <div class="mx-4 sm:mx-6 lg:mx-8 -mt-2">
            <div class="rounded-lg bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 shadow">
                {{ session('message') }}
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <main class="px-4 sm:px-6 lg:px-8 pb-16 mt-4">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

            <!-- Left: Form sections -->
            <div class="lg:col-span-8 space-y-6">

                {{-- 1️⃣ Select Media Type --}}
                <section class="bg-white rounded-xl border shadow-sm overflow-hidden">
                    <div class="px-5 py-4 border-b">
                        <h3 class="text-sm font-semibold text-slate-800">1. Select Media Type & Item</h3>
                        <p class="text-xs text-slate-500">
                            Choose what kind of content you are classifying (Film, TV Series, Literature, etc.), then
                            pick the specific item being classified..
                        </p>
                    </div>
                    <div class="p-5 grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="classifiable_type" class="block text-xs font-medium text-slate-600 mb-2">
                                Media Type <span class="text-rose-600">*</span>
                            </label>
                            <select
                                id="classifiable_type"
                                wire:model.live="classifiable_type"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                required
                            >
                                <option value="">Select Media Type</option>
                                @foreach($mediaTypes as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                            @error('classifiable_type')
                                <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                            @enderror
                        </div>
                        {{-- 2️⃣ Select Item --}}
                        <div>
                            <label for="classifiable_id" class="block text-xs font-medium text-slate-600 mb-2">
                                Item <span class="text-rose-600">*</span>
                            </label>
                            <select
                                id="classifiable_id"
                                wire:model="classifiable_id"
                                @disabled(!$classifiable_type)
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                required
                            >
                                <option value="">Select Item</option>
                                @foreach($items as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->display_title }}
                                    </option>
                                @endforeach
                            </select>
                            @error('classifiable_id')
                                <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                            @enderror

                            @if($classifiable_type && $items->isEmpty())
                                <p class="mt-2 text-xs text-amber-600">
                                    No items found for the selected media type.
                                </p>
                            @endif
                        </div>
                    </div>
                </section>

                {{-- 3️⃣ Rating & Classification Date --}}
                <section class="bg-white rounded-xl border shadow-sm overflow-hidden">
                    <div class="px-5 py-4 border-b">
                        <h3 class="text-sm font-semibold text-slate-800">2. Rating &amp; Date</h3>
                        <p class="text-xs text-slate-500">
                            Apply the correct classification rating and date for reporting.
                        </p>
                    </div>
                    <div class="p-5 grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Rating -->
                        <div>
                            <label for="classification_rating_id" class="block text-xs font-medium text-slate-600 mb-2">
                                Rating <span class="text-rose-600">*</span>
                            </label>
                            <select
                                id="classification_rating_id"
                                wire:model="classification_rating_id"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                required
                            >
                                <option value="">Select Rating</option>
                                @foreach($ratings as $rating)
                                    <option value="{{ $rating->id }}">{{ $rating->rating }}</option>
                                @endforeach
                            </select>
                            @error('classification_rating_id')
                                <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Date -->
                        <div>
                            <label for="classification_date" class="block text-xs font-medium text-slate-600 mb-2">
                                Classification Date
                            </label>
                            <input
                                type="date"
                                id="classification_date"
                                wire:model="classification_date"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                            >
                            @error('classification_date')
                                <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Category -->
                        {{--<div>
                             <label for="classification_category_id" class="block text-xs font-medium text-slate-600 mb-2">
                                Category <span class="text-rose-600">*</span>
                            </label>
                            <select
                                id="classification_category_id"
                                wire:model="classification_category_id"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                required
                            >
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('classification_category_id')
                                <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                            @enderror
                        </div> --}}
                    </div>
                </section>

                {{-- 4️⃣ Status Approval --}}
                <section class="bg-white rounded-xl border shadow-sm overflow-hidden">
                    <div class="px-5 py-4 border-b">
                        <h3 class="text-sm font-semibold text-slate-800">3. Status Approval</h3>
                        <p class="text-xs text-slate-500">
                            Record the final decision and when the classification was made.
                        </p>
                    </div>
                    <div class="p-5 grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Status -->
                        <div>
                            <label for="classification_status" class="block text-xs font-medium text-slate-600 mb-2">
                                Status <span class="text-rose-600">*</span>
                            </label>
                            <select
                                id="classification_status"
                                wire:model="classification_status"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                required
                            >
                                <option value="Approved">Approved</option>
                                <option value="Rejected">Rejected</option>
                            </select>
                            @error('classification_status')
                                <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <div>
                                <p class="mb-2 text-xs text-slate-500">
                                    Flag if another officer needs to review or has reviewed this decision.
                                </p>
                            </div>
                            <div class="space-y-4">
                                <div class="flex items-center">
                                    <input
                                        type="checkbox"
                                        id="is_second_opinion"
                                        wire:model="is_second_opinion"
                                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                                    >
                                    <label for="is_second_opinion" class="ml-2 block text-xs font-medium text-slate-700">
                                        This classification requires second opinion
                                    </label>
                                </div>

                                @if($is_second_opinion)
                                    <div class="mt-2">
                                        <label for="second_opinion_by" class="block text-xs font-medium text-slate-600 mb-2">
                                            Second Opinion By
                                        </label>
                                        <input
                                            type="text"
                                            id="second_opinion_by"
                                            wire:model="second_opinion_by"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                            placeholder="Person providing second opinion"
                                        >
                                        @error('second_opinion_by')
                                            <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                @endif
                            </div>
                        </div>
                        {{-- <!-- Date -->
                        <div>
                            <label for="classification_date" class="block text-xs font-medium text-slate-600 mb-2">
                                Classification Date
                            </label>
                            <input
                                type="date"
                                id="classification_date"
                                wire:model="classification_date"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                            >
                            @error('classification_date')
                                <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                            @enderror
                        </div> --}}
                    </div>
                </section>

                {{-- 5️⃣ Review Information --}}
                <section class="bg-white rounded-xl border shadow-sm overflow-hidden">
                    <div class="px-5 py-4 border-b">
                        <h3 class="text-sm font-semibold text-slate-800">4. Review Information</h3>
                        <p class="text-xs text-slate-500">
                            Capture the core reasoning and the officer who reviewed the content.
                        </p>
                    </div>
                    <div class="p-5 grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Reason -->
                        <div>
                            <label for="classification_reason" class="block text-xs font-medium text-slate-600 mb-2">
                                Reason
                            </label>
                            <input
                                type="text"
                                id="classification_reason"
                                wire:model="classification_reason"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                placeholder="Enter classification reason"
                            >
                            @error('classification_reason')
                                <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Viewed By -->
                        <div>
                            <label for="viewed_by" class="block text-xs font-medium text-slate-600 mb-2">
                                Viewed By
                            </label>
                            <input
                                type="text"
                                id="viewed_by"
                                wire:model="viewed_by"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                placeholder="Person who viewed the content"
                            >
                            @error('viewed_by')
                                <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </section>

                {{-- 6️⃣ Second Opinion --}}
                <section class="bg-white rounded-xl border shadow-sm overflow-hidden">
                    {{-- <div class="px-5 py-4 border-b">
                        <h3 class="text-sm font-semibold text-slate-800">5. Second Opinion</h3>
                        <p class="text-xs text-slate-500">
                            Flag if another officer needs to review or has reviewed this decision.
                        </p>
                    </div>
                    <div class="p-5 space-y-4">
                        <div class="flex items-center">
                            <input
                                type="checkbox"
                                id="is_second_opinion"
                                wire:model="is_second_opinion"
                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                            >
                            <label for="is_second_opinion" class="ml-2 block text-xs font-medium text-slate-700">
                                This classification requires second opinion
                            </label>
                        </div>

                        @if($is_second_opinion)
                            <div class="mt-2">
                                <label for="second_opinion_by" class="block text-xs font-medium text-slate-600 mb-2">
                                    Second Opinion By
                                </label>
                                <input
                                    type="text"
                                    id="second_opinion_by"
                                    wire:model="second_opinion_by"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                    placeholder="Person providing second opinion"
                                >
                                @error('second_opinion_by')
                                    <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                                @enderror
                            </div>
                        @endif
                    </div> --}}
                </section>

                {{-- 7️⃣ Notes --}}
                <section class="bg-white rounded-xl border shadow-sm overflow-hidden">
                    <div class="px-5 py-4 border-b">
                        <h3 class="text-sm font-semibold text-slate-800">6. Notes</h3>
                        <p class="text-xs text-slate-500">
                            Record any extra comments that may help future reviewers.
                        </p>
                    </div>
                    <div class="p-5">
                        <label for="notes" class="block text-xs font-medium text-slate-600 mb-2">
                            Additional Notes
                        </label>
                        <textarea
                            id="notes"
                            wire:model="notes"
                            rows="4"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                            placeholder="Any additional notes or comments about this classification..."
                        ></textarea>
                        @error('notes')
                            <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>
                </section>
                <!-- Sticky Save / Actions -->
                <div class="bg-white rounded-xl border shadow-sm p-5">
                    <div class="flex items-center gap-2">
                        <a
                            href="{{ route('admin.classifications.classified-items') }}"
                            class="px-3 py-2 text-sm rounded-lg border border-slate-200 hover:bg-slate-50"
                        >
                            Cancel
                        </a>
                        <button
                            wire:click="save"
                            wire:loading.attr="disabled"
                            class="ml-auto inline-flex items-center px-4 py-2 text-sm rounded-lg bg-blue-600 text-white hover:bg-blue-700 shadow disabled:opacity-50"
                        >
                            <svg wire:loading wire:target="save" class="animate-spin -ml-1 mr-2 h-4 w-4"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10"
                                        stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                            </svg>
                            Save Classification
                        </button>
                    </div>
                </div>
            </div>

            <!-- Right: Preview & Tips & Sticky actions -->
            <aside class="lg:col-span-4 space-y-6">

                <!-- Live Preview Card -->
                {{-- <div class="bg-white rounded-xl border shadow-sm overflow-hidden">
                    <div class="px-5 py-4 border-b">
                        <h3 class="text-sm font-semibold text-slate-800">Preview Card</h3>
                        <p class="text-xs text-slate-500">How this classification might appear in lists.</p>
                    </div>
                    <div class="p-5">
                        <div class="rounded-lg border bg-gradient-to-b from-slate-50 to-white p-4">
                           @php
                                $selectedItem     = $items->firstWhere('id', $classifiable_id ?? null);
                                $selectedRating   = $ratings->firstWhere('id', $classification_rating_id ?? null);
                                $selectedCategory = $categories->firstWhere('id', $classification_category_id ?? null);
                            @endphp

                            <div class="flex items-start justify-between gap-2">
                                <div class="min-w-0">
                                    <p class="text-sm font-semibold text-slate-900 truncate">
                                        {{ $selectedItem->display_title ?? 'Selected item will appear here' }}
                                    </p>
                                    <p class="text-xs text-slate-500 truncate">
                                        {{ $selectedMediaType ?? 'Media type' }}
                                        @if($selectedRating)
                                            • Rated {{ $selectedRating->rating }}
                                        @endif
                                    </p>
                                </div>
                                @if($classification_status)
                                    <span class="text-[10px] px-2 py-0.5 rounded-full
                                        @if($classification_status === 'Approved')
                                            bg-emerald-50 text-emerald-700 border border-emerald-200
                                        @else
                                            bg-rose-50 text-rose-700 border border-rose-200
                                        @endif">
                                        {{ $classification_status }}
                                    </span>
                                @else
                                    <span class="text-[10px] px-2 py-0.5 rounded-full bg-slate-50 text-slate-600 border border-slate-200">
                                        Status
                                    </span>
                                @endif
                            </div>

                            <div class="mt-3 flex flex-wrap gap-2">
                                @if($selectedCategory)
                                    <span class="text-[10px] px-2 py-0.5 rounded-full bg-indigo-50 text-indigo-700 border border-indigo-200">
                                        {{ $selectedCategory->name }}
                                    </span>
                                @endif

                                @if($classification_date)
                                    <span class="text-[10px] px-2 py-0.5 rounded-full bg-slate-50 text-slate-700 border border-slate-200">
                                        {{ \Carbon\Carbon::parse($classification_date)->format('d M Y') }}
                                    </span>
                                @endif

                                @if($is_second_opinion)
                                    <span class="text-[10px] px-2 py-0.5 rounded-full bg-amber-50 text-amber-700 border border-amber-200">
                                        Second opinion
                                    </span>
                                @endif
                            </div>

                            <p class="mt-3 text-xs text-slate-600 line-clamp-3">
                                {{ $classification_reason ?: 'A short note on the reasoning behind this rating helps future reviewers understand the decision quickly.' }}
                            </p>

                            @if($viewed_by || $second_opinion_by)
                                <p class="mt-2 text-[11px] text-slate-500">
                                    {{ $viewed_by ? 'Viewed by '.$viewed_by : 'Viewer not recorded' }}
                                    @if($second_opinion_by)
                                        • Second opinion: {{ $second_opinion_by }}
                                    @endif
                                </p>
                            @endif
                        </div>
                    </div>
                </div> --}}

                <!-- Submission Tips -->
                <div class="bg-white rounded-xl border shadow-sm overflow-hidden">
                    <div class="px-5 py-4 border-b">
                        <h3 class="text-sm font-semibold text-slate-800">Submission Tips</h3>
                    </div>
                    <div class="p-5 text-sm text-slate-600 space-y-2">
                        <p>• Ensure the <strong>media type</strong> and <strong>item</strong> selected exactly match the material being classified.</p>
                        <p>• Choose a <strong>rating</strong> and <strong>category</strong> that reflects the strongest content elements (violence, language, nudity, themes, etc.).</p>
                        <p>• Use the <strong>Reason</strong> field to briefly explain key content that influenced the rating.</p>
                        <p>• If there is uncertainty, mark <strong>second opinion</strong> so another officer can review the decision.</p>
                        <p>• Add <strong>notes</strong> that may assist future re-classification or complaints handling.</p>
                    </div>
                </div>

                <!-- PNG Classification Guidelines -->
                <div class="bg-white rounded-xl border shadow-sm p-5">
                    <div class="flex items-start justify-between gap-3">
                        <div class="flex gap-3">
                            <div class="mt-0.5 flex h-8 w-8 items-center justify-center rounded-full bg-blue-50 border border-blue-100">
                                <span class="text-blue-600 text-base">⚖️</span>
                            </div>
                            <div>
                                <h3 class="text-sm font-semibold text-slate-800">
                                    PNG Classification Guidelines
                                </h3>
                                <p class="text-xs text-slate-500 mt-1">
                                    Reference the official criteria while deciding ratings and documenting your decision.
                                </p>
                            </div>
                        </div>

                        <button
                            type="button"
                            @click="showGuidelines = true; guidelineTab = 'overview'"
                            class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs rounded-lg bg-blue-600 text-white hover:bg-blue-700 shadow-sm"
                        >
                            <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path d="M12 5v14M5 12h14" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <span>View</span>
                        </button>
                    </div>
                </div>
                <!-- Sticky Save / Actions -->
                <div class="bg-white rounded-xl border shadow-sm p-5">
                    <div class="flex items-center gap-2">
                        <a
                            href="{{ route('admin.classifications.classified-items') }}"
                            class="px-3 py-2 text-sm rounded-lg border border-slate-200 hover:bg-slate-50"
                        >
                            Cancel
                        </a>
                        <button
                            wire:click="save"
                            wire:loading.attr="disabled"
                            class="ml-auto inline-flex items-center px-4 py-2 text-sm rounded-lg bg-blue-600 text-white hover:bg-blue-700 shadow disabled:opacity-50"
                        >
                            <svg wire:loading wire:target="save" class="animate-spin -ml-1 mr-2 h-4 w-4"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10"
                                        stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                            </svg>
                            Save Classification
                        </button>
                    </div>
                </div>
            </aside>
        </div>
        <!-- PNG Classification Guidelines Modal -->
        <div
            x-cloak
            x-show="showGuidelines"
            x-transition.opacity
            class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/70"
            @keydown.escape.window="showGuidelines = false"
            @click.self="showGuidelines = false"
        >
            <div
                x-transition
                class="bg-white rounded-[5px] shadow-2xl border border-slate-200 max-w-5xl w-full mx-4 max-h-[90vh] flex flex-col"
            >
                <!-- Modal Header -->
                <div class="px-6 sm:px-8 py-4 sm:py-5 border-b flex items-center justify-between gap-4 bg-gradient-to-r from-blue-50 to-indigo-50">
                    <div class="flex items-start gap-3">
                        <div class="mt-0.5 flex h-9 w-9 items-center justify-center rounded-2xl bg-blue-600 text-white shadow-sm">
                            <!-- small scale icon -->
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path d="M7 21h10M12 3v15M5 10h14" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-base sm:text-lg font-semibold text-slate-900">
                                PNG Film & Media Classification Guidelines
                            </h2>
                            <p class="text-sm text-slate-600 mt-1 max-w-2xl">
                                Use these guidelines alongside your professional judgement when assigning ratings, recording reasons
                                and deciding whether material should be disapproved or refused.
                            </p>
                        </div>
                    </div>
                    <button
                        type="button"
                        @click="showGuidelines = false"
                        class="inline-flex items-center gap-1 px-3 py-1.5 rounded-full bg-rose-50 text-rose-600 border border-rose-200 hover:bg-rose-100 text-sm font-medium"
                    >
                        <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path d="M6 6l12 12M18 6L6 18" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <span>Close</span>
                    </button>
                </div>

                <!-- Tabs -->
                <div class="px-6 sm:px-8 pt-3 border-b bg-slate-50/70">
                    <nav class="flex flex-wrap gap-2 text-xs sm:text-sm font-medium text-slate-600">
                        <button
                            type="button"
                            @click="guidelineTab = 'overview'"
                            :class="guidelineTab === 'overview'
                                ? 'bg-white text-blue-700 border border-blue-600 shadow-sm'
                                : 'bg-transparent text-slate-600 border border-transparent hover:bg-white/60'"
                            class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full"
                        >
                            <span class="text-sm">📋</span>
                            <span>1. Core Principles</span>
                        </button>
                        <button
                            type="button"
                            @click="guidelineTab = 'ratings'"
                            :class="guidelineTab === 'ratings'
                                ? 'bg-white text-blue-700 border border-blue-600 shadow-sm'
                                : 'bg-transparent text-slate-600 border border-transparent hover:bg-white/60'"
                            class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full"
                        >
                            <span class="text-sm">🎫</span>
                            <span>2. Rating Levels (GE / PG / M / R)</span>
                        </button>
                        <button
                            type="button"
                            @click="guidelineTab = 'disapproved'"
                            :class="guidelineTab === 'disapproved'
                                ? 'bg-white text-blue-700 border border-blue-600 shadow-sm'
                                : 'bg-transparent text-slate-600 border border-transparent hover:bg-white/60'"
                            class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full"
                        >
                            <span class="text-sm">⛔</span>
                            <span>3. Disapproved & Prohibited</span>
                        </button>
                    </nav>
                </div>

                <!-- Modal Body -->
                <div class="px-6 sm:px-8 py-4 sm:py-5 overflow-y-auto text-sm leading-relaxed text-slate-700 space-y-5">

                    {{-- Page 1: Core Principles --}}
                    <div x-show="guidelineTab === 'overview'">
                        <h3 class="text-base font-semibold text-slate-900 mb-2 flex items-center gap-2">
                            <span class="flex h-6 w-6 items-center justify-center rounded-full bg-blue-50 text-blue-600 text-sm">1</span>
                            Core Questions When Viewing a Film
                        </h3>

                        <p class="mb-2 text-slate-700">
                            The Censor when viewing a film must follow the theme closely and ask these questions:
                        </p>

                        <ul class="list-disc list-inside space-y-1">
                            <li>(a) Is the film about real life?</li>
                            <li>(b) Does it encourage the development of a healthy mind and body?</li>
                            <li>(c) Does it uphold moral values and common decency?</li>
                            <li>(d) Is the overall effect going to be good when it is viewed by the public?</li>
                        </ul>

                        <p class="mt-4 text-slate-700">
                            In addition to observing the above the Censor must watch out for the following:
                        </p>

                        <dl class="mt-3 space-y-3">

                            <!-- Crime -->
                            <div class="border border-slate-100 rounded-xl p-3 bg-slate-50/40">
                                <dt class="font-semibold text-slate-900 flex items-center gap-1.5 text-sm">
                                    <span class="text-sm">🚔</span> (a) Crime
                                </dt>
                                <dd class="mt-1">
                                    Some films revolve around a criminal story line.  
                                    Is the theme encouraging crime or is it criminally instructive?  
                                    Would the tactics used be easily copied?
                                </dd>
                            </div>

                            <!-- Violence -->
                            <div class="border border-slate-100 rounded-xl p-3 bg-slate-50/40">
                                <dt class="font-semibold text-slate-900 flex items-center gap-1.5 text-sm">
                                    <span class="text-sm">⚠️</span> (a) Violence
                                </dt>
                                <dd class="mt-1">
                                    Scenes of violence, brutality, torture etc… should be reduced to the minimum.
                                </dd>
                            </div>

                            <!-- Horror -->
                            <div class="border border-slate-100 rounded-xl p-3 bg-slate-50/40">
                                <dt class="font-semibold text-slate-900 flex items-center gap-1.5 text-sm">
                                    <span class="text-sm">👻</span> (a) Horror
                                </dt>
                                <dd class="mt-1">
                                    Our country is filled with so many traditional beliefs and fears.  
                                    This should not be compounded by spine-chilling fantasy made for commercial reasons only.  
                                    Materials of this nature should be for <strong>“Mature Audience Only.”</strong>
                                </dd>
                            </div>

                            <!-- Sex -->
                            <div class="border border-slate-100 rounded-xl p-3 bg-slate-50/40">
                                <dt class="font-semibold text-slate-900 flex items-center gap-1.5 text-sm">
                                    <span class="text-sm">❤️</span> (a) Sex
                                </dt>
                                <dd class="mt-1">
                                    Not all sex scenes are obscene or pornographic.  
                                    The manner in which the scene is presented must be observed carefully  
                                    to ensure that vulgar elements are not portrayed.
                                </dd>
                            </div>

                            <!-- Language -->
                            <div class="border border-slate-100 rounded-xl p-3 bg-slate-50/40">
                                <dt class="font-semibold text-slate-900 flex items-center gap-1.5 text-sm">
                                    <span class="text-sm">💬</span> (a) Language
                                </dt>
                                <dd class="mt-1">
                                    The dialogue understood by Papua New Guineans should also be acceptable.  
                                    Constant use of expletives or unjustified use of coarse language  
                                    may offend the viewing public.
                                </dd>
                            </div>

                            <!-- Others: Race / Religion / Nationalism -->
                            <div class="border border-slate-100 rounded-xl p-3 bg-slate-50/40 space-y-1.5">
                                <dt class="font-semibold text-slate-900 flex items-center gap-1.5 text-sm">
                                    <span class="text-sm">🌏</span> (a) Others
                                </dt>

                                <dd>
                                    <span class="font-semibold">Race:</span>
                                    Themes encouraging the domination of one race over another, is not to be tolerated.
                                </dd>

                                <dd>
                                    <span class="font-semibold">Religion:</span>
                                    Destructive criticism and or demeaning of religious groups in the country  
                                    should be observed carefully.
                                </dd>

                                <dd>
                                    <span class="font-semibold">Nationalism:</span>
                                    Films artistically created to undermine our national unity, independence  
                                    and system of government must be seriously considered.
                                </dd>
                            </div>

                        </dl>
                    </div>


                    {{-- Page 2: Rating Levels --}}
                    <div x-show="guidelineTab === 'ratings'">
                        <h3 class="text-base font-semibold text-slate-900 mb-2 flex items-center gap-2">
                            <span class="flex h-6 w-6 items-center justify-center rounded-full bg-blue-50 text-blue-600 text-sm">2</span>
                            Rating Levels – Content Expectations
                        </h3>

                        <p class="mb-2 text-slate-600">
                            The guidelines below are a summary of the above.  
                            Please consult all of these considerations before applying a particular classification.  
                            If the Censor is in doubt then the matter should be referred to the Chief Censor for a committee decision.
                        </p>

                        <div class="grid md:grid-cols-2 gap-4">

                            <!-- GENERAL EXHIBITION -->
                            <div class="border border-emerald-100 rounded-xl p-3 bg-emerald-50/40">
                                <h4 class="text-sm font-semibold text-emerald-800 flex items-center gap-1">
                                    <span class="text-sm">✅</span> GENERAL EXHIBITION
                                </h4>
                                <ul class="mt-1 space-y-1">
                                    <li><strong>Violence:</strong> Minimal and incidental depiction and only if justified.</li>
                                    <li><strong>Sex:</strong> No references to sex.</li>
                                    <li><strong>Language:</strong> No use of expletives.</li>
                                </ul>
                            </div>

                            <!-- PARENTAL GUIDANCE REQUIRED -->
                            <div class="border border-amber-100 rounded-xl p-3 bg-amber-50/40">
                                <h4 class="text-sm font-semibold text-amber-800 flex items-center gap-1">
                                    <span class="text-sm">👨‍👩‍👧</span> PARENTAL GUIDANCE REQUIRED
                                </h4>
                                <ul class="mt-1 space-y-1">
                                    <li>
                                        <strong>Violence:</strong> Brief depictions of mild violence such as physical contact,
                                        hand-to-hand fighting. No scenes of blood-letting or killing.
                                    </li>
                                    <li>
                                        <strong>Sex:</strong> Partial nudity from head to toe in non-sexual context.  
                                        Discreet verbal references to matters of sex.
                                    </li>
                                    <li><strong>Language:</strong> Use of expletives.</li>
                                    <li>
                                        <strong>Others:</strong> A disaster or accident without graphic views.  
                                        No scenes of horror or supernatural.
                                    </li>
                                </ul>
                            </div>

                            <!-- MATURE -->
                            <div class="border border-indigo-100 rounded-xl p-3 bg-indigo-50/40">
                                <h4 class="text-sm font-semibold text-indigo-800 flex items-center gap-1">
                                    <span class="text-sm">🔶</span> MATURE
                                </h4>
                                <ul class="mt-1 space-y-1">
                                    <li><strong>Violence:</strong> Scenes of hand-to-hand combat and use of weapons.</li>
                                    <li><strong></strong> Minimal depictions of blood-letting and killing if justified.</li>
                                    <li>
                                        <strong>Sex:</strong> Implicit sexual activity not visually portrayed and in justifiable circumstances.  
                                        Full backal nudity.
                                    </li>
                                    <li><strong>Language:</strong> Minimal use of coarse language – if justified.</li>
                                    <li>
                                        <strong>Others:</strong> Mild scenes of horror, obscured close-up views of accidents or disasters.  
                                        No use of drugs.
                                    </li>
                                </ul>
                            </div>

                            <!-- RESTRICTED -->
                            <div class="border border-rose-200 rounded-xl p-3 bg-rose-50/50">
                                <h4 class="text-sm font-semibold text-rose-800 flex items-center gap-1">
                                    <span class="text-sm">🚫</span> RESTRICTED
                                </h4>
                                <p class="mt-1 text-xs text-rose-700">
                                    Films and video tapes rated “R” would in most cases be refused classifications or cut effects drastically.
                                </p>
                                <ul class="mt-1 space-y-1">
                                    <li>
                                        <strong>Violence:</strong> Brief depictions of violence if justified (not explicit).
                                    </li>
                                    <li>
                                        <strong>Sex:</strong> Brief sexual activity in justified circumstances,  
                                        brief full frontal nudity not in sexual context.
                                    </li>
                                    <li><strong>Language:</strong> Occasional use of coarse language.</li>
                                    <li><strong>Others:</strong> Mild use of coarse language.</li>
                                </ul>
                            </div>

                        </div>
                    </div>

                    {{-- Page 3: Materials Disapproved / Totally Prohibited --}}
                    <div x-show="guidelineTab === 'disapproved'">
                        <h3 class="text-base font-semibold text-slate-900 mb-2 flex items-center gap-2">
                            <span class="flex h-6 w-6 items-center justify-center rounded-full bg-blue-50 text-blue-600 text-sm">3</span>
                            Materials Which May Be Disapproved
                        </h3>
                        <p>
                            The Censor shall consider the character and context of the film in its entirety and shall approve its
                            exhibition or distribution unless the film contains:
                        </p>
                        <ul class="mt-2 space-y-1 list-[lower-alpha] list-inside">
                            <li>Scene depicting graphic or prolonged violence, torture, crime, cruelty, horror or human degradation.</li>
                            <li>Scene depicting graphic or prolonged abuse or humiliation of human beings.</li>
                            <li>Child abuse or neglect.</li>
                            <li>Marital abuse.</li>
                            <li>Racial discrimination.</li>
                            <li>Religious discrimination.</li>
                            <li>Language that is offensive and contradictory to Papua New Guinea customs.</li>
                            <li>Animal abuse.</li>
                            <li>Premeditating a crime (robbery, murder, rape, etc.).</li>
                            <li>Provocative nudity with sexual suggestiveness.</li>
                            <li>Language, moans, groans associated with sexual activity.</li>
                            <li>Sexual violence such as attempt to rape.</li>
                            <li>Crime being glorified.</li>
                        </ul>
                        <h4 class="text-base font-semibold text-rose-800 mt-4 mb-1 flex items-center gap-2">
                            <span class="flex h-6 w-6 items-center justify-center rounded-full bg-rose-100 text-rose-700 text-sm">!</span>
                            Totally Prohibited
                        </h4>
                        <ul class="space-y-1 list-decimal list-inside">
                            <li>Child pornography.</li>
                            <li>Bestiality (inhumanity, cruelty, savagery, brutality, wickedness).</li>
                            <li>Explicit sexual activity.</li>
                            <li>Production of narcotic drugs.</li>
                            <li>Production of firearms.</li>
                            <li>Blasphemy (profanity, sacrilege, irreverence, desecration).</li>
                            <li>Terrorism.</li>
                            <li>Homosexuality and lesbianism (noted here as per legacy guidelines).</li>
                            <li>Rape and gang rape.</li>
                            <li>Glorification of violence, crime and cruelty.</li>
                        </ul>

                        <p class="mt-3 text-xs text-slate-500">
                            These points are drawn from the official PNG classification guidelines. Always apply the latest
                            legislation, policy directions and any updated instructions from the Chief Censor when in doubt.
                        </p>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="px-6 sm:px-8 py-3 border-t bg-slate-50 flex justify-between items-center gap-3 rounded-b-[5px]">
                    <p class="text-xs text-slate-500 hidden sm:block">
                        Tip: Keep this window open on a second screen while classifying multiple items.
                    </p>
                    <button
                        type="button"
                        @click="showGuidelines = false"
                        class="px-4 py-2 text-sm font-medium rounded-lg border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 inline-flex items-center gap-1.5"
                    >
                        <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path d="M6 6l12 12M18 6L6 18" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <span>Close Guidelines</span>
                    </button>
                </div>
            </div>
        </div>

    </main>

    <!-- Loading State -->
    <div wire:loading
         class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 flex items-center justify-center">
        <div class="bg-white p-6 rounded-2xl shadow-lg max-w-sm mx-auto">
            <div class="flex items-center">
                <svg class="animate-spin h-8 w-8 text-blue-600 mr-3" fill="none" stroke="currentColor"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 2v4m0 12v4m8-10h-4M6 12H2"></path>
                </svg>
                <div>
                    <h3 class="text-lg font-medium text-gray-900">Processing</h3>
                    <p class="text-gray-600">Saving classification...</p>
                </div>
            </div>
        </div>
    </div>
</div>
