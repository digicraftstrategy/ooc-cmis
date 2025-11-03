@props(['title', 'stateName', 'isCollapsed'])

<div class="relative py-1">
    <button @click="toggleDropdown('{{ $stateName }}')"
        class="relative flex items-center w-full px-4 py-3 text-sm font-medium transition duration-150 ease-in-out rounded-md group hover:bg-gray-700 hover:text-white focus:outline-none focus:bg-gray-700"
        @if ($isCollapsed) x-tooltip.placement.right.raw="{{ $title }}" @endif>
        {{ $icon }}
        <span :class="{ 'opacity-0 ml-0': {{ $isCollapsed ? 'true' : 'false' }}, 'ml-3': true }"
            class="transition-opacity duration-300">{{ $title }}</span>
        <svg x-show="!sidebarCollapsed" :class="{ 'rotate-90': {{ $stateName }} }"
            class="w-4 h-4 ml-auto transition-transform duration-300 text-gray-400" fill="none" stroke="currentColor"
            viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
        </svg>
    </button>
    <div x-show="(!sidebarCollapsed || isMobile) && {{ $stateName }}" x-collapse class="mt-1 space-y-1">
        {{ $slot }}
    </div>
</div>
