<header>
    <div class="relative px-8 h-16 flex items-center justify-between">
        <!-- Centered Logo + Title -->
        <div class="flex items-center justify-center space-x-4 mx-auto">
            <!-- Left Logo -->
            <x-application-logo-lg class="text-white h-10 w-auto" />

            <!-- Title -->
            <h1 class="text-2xl font-extrabold tracking-wide text-gray-200 stroke-1 stroke-white text-center">
                Censorship Management Information System
            </h1>

            <!-- Right Logo -->
            <x-application-logo class="text-white h-10 w-auto" />
        </div>

        <!-- Right-side: User Profile Dropdown -->
        <div class="flex items-center justify-end" x-data="{ userMenuOpen: false }">
            <!-- User Info & Dropdown Trigger -->
            <button @click="userMenuOpen = !userMenuOpen"
                class="flex items-center space-x-3 text-sm font-medium text-gray-200 hover:text-white focus:outline-none transition-colors duration-200">
                <div class="text-right">
                    <p class="font-medium text-white truncate">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-gray-400 truncate">{{ auth()->user()->email }}</p>
                </div>
                <div class="flex items-center space-x-2">
                    <img src="{{ auth()->user()->profile_photo_url }}" alt="{{ auth()->user()->name }}"
                        class="w-8 h-8 border-2 border-gray-300 rounded-full object-cover">
                    <svg class="w-4 h-4 text-gray-400 transition-transform duration-200"
                         :class="{ 'rotate-180': userMenuOpen }"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </div>
            </button>

            <!-- Dropdown Menu -->
            <div x-show="userMenuOpen" @click.away="userMenuOpen = false"
                x-transition:enter="transition ease-out duration-100"
                x-transition:enter-start="transform opacity-0 scale-95"
                x-transition:enter-end="transform opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-75"
                x-transition:leave-start="transform opacity-100 scale-100"
                x-transition:leave-end="transform opacity-0 scale-95"
                class="absolute right-8 top-full mt-2 w-64 bg-white rounded-lg shadow-lg py-2 z-50 border border-gray-200">
                <!-- User Summary -->
                <div class="px-4 py-3 border-b border-gray-100">
                    <p class="text-sm font-medium text-gray-900 truncate">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-gray-500 truncate">{{ auth()->user()->email }}</p>
                </div>

                <!-- Menu Items -->
                <a href="{{ route('profile') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors duration-150">
                    <svg class="w-4 h-4 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    User Profile
                </a>
                <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors duration-150">
                    <svg class="w-4 h-4 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    Account Settings
                </a>

                <div class="border-t border-gray-100 my-1"></div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="flex items-center w-full px-4 py-2 text-sm text-red-600 hover:bg-gray-50 transition-colors duration-150">
                        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>
