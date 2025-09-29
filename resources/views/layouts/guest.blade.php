<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        
        <!-- Favicon -->
        <link rel="icon" type="image/x-icon" href="{{ asset('favicons/favicon.ico') }}">
        <link rel="icon" type="image/svg+xml" href="{{ asset('favicons/favicon.svg') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicons/apple-touch-icon.png') }}">
        <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicons/favicon-96x96.png') }}">
        <link rel="manifest" href="{{ asset('favicons/site.webmanifest') }}">
        <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('favicons/web-app-manifest-192x192.png') }}">
        <link rel="icon" type="image/png" sizes="512x512" href="{{ asset('favicons/web-app-manifest-512x512.png') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            'dark-blue': {
                                900: '#051F6C',
                                800: '#03174F',
                                700: '#02194A',
                                600: '#1E3A8A',
                                500: '#1D4ED8',
                                400: '#2563EB',
                                300: '#3B82F6',
                                200: '#93C5FD',
                                100: '#BFDBFE',
                            }
                        }
                    }
                }
            }
        </script>
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center mt-0 sm:pt-0 bg-gradient-to-br from-dark-blue-900 via-dark-blue-800 to-dark-blue-700">
            <div class="flex max-w-[1100px] w-full min-h-[550px] mt-20 pt-5 shadow-2xl shadow-dark-blue-500/25">
                <!-- Info Column -->
                <div class="flex-1 bg-dark-blue-600/85 backdrop-blur-md p-10 rounded-l-2xl text-white flex flex-col border-r border-white/10">
                    <!-- Logo and MIS Name Header -->
                    <div class="flex items-center justify-center mb-10 bg-blue-100/10 p-2 rounded shadow-emerald-300/25">
                        <!-- Left Logo -->
                        <div class="flex-shrink-0 ml-4">
                            <x-application-logo-lg class="text-white h-10 w-auto" />
                        </div>

                        <!-- Centered MIS Name -->
                        <h1 class="text-2xl md:text-3xl font-semibold text-center">
                            Censorship Management Information System
                        </h1>

                        <!-- Right Logo -->
                        <div class="flex-shrink-0 mr-4">
                            <x-application-logo class="text-white h-10 w-auto" />
                        </div>
                    </div>

                    <div class="mb-8">
                        <h2 class="text-xl font-semibold mb-5 text-gray-200 border-b-2 border-blue-500/50 pb-3">How to Login to Your Account</h2>

                        {{--<div class="flex items-start mb-5">
                            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-dark-blue-500 to-dark-blue-600 flex items-center justify-center mr-4 flex-shrink-0 font-bold text-sm shadow-md">1</div>
                            <div class="flex-1">
                                <h3 class="text-lg text-gray-100 font-medium mb-1">Enter Your Credentials</h3>
                                <p class="text-sm opacity-80 leading-relaxed">Use your username and password that you created during registration.</p>
                            </div>
                        </div>

                        <div class="flex items-start mb-5">
                            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-dark-blue-500 to-dark-blue-600 flex items-center justify-center mr-4 flex-shrink-0 font-bold text-sm shadow-md">2</div>
                            <div class="flex-1">
                                <h3 class="text-lg text-gray-100 font-medium mb-1">Two-Factor Authentication</h3>
                                <p class="text-sm opacity-80 leading-relaxed">If enabled, verify your identity with a code from your authenticator app.</p>
                            </div>
                        </div>

                        <div class="flex items-start mb-5">
                            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-dark-blue-500 to-dark-blue-600 flex items-center justify-center mr-4 flex-shrink-0 font-bold text-sm shadow-md">3</div>
                            <div class="flex-1">
                                <h3 class="text-lg text-gray-100 font-medium mb-1">Access Your Dashboard</h3>
                                <p class="text-sm opacity-80 leading-relaxed">Once authenticated, you'll be redirected to your personal dashboard.</p>
                            </div>
                        </div>--}}
                    </div>
                    <div class="mb-8">
                        <h2 class="text-xl font-semibold mb-5 text-gray-200 border-b-2 border-blue-500/50 pb-3">Onboarding Process for New Clients</h2>

                        {{--<div class="flex items-start mb-5">
                            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-dark-blue-500 to-dark-blue-600 flex items-center justify-center mr-4 flex-shrink-0 font-bold text-sm shadow-md">1</div>
                            <div class="flex-1">
                                <h3 class="text-lg text-gray-100 font-medium mb-1">Enter Your Credentials</h3>
                                <p class="text-sm opacity-80 leading-relaxed">Use your username and password that you created during registration.</p>
                            </div>
                        </div>

                        <div class="flex items-start mb-5">
                            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-dark-blue-500 to-dark-blue-600 flex items-center justify-center mr-4 flex-shrink-0 font-bold text-sm shadow-md">2</div>
                            <div class="flex-1">
                                <h3 class="text-lg text-gray-100 font-medium mb-1">Two-Factor Authentication</h3>
                                <p class="text-sm opacity-80 leading-relaxed">If enabled, verify your identity with a code from your authenticator app.</p>
                            </div>
                        </div>

                        <div class="flex items-start mb-5">
                            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-dark-blue-500 to-dark-blue-600 flex items-center justify-center mr-4 flex-shrink-0 font-bold text-sm shadow-md">3</div>
                            <div class="flex-1">
                                <h3 class="text-lg text-gray-100 font-medium mb-1">Access Your Dashboard</h3>
                                <p class="text-sm opacity-80 leading-relaxed">Once authenticated, you'll be redirected to your personal dashboard.</p>
                            </div>
                        </div>--}}
                    </div>

                    <div class="mt-auto text-sm bg-blue-900/15 p-4 rounded-xl text-center">
                        <p><i class="fas fa-question-circle mr-1"></i> Need help? <a href="#" class="text-blue-300 font-medium hover:text-blue-400 hover:underline transition-colors">Contact support</a></p>
                    </div>
                </div>

                <!-- Form Column -->
                <div class="flex-1 bg-white rounded-r-2xl flex flex-col justify-center">
                    <div class="w-full px-8 py-10 bg-white overflow-hidden">
                        {{ $slot }}
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="flex justify-between items-center w-full max-w-[1100px] mt-auto py-5">
                <div class="flex gap-5">
                    <a href="#" class="text-white/70 text-xs hover:text-blue-300 hover:underline transition-colors">Terms of Service</a>
                    <a href="#" class="text-white/70 text-xs hover:text-blue-300 hover:underline transition-colors">Privacy Policy</a>
                    <a href="#" class="text-white/70 text-xs hover:text-blue-300 hover:underline transition-colors">Data Protection</a>
                    <a href="#" class="text-white/70 text-xs hover:text-blue-300 hover:underline transition-colors">Cookie Policy</a>
                </div>

                <div class="text-right">
                    <p class="text-white/70 text-xs">
                        Censorship Management Information System &copy; {{ date('Y') }}
                        <span class="mx-2">|</span>
                        App v{{ config('app.version', '1.0.0') }}
                    </p>
                </div>
            </div>
        </div>
    </body>
</html>
