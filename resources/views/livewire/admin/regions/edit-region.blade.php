<div>
    <div x-cloak
        x-show="$wire.showModal"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-50 flex items-center justify-center p-4 modal-overlay bg-black bg-opacity-50">
        
        <div class="w-full max-w-md max-h-full overflow-hidden bg-white rounded-lg shadow-xl"
            @click.stop>
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Edit Region</h3>
                <button wire:click="closeModal" class="text-gray-400 hover:text-gray-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div class="px-6 py-4">
                <form wire:submit.prevent="update">
                    <div class="mb-4">
                        <label for="edit-name" class="block text-sm font-medium text-gray-700">Name</label>
                        <input type="text" id="edit-name" wire:model="name"
                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                        @error('name')
                            <span class="text-xs text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="edit-code" class="block text-sm font-medium text-gray-700">Code (Optional)</label>
                        <input type="text" id="edit-code" wire:model="code"
                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                        @error('code')
                            <span class="text-xs text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                </form>
            </div>
            <div class="px-6 py-4 space-x-2 text-right bg-gray-50">
                <button type="button" wire:click="closeModal"
                    class="inline-flex justify-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Cancel
                </button>
                <x-blue-button wire:click="update" type="submit"
                    class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Update
                </x-blue-button>
            </div>
        </div>
    </div>
</div>