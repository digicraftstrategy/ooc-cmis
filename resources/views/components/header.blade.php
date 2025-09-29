<header>
    <div class="relative px-8 h-16 flex items-center justify-between">
        <!-- Centered Logo + Title -->
        <div class="absolute inset-x-0 flex items-center justify-center space-x-4 mr-10">
            <!-- Left Logo -->
            <x-application-logo-lg class="text-white h-10 w-auto" />

            <!-- Title -->
            <h1 class="text-2xl font-extrabold tracking-wide text-gray-200 stroke-1 stroke-white text-center">
                Censorship Management Information System
            </h1>

            <!-- Right Logo -->
            <x-application-logo class="text-white h-10 w-auto" />
        </div>

        <!-- Right-side: Current User & Role with Dropdown -->
        <div class="relative flex items-center space-x-2 ml-auto" x-data="{ open: false }">
            <button @click="open = !open"
                class="flex items-center space-x-2 text-sm font-medium text-gray-200 hover:text-white focus:outline-none">
                <span>👤 {{ Auth::user()->name }}</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>

            <!-- Dropdown Menu -->
            <div x-show="open" @click.away="open = false"
                x-transition:enter="transition ease-out duration-100"
                x-transition:enter-start="transform opacity-0 scale-95"
                x-transition:enter-end="transform opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-75"
                x-transition:leave-start="transform opacity-100 scale-100"
                x-transition:leave-end="transform opacity-0 scale-95"
                class="absolute right-0 top-full mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 border border-gray-200">
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                    👤 User Profile
                </a>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                    ⚙️ Settings
                </a>
                <div class="border-t border-gray-200 my-1"></div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        🚪 Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>
