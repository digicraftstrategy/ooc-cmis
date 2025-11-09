<div class="p-6">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Film Basic Information -->
        <div class="space-y-4">
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-4 pb-2 border-b border-gray-200">Film Information</h3>

                <div class="space-y-3">
                    <div>
                        <span class="block text-sm font-medium text-gray-500">Film Title</span>
                        <span class="text-sm text-gray-900">{{ $film->film_title }}</span>
                    </div>

                    <div>
                        <span class="block text-sm font-medium text-gray-500">Film Type</span>
                        <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-blue-100 text-blue-800">
                            {{ $film->filmType->type ?? 'N/A' }}
                        </span>
                    </div>

                    <div>
                        <span class="block text-sm font-medium text-gray-500">Duration</span>
                        <span class="text-sm text-gray-900">{{ $film->duration }} minutes</span>
                    </div>

                    <div>
                        <span class="block text-sm font-medium text-gray-500">Film Color</span>
                        <span class="text-sm text-gray-900">{{ $film->film_color }}</span>
                    </div>
                </div>
            </div>

            <!-- Production Details -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-4 pb-2 border-b border-gray-200">Production Details</h3>

                <div class="space-y-3">
                    <div>
                        <span class="block text-sm font-medium text-gray-500">Director</span>
                        <span class="text-sm text-gray-900">{{ $film->director }}</span>
                    </div>

                    <div>
                        <span class="block text-sm font-medium text-gray-500">Producer</span>
                        <span class="text-sm text-gray-900">{{ $film->producer }}</span>
                    </div>

                    <div>
                        <span class="block text-sm font-medium text-gray-500">Production Company</span>
                        <span class="text-sm text-gray-900">{{ $film->production_company }}</span>
                    </div>

                    <div>
                        <span class="block text-sm font-medium text-gray-500">Distributor</span>
                        <span class="text-sm text-gray-900">{{ $film->distributor ?? 'N/A' }}</span>
                    </div>

                    <div>
                        <span class="block text-sm font-medium text-gray-500">Origin Country</span>
                        <span class="text-sm text-gray-900">{{ $film->origin_country }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional Information -->
        <div class="space-y-4">
            <!-- Casts -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-4 pb-2 border-b border-gray-200">Cast Members</h3>
                <div class="bg-gray-50 rounded-lg p-4">
                    <p class="text-sm text-gray-700 whitespace-pre-wrap">{{ $film->casts }}</p>
                </div>
            </div>

            <!-- Synopsis -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-4 pb-2 border-b border-gray-200">Synopsis</h3>
                <div class="bg-gray-50 rounded-lg p-4">
                    <p class="text-sm text-gray-700 whitespace-pre-wrap">{{ $film->synopsis }}</p>
                </div>
            </div>

            <!-- Submission File -->
            @if($film->submission_file_path)
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 pb-2 border-b border-gray-200">Submission File</h3>
                    <div class="flex items-center space-x-3 p-4 bg-gray-50 rounded-lg border">
                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-900">{{ $film->original_file_name }}</p>
                            <p class="text-xs text-gray-500">Uploaded {{ $film->created_at->format('M j, Y \a\t g:i A') }}</p>
                            <p class="text-xs text-gray-500">File size: {{ round(filesize(storage_path('app/public/' . $film->submission_file_path)) / 1024 / 1024, 2) }} MB</p>
                        </div>
                        <button wire:click="downloadFile"
                                class="px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-lg shadow-sm hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                            </svg>
                            Download
                        </button>
                    </div>
                </div>
            @endif

            <!-- Metadata -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-4 pb-2 border-b border-gray-200">Metadata</h3>
                <div class="space-y-2 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-500">Created</span>
                        <span class="text-gray-900">{{ $film->created_at->format('M j, Y \a\t g:i A') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Last Updated</span>
                        <span class="text-gray-900">{{ $film->updated_at->format('M j, Y \a\t g:i A') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Slug</span>
                        <span class="text-gray-900 font-mono text-xs">{{ $film->slug }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="flex justify-end space-x-3 pt-6 mt-6 border-t border-gray-200">
        <button type="button" wire:click="$dispatch('close-modal')"
            class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
            Close
        </button>
        <button type="button"
            wire:click="$dispatch('open-modal', { component: 'admin.classifications.films.edit-film', arguments: { film: {{ $film->id }} } })"
            class="px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-lg shadow-sm hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
            Edit Film
        </button>
    </div>
</div>
