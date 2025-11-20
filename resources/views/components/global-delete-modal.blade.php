{{-- resources/views/components/global-delete-modal.blade.php --}}
<div
    x-data="{
        show: false,
        title: 'Delete Item',
        message: 'Are you sure you want to delete this item? This action cannot be undone.',
        event: null,
        payload: {},

        open(detail) {
            this.title   = detail.title   || 'Delete Item';
            this.message = detail.message || 'Are you sure you want to delete this item? This action cannot be undone.';
            this.event   = detail.event   || null;
            this.payload = detail.payload || {};
            this.show    = true;
        },

        close() {
            this.show = false;
        },

        {{-- confirm() {
            if (this.event) {
                Livewire.dispatch(this.event, this.payload);
            }
            this.close();
        } --}}
            confirm() {
            if (this.event) {
                Livewire.dispatch(this.event); // no payload
            }
            this.close();
        }
    }"
    x-init="
        window.addEventListener('open-delete-modal', e => open(e.detail || {}));
    "
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

            <div class="w-12 h-12 flex items-center justify-center rounded-full bg-red-100 text-red-600">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6
                             m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
            </div>

            <h3 class="text-sm font-semibold text-slate-800" x-text="title"></h3>
            <p class="text-sm text-slate-600" x-text="message"></p>

            <div class="mt-4 flex justify-center gap-3">
                <button
                    type="button"
                    @click="close()"
                    class="px-4 py-2 text-xs rounded-lg border border-slate-200 text-slate-700 hover:bg-slate-50"
                >
                    Cancel
                </button>
                <button
                    type="button"
                    @click="confirm()"
                    class="px-4 py-2 text-xs rounded-lg bg-red-600 text-white hover:bg-red-700"
                >
                    Delete
                </button>
            </div>
        </div>
    </div>
</div>
