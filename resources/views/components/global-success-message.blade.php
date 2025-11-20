@if (session()->has('success') || session()->has('error'))
    <div
        x-data="{ 
            show: true, 
            type: '{{ session()->has('success') ? 'success' : 'error' }}',
            message: '{{ session('success') ?? session('error') }}'
        }"
        x-init="setTimeout(() => show = false, 3500)"
        x-show="show"
        x-transition.opacity
        x-cloak
        class="fixed inset-0 z-50 flex items-center justify-center"
    >
        <!-- Backdrop -->
        <div class="absolute inset-0 bg-black/40"></div>

        <!-- Dialog -->
        <div class="relative bg-white rounded-2xl shadow-2xl max-w-md w-full mx-4 p-6 text-center border">
            <div class="flex flex-col items-center space-y-3">
                <div
                    class="w-12 h-12 flex items-center justify-center rounded-full"
                    :class="type === 'success' ? 'bg-emerald-100 text-emerald-600' : 'bg-rose-100 text-rose-600'"
                >
                    <!-- Icon -->
                    <template x-if="type === 'success'">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 13l4 4L19 7"/>
                        </svg>
                    </template>
                    <template x-if="type === 'error'">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01M12 5a7 7 0 100 14 7 7 0 000-14z"/>
                        </svg>
                    </template>
                </div>

                <h3 class="text-sm font-semibold text-slate-800" x-text="type === 'success' ? 'Success' : 'Error'"></h3>
                <p class="text-sm text-slate-600" x-text="message"></p>

                <button
                    type="button"
                    @click="show = false"
                    class="mt-2 inline-flex items-center px-4 py-1.5 text-xs rounded-lg bg-blue-600 text-white hover:bg-blue-700"
                >
                    OK
                </button>
            </div>
        </div>
    </div>
@endif