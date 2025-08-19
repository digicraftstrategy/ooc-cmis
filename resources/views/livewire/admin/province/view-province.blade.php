<div>
    <div x-cloak x-show="$wire.showModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-50">
        <div class="w-full max-w-md bg-white rounded-lg shadow-xl">
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Province Details</h3>
                <button wire:click="closeModal" class="text-gray-400 hover:text-gray-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div class="px-6 py-4">
                <div class="mb-4">
                    <label class="block mb-1 text-sm font-medium text-gray-700">Name</label>
                    <p class="text-gray-900">{{ $province->name }}</p>
                </div>
                <div class="mb-4">
                    <label class="block mb-1 text-sm font-medium text-gray-700">Code</label>
                    <p class="text-gray-900">{{ $province->code ?? 'N/A' }}</p>
                </div>
                <div class="mb-4">
                    <label class="block mb-1 text-sm font-medium text-gray-700">Region</label>
                    <p class="text-gray-900">{{ $province->region->name ?? 'N/A' }}</p>
                </div>
            </div>
            <div class="px-4 py-3 bg-gray-50 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" wire:click="closeModal"
                    class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
