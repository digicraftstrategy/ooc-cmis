<div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50 py-8">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-2xl shadow-2xl overflow-hidden mb-8">
            <div class="p-6 md:p-8">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div class="flex items-center gap-4">
                        <x-blue-button-link-sm href="{{ route('admin.publication-premises.premises-owner') }}" wire:navigate
                            class="bg-white/10 hover:bg-white/20 text-white border-white/20 backdrop-blur-sm">
                            <x-icons.arrow-left class="w-4 h-4" />
                            Owners
                        </x-blue-button-link-sm>
                        <div>
                            <h1 class="text-2xl md:text-3xl font-bold text-white">Owner Details</h1>
                            <p class="text-blue-100 mt-1">Complete information about {{ $premisesOwner->owners_name }}</p>
                        </div>
                    </div>
                    <div class="flex flex-wrap gap-3">
                        <x-blue-button-link href="#" wire:navigate
                            class="bg-white/10 gap-2 hover:bg-white/20 text-white border-white/20 backdrop-blur-sm">
                            <x-icons.pencil-square class="w-5 h-5" />
                            Manage Films & Publications
                        </x-blue-button-link>
                        <x-blue-button-link href="{{ route('admin.publication-premises.premises', $premisesOwner->uuid) }}" wire:navigate
                            class="bg-white/10 gap-2 hover:bg-white/20 text-white border-white/20 backdrop-blur-sm">
                            <x-icons.pencil-square class="w-5 h-5" />
                            Manage Premises
                        </x-blue-button-link>
                        <x-blue-button-link href="#" wire:navigate
                            class="bg-white/10 gap-2hover:bg-white/20 text-white border-white/20 backdrop-blur-sm">
                            <x-icons.pencil-square class="w-5 h-5" />
                            Manage Users
                        </x-blue-button-link>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column - Owner Information -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Owner Profile Card -->
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                    <div class="p-6 md:p-8 border-b border-gray-100">
                        <div class="flex items-center gap-6">
                            <div class="p-4 bg-blue-100 rounded-2xl">
                                <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-8 0H5m2 0h4M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-2xl md:text-3xl font-bold text-gray-800">{{ $premisesOwner->owners_name }}</h2>
                                <div class="flex items-center gap-3 mt-2">
                                    <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-sm font-medium">{{ $premisesOwner->premises_type->type }}</span>
                                    <span class="text-gray-500 text-sm">System generated Unique Owner ID: {{ substr($premisesOwner->uuid, 0, 8) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="p-6 md:p-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Contact Information -->
                            <div class="bg-blue-50 rounded-xl p-6">
                                <h3 class="flex items-center gap-2 text-sm font-semibold text-blue-700 uppercase tracking-wide mb-4">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                    Contact Information
                                </h3>
                                <div class="space-y-4">
                                    <div>
                                        <p class="text-xs font-medium text-gray-500">Phone Number</p>
                                        <p class="text-lg font-semibold text-gray-800">{{ $premisesOwner->phone }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs font-medium text-gray-500">Email Address</p>
                                        <p class="text-lg font-semibold text-gray-800">{{ $premisesOwner->email }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Address Information -->
                            <div class="bg-gray-50 rounded-xl p-6">
                                <h3 class="flex items-center gap-2 text-sm font-semibold text-gray-700 uppercase tracking-wide mb-4">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    Address & Website
                                </h3>

                                <div class="space-y-4">
                                    <!-- Physical Address -->
                                    <div>
                                        <p class="text-xs font-medium text-gray-500 mb-1">Physical Address</p>
                                        <p class="text-gray-700 leading-relaxed">{{ $premisesOwner->address }}</p>
                                    </div>

                                    <!-- Divider -->
                                    <div class="border-t border-gray-200 my-2"></div>

                                    <!-- Website -->
                                    <div>
                                        <p class="text-xs font-medium text-gray-500 mb-1">Website</p>
                                        <div class="flex items-center gap-2">
                                            <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path>
                                            </svg>
                                            <a href="https://www.ownerbusiness.com" target="_blank" class="text-blue-600 hover:text-blue-800 font-medium transition-colors duration-200">
                                                {{$premisesOwner->owners_name}}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Timeline Information -->
                            <div class="bg-purple-50 rounded-xl p-6">
                                <h3 class="flex items-center gap-2 text-sm font-semibold text-purple-700 uppercase tracking-wide mb-4">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Registration Timeline
                                </h3>
                                <div class="space-y-4">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-xs font-medium text-gray-500">Registered On</p>
                                            <p class="text-sm font-semibold text-gray-800">{{ $premisesOwner->created_at->format('F d, Y') }}</p>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-xs font-medium text-gray-500">Last Updated</p>
                                            <p class="text-sm font-semibold text-gray-800">{{ $premisesOwner->updated_at->format('F d, Y') }}</p>
                                        </div>
                                    </div>
                                    <div class="relative pt-4">
                                        <div class="absolute left-0 top-0 w-full h-2 bg-gray-200 rounded-full"></div>
                                        <div class="absolute left-0 top-0 h-2 bg-blue-500 rounded-full" style="width: 75%"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Quick Actions -->
                            <div class="bg-green-50 rounded-xl p-6">
                                <h3 class="flex items-center gap-2 text-sm font-semibold text-green-700 uppercase tracking-wide mb-4">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                    Quick Actions
                                </h3>
                                <div class="space-y-3">
                                    <x-blue-button-link href="{{ route('admin.publication-premises.premises.edit', $premisesOwner->uuid) }}" wire:navigate
                                        class="w-full justify-center gap-2 text-gray-700 hover:bg-blue-50 border border-blue-300 shadow-sm">
                                        <x-icons.pencil-square class="w-5 h-5" />
                                        Edit Owner Details
                                    </x-blue-button-link>
                                    <button class="w-full flex items-center justify-center gap-2 px-4 py-3 bg-white text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors duration-200 shadow-sm">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                        Generate Report
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Premises Statistics -->
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden p-6 md:p-8">
                    <h3 class="flex items-center gap-2 text-xl font-bold text-gray-800 mb-6">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        Premises Statistics
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        <!-- Total Premises -->
                        <div class="bg-gradient-to-br from-blue-500 to-blue-600 text-white rounded-xl p-6 shadow-lg">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-blue-100">Total Premises</p>
                                    <p class="text-3xl font-bold">{{ $premisesCount }}</p>
                                </div>
                                <div class="p-3 bg-white/20 rounded-lg">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-8 0H5m2 0h4M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="mt-2 text-xs text-blue-200">All registered premises</div>
                        </div>

                        <!-- Active Licenses -->
                        <div class="bg-gradient-to-br from-green-500 to-green-600 text-white rounded-xl p-6 shadow-lg">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-green-100">Active Licenses</p>
                                    <p class="text-3xl font-bold">0</p>
                                </div>
                                <div class="p-3 bg-white/20 rounded-lg">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="mt-2 text-xs text-green-200">Currently active licenses</div>
                        </div>

                        <!-- Expired Licenses -->
                        <div class="bg-gradient-to-br from-red-500 to-red-600 text-white rounded-xl p-6 shadow-lg">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-red-100">Expired Licenses</p>
                                    <p class="text-3xl font-bold">0</p>
                                </div>
                                <div class="p-3 bg-white/20 rounded-lg">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="mt-2 text-xs text-red-200">Licenses requiring renewal</div>
                        </div>

                        <!-- Pending Renewals -->
                        <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 text-white rounded-xl p-6 shadow-lg">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-yellow-100">Pending Renewals</p>
                                    <p class="text-3xl font-bold">0</p>
                                </div>
                                <div class="p-3 bg-white/20 rounded-lg">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="mt-2 text-xs text-yellow-200">Renewals in progress</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column - Additional Info -->
            <div class="space-y-8">
                <!-- Status Overview -->
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden p-6">
                    <h3 class="flex items-center gap-2 text-lg font-bold text-gray-800 mb-4">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                        Status Overview
                    </h3>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-3 bg-green-50 rounded-lg">
                            <span class="text-green-700 font-medium">Account Status</span>
                            <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm font-medium">Active</span>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-blue-50 rounded-lg">
                            <span class="text-blue-700 font-medium">Verification</span>
                            <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-sm font-medium">Verified</span>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-yellow-50 rounded-lg">
                            <span class="text-yellow-700 font-medium">Compliance</span>
                            <span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-sm font-medium">In Review</span>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden p-6">
                    <h3 class="flex items-center gap-2 text-lg font-bold text-gray-800 mb-4">
                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        Recent Activity
                    </h3>
                    <div class="space-y-4">
                        <div class="flex items-start gap-3">
                            <div class="p-2 bg-blue-100 rounded-lg mt-1">
                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-800">New premises added</p>
                                <p class="text-xs text-gray-500">2 days ago</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="p-2 bg-green-100 rounded-lg mt-1">
                                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-800">License renewed</p>
                                <p class="text-xs text-gray-500">1 week ago</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="p-2 bg-purple-100 rounded-lg mt-1">
                                <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-800">Contact information updated</p>
                                <p class="text-xs text-gray-500">2 weeks ago</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Notes Section -->
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden p-6">
                    <h3 class="flex items-center gap-2 text-lg font-bold text-gray-800 mb-4">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Notes
                    </h3>
                    <div class="bg-yellow-50 rounded-lg p-4">
                        <p class="text-sm text-yellow-700">This owner has special requirements for license renewals. Please contact them directly 30 days before expiration.</p>
                    </div>
                    <button class="w-full mt-4 flex items-center justify-center gap-2 px-4 py-3 bg-gray-100 text-gray-700 border border-gray-200 rounded-lg hover:bg-gray-200 transition-colors duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Add Note
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
