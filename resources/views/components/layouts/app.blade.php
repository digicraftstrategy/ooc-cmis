<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Layout styling -->
    <style>
        /* Root layout container */
        .app-container {
            display: flex;
            min-height: 100vh;
            position: relative;
        }

        /* Sidebar styles */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            overflow-y: auto;
            z-index: 40;
            transition: all 0.3s ease-in-out; /* smooth expand/collapse */
        }

        /* Main content */
        .main-content {
            flex: 1;
            min-width: 0; /* prevents flex overflow */
            min-height: 100vh;
            overflow-y: auto;
            transition: margin-left 0.3s ease-in-out; /* smooth shift when sidebar collapses */
        }

        /* Alpine collapse animation (for dropdowns) */
        [x-collapse] {
            transition-property: height;
            transition-duration: 0.3s;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
        }

        /* Prevent body scrolling when sidebar is open on mobile */
        body.sidebar-open {
            overflow: hidden;
        }

        /* Mobile overlay when sidebar is active */
        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 30;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease;
        }

        .sidebar-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        /* Common utility for transitions */
        .transition-all {
            transition-property: all;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 300ms;
        }
    </style>
</head>

<body class="font-sans antialiased" :class="{ 'sidebar-open': sidebarOpen && isMobile }">
    <div class="bg-gray-100 app-container" 
        x-data="{
            sidebarOpen: false, /* for mobile toggle */
            sidebarCollapsed: localStorage.getItem('sidebarCollapsed') === 'true', /* persists state */
            isMobile: window.innerWidth < 768,

            init() {
                /* persist collapse state */
                this.$watch('sidebarCollapsed', (val) => {
                    localStorage.setItem('sidebarCollapsed', val);
                });

                /* update on resize */
                window.addEventListener('resize', () => {
                    this.isMobile = window.innerWidth < 768;
                    if (!this.isMobile && this.sidebarOpen) {
                        this.sidebarOpen = false;
                    }
                });
            }
        }">

        <!-- Dark overlay when sidebar is open on mobile -->
        <div class="sidebar-overlay" 
            :class="{ 'active': sidebarOpen && isMobile }" 
            @click="sidebarOpen = false">
        </div>

        <!-- Sidebar -->
        <aside class="shadow sidebar transition-all duration-300"
            :class="{
                'w-64': !sidebarCollapsed && !isMobile,    /* full width */
                'w-20': sidebarCollapsed && !isMobile,    /* collapsed width */
                'w-64 transform -translate-x-full': !sidebarOpen && isMobile, /* hidden on mobile */
                'w-64 transform translate-x-0': sidebarOpen && isMobile       /* visible on mobile */
            }">
            {{-- Switch sidebar by role if needed --}}
            {{-- 
            @if (auth()->user()->isAdmin() || auth()->user()->isSystemUser())
                @include('components.sidebar')
            @else
                @include('components.layouts.client-sidebar')
            @endif
            --}}
            @include('components.sidebar')
        </aside>

        <!-- Main Content -->
        <main class="main-content transition-all duration-300"
            :class="{
                'ml-64': !sidebarCollapsed && !isMobile,  /* full sidebar pushes content */
                'ml-20': sidebarCollapsed && !isMobile,   /* collapsed sidebar */
                'ml-0': isMobile                          /* mobile view, no margin */
            }">

            <div class="relative">
                <!-- Mobile hamburger menu -->
                <button x-show="isMobile" @click="sidebarOpen = !sidebarOpen" type="button"
                    class="fixed z-50 inline-flex items-center justify-center p-2 text-gray-400 rounded-md top-4 left-4 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
                    <span class="sr-only">Open sidebar</span>

                    <!-- Hamburger icon -->
                    <svg class="w-6 h-6" x-bind:class="{ 'hidden': sidebarOpen, 'block': !sidebarOpen }"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>

                    <!-- Close (X) icon -->
                    <svg class="w-6 h-6" x-bind:class="{ 'block': sidebarOpen, 'hidden': !sidebarOpen }"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                {{-- Optional global search bar for system users --}}
                {{-- 
                @if (auth()->user()->isSystemUser())
                    <livewire:global-routes-search />
                    <hr />
                @endif
                --}}

                <!-- Page Heading -->
                @if (isset($header))
                    <header class="bg-white shadow transition-all duration-300"
                        :class="{
                            'ml-64': !sidebarCollapsed && !isMobile,
                            'ml-20': sidebarCollapsed && !isMobile,
                            'ml-0': isMobile
                        }">
                        <div class="px-4 py-6 mx-auto sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endif

                <!-- Page Content -->
                <div class="py-6 transition-all duration-300"
                    :class="{
                        'ml-0': !sidebarCollapsed && !isMobile,
                        'ml-0': sidebarCollapsed && !isMobile,
                        'ml-0': isMobile
                    }">
                    <div class="px-4 mx-auto max-w-12xl sm:px-6 lg:px-8">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
