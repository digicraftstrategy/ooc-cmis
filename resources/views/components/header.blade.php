<header>
    <div class="px-8 relative">
        <div class="flex items-center justify-end h-16">
            <!-- Centered MIS Name -->
            <h1 class="absolute left-1/2 transform -translate-x-1/2 
                       text-2xl font-extrabold tracking-wide text-gray-200 stroke-1 stroke-white">
                Censorship Management Information System
            </h1>

            <!-- Right-side: Current User & Role -->
            <div class="flex items-center space-x-2">
                <span class="text-sm font-medium text-gray-800">
                    👤 {{ Auth::user()->name }}
                </span>
                <span class="text-sm text-gray-700">
                    ({{ ucfirst(Auth::user()->user_type->slug ?? 'User') }})
                </span>
            </div>
        </div>
    </div>
</header>
