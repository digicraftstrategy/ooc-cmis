<div class="min-h-screen bg-gray-50">
    {{-- Vehicle Owner Header --}}
    <x-slot name='header'>
        <div class="px-6 py-4 bg-gradient-to-r from-blue-600 to-indigo-700 shadow-lg">
            <h2 class="text-2xl font-bold text-white">
              {{--  {{ $premisesOwner->owners_name }} - --}}Classified Films & Publications
            </h2>
            <p class="text-blue-100 mt-1">Manage all Classified Films & Publications under <b>{{--{{ $premisesOwner->owners_name }} --}} here</b> .</p>
        </div>
    </x-slot>
    <div class="px-6 py-4">
        <!-- Action Bar -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 p-6 bg-white rounded-xl shadow-sm mb-6">
            <div>
                {{--<x-blue-button-link-sm href="{{ route('admin.publication-premises.premises-owner.manage', $premisesOwner->uuid) }}" wire:navigate class="flex items-center gap-2">
                    <x-icons.arrow-left class="w-4 h-4" />
                    Back to Owners
                </x-blue-button-link-sm>--}}
            </div>
        </div>
    @push('styles')
    <style>
        [x-cloak] { display: none !important; }

        /* Smooth transitions for all interactive elements */
        * {
            transition-property: color, background-color, border-color, transform, box-shadow;
            transition-duration: 200ms;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Custom scrollbar for table */
        .overflow-x-auto::-webkit-scrollbar {
            height: 6px;
        }

        .overflow-x-auto::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 3px;
        }

        .overflow-x-auto::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 3px;
        }

        .overflow-x-auto::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        /* Enhanced focus styles */
        button:focus, input:focus, select:focus {
            outline: 2px solid #6366f1;
            outline-offset: 2px;
        }

        /* Gradient text for headers */
        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
    @endpush
</div>
