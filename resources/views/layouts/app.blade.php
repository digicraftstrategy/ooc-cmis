<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"></html>
<head>

    {{-- Premises Mapping API --}}
    <link
        rel="stylesheet"
        href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-o9N1j7kGStpht/7VDaNhPHzGmGr2P2lbwZ2R3y0iC6Y="
        crossorigin=""
    />

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'HVMIS') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Improved layout styles -->
    <style>
        /* Layout structure */
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
            transition: all 0.3s ease-in-out;
        }

        /* Main content area */
        .main-content {
            flex: 1;
            min-width: 0;
            /* Prevents flex items from overflowing */
            transition: margin-left 0.3s ease-in-out;
            min-height: 100vh;
            overflow-y: auto;
        }

        /* Nested dropdown animations */
        [x-collapse] {
            transition-property: height;
            transition-duration: 0.3s;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
        }

        /* For mobile: prevent background scrolling when sidebar is open */
        body.sidebar-open {
            overflow: hidden;
        }

        /* Mobile sidebar overlay */
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

        /* Common transition for all animated elements */
        .transition-all {
            transition-property: all;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 300ms;
        }
    </style>
</head>

<body class="font-sans antialiased" :class="{ 'sidebar-open': sidebarOpen && isMobile }">
    <div class="app-container bg-gray-100" x-data="{
        sidebarOpen: false,
        sidebarCollapsed: localStorage.getItem('sidebarCollapsed') === 'true',
        isMobile: window.innerWidth < 768,

        init() {
            this.$watch('sidebarCollapsed', (val) => {
                localStorage.setItem('sidebarCollapsed', val);
            });

            window.addEventListener('resize', () => {
                this.isMobile = window.innerWidth < 768;
                if (!this.isMobile && this.sidebarOpen) {
                    this.sidebarOpen = false;
                }
            });
        }
    }">
        <!-- Sidebar Overlay (only visible on mobile) -->
        <div class="sidebar-overlay" :class="{ 'active': sidebarOpen && isMobile }" @click="sidebarOpen = false">
        </div>

        <!-- Sidebar Component -->
        <aside class="sidebar bg-white shadow"
            :class="{
                'w-64': !sidebarCollapsed && !isMobile,
                'w-20': sidebarCollapsed && !isMobile,
                'w-64 transform -translate-x-full': !sidebarOpen && isMobile,
                'w-64 transform translate-x-0': sidebarOpen && isMobile
            }">
            {{--@if (auth()->user()->isAdmin() || auth()->user()->isSystemUser())
                @include('components.sidebar')
            @else
                @include('components.layouts.client-sidebar')
            @endif--}}

            @include('components.sidebar')

        </aside>
        <!-- Main Content -->
        <main class="main-content"
            :class="{
                'ml-64': !sidebarCollapsed && !isMobile,
                'ml-20': sidebarCollapsed && !isMobile,
                'ml-0': isMobile
            }">
            <div class="relative">
                <!-- Mobile menu button (only visible on mobile) -->
                <button x-show="isMobile" @click="sidebarOpen = !sidebarOpen" type="button"
                    class="fixed top-4 left-4 z-50 inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="h-6 w-6" x-bind:class="{ 'hidden': sidebarOpen, 'block': !sidebarOpen }"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg class="h-6 w-6" x-bind:class="{ 'block': sidebarOpen, 'hidden': !sidebarOpen }"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <div class="sticky top-0 z-50 border-b border-gray-200 shadow-sm pt-2 pb-2
           bg-gradient-to-r from-blue-300 via-blue-500 to-blue-600">
                <x-header/>
            </div>

                {{--@if (auth()->user()->isSystemUser())
                    <!-- Global Search Bar -->
                    <livewire:global-routes-search />
                    <hr />
                @endif

                <!-- Global Search Bar -->
                    <livewire:global-routes-search />
                    <hr />
                    --}}
                <!-- Page Heading -->
                @if (isset($header))
                    <header class="bg-white shadow">
                        <div class="px-4 py-6 mx-auto sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endif

                <!-- Page Content -->
                <div class="py-6">
                    <div class="px-4 mx-auto max-w-12xl sm:px-6 lg:px-8">

                        {{-- Global flash dialog --}}
                        {{-- @if (session()->has('success') || session()->has('error'))
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
                        @endif --}}
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </main>
    </div>
    {{-- Before closing </body> --}}
    <script
        src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-o9N1j7kGStpht/7VDaNhPHzGmGr2P2lbwZ2R3y0iC6Y="
        crossorigin=""
    ></script>
</body>

</html>
