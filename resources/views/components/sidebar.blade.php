<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component {
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        // Redirect to the home page after logout
        $this->redirect('/', navigate: true);
    }
}; ?>

<div x-data="{
    // State management with localStorage
    reportsOpen: localStorage.getItem('reportsOpen') === 'true',
    paymentsOpen: localStorage.getItem('paymentsOpen') === 'true',
    invoicesOpen: localStorage.getItem('invoicesOpen') === 'true',
    settingsOpen: localStorage.getItem('settingsOpen') === 'true',
    cdrOpen: localStorage.getItem('cdrOpen') === 'true',
    systemOpen: localStorage.getItem('systemOpen') === 'true',
    licenseManagement: localStorage.getItem('licenseManagement') === 'true',
    systemSecurityOpen: localStorage.getItem('systemSecurityOpen') === 'true',
    clientManagementOpen: localStorage.getItem('clientManagementOpen') === 'true',
    publicationPremisesOpen: localStorage.getItem('publicationPremisesOpen') === 'true',
    filmsPublicationOpen: localStorage.getItem('filmsPublicationOpen') === 'true',

    userMenuOpen: false,
    //sidebarCollapsed: false,
    isMobile: window.innerWidth < 1024,

    init() {
        this.isMobile = window.innerWidth < 1024;

        window.addEventListener('resize', () => {
            this.isMobile = window.innerWidth < 1024;
        });

        // Initialize all dropdown watchers
        this.watchDropdownState('reportsOpen');
        this.watchDropdownState('paymentsOpen');
        this.watchDropdownState('invoicesOpen');
        this.watchDropdownState('settingsOpen');
        this.watchDropdownState('cdrOpen');
        this.watchDropdownState('systemOpen');
        this.watchDropdownState('licenseManagement');
        this.watchDropdownState('systemSecurityOpen');
        this.watchDropdownState('clientManagementOpen');
        this.watchDropdownState('publicationPremisesOpen');
        this.watchDropdownState('filmsPublicationOpen');
    },

    // Persist dropdown state to localStorage
    watchDropdownState(stateName) {
        this.$watch(stateName, value => {
            localStorage.setItem(stateName, value);
        });
    },

    // Toggle dropdown with proper collapsed state handling
    toggleDropdown(dropdownName) {
        if (this.sidebarCollapsed && !this.isMobile) {
            this[dropdownName] = true;
        } else {
            this[dropdownName] = !this[dropdownName];
        }
    }
}"
 class="flex flex-col h-full bg-gradient-to-b from-slate-900 to-slate-800 text-white">

    <!-- Header -->
    <div class="sticky top-0 z-10 flex items-center justify-between h-20 px-4 border-b border-slate-700 bg-slate-900">
        <span x-show="!sidebarCollapsed || isMobile"
            class="px-4 text-lg font-bold-medium text-blue-400 transition-opacity duration-300">{{ config('app.name') }} Admin Panel</span>
        <div class="flex-shrink-0 ml-0">
            {{--<x-application-logo class="text-white" />
            <h1 class="px-4 text-lg font-bold text-blue-400 transition-opacity duration-300">Admin Panel</h1>--}}
        </div>
        <!-- Collapse/Expand Button (Desktop only) -->
        <button @click="sidebarCollapsed = !sidebarCollapsed"
            class="hidden rounded-md hover:bg-slate-700 focus:outline-none lg:block transition-colors duration-200">
            <svg x-show="!sidebarCollapsed" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            <svg x-show="sidebarCollapsed" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </button>
    </div>

    <!-- Navigation (Scrollable) -->
    <nav class="flex-1 py-4 overflow-y-scroll scrollbar-none">
        <div class="py-1 space-y-1">

            <!-- Dashboard Link -->
            <x-sidebar-dashboard-link route="dashboard" wire:navigate
                class="flex items-center w-full py-3 text-slate-200 rounded-lg hover:bg-blue-600/20 hover:text-white group transition-colors duration-200">
                <svg class="w-5 h-5 text-blue-400 group-hover:text-blue-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                </svg>
                <span x-show="!sidebarCollapsed || isMobile" class="ml-3 transition-opacity duration-300">Dashboard</span>
            </x-sidebar-dashboard-link>

            <!-- Reports -->
            <div class="py-1">
                <button @click="toggleDropdown('reportsOpen')"
                    class="flex items-center w-full px-4 py-3 text-slate-200 transition duration-150 rounded-lg hover:bg-blue-600/20 hover:text-white group mx-2">
                    <svg class="w-5 h-5 text-purple-400 group-hover:text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <span x-show="!sidebarCollapsed || isMobile" class="ml-3 transition-opacity duration-300">Reports</span>
                    <svg x-show="!sidebarCollapsed || isMobile" :class="{ 'rotate-90': reportsOpen }"
                        class="w-4 h-4 ml-auto transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
                <div x-show="(!sidebarCollapsed || isMobile) && reportsOpen" x-collapse class="mt-1 space-y-1 ml-4">
                    <!-- Report items would go here -->
                </div>
            </div>

            <!-- Payments -->
            <div class="py-1">
                <button @click="toggleDropdown('paymentsOpen')"
                    class="flex items-center w-full px-4 py-3 text-slate-200 transition duration-150 rounded-lg hover:bg-blue-600/20 hover:text-white group mx-2">
                    <svg class="w-5 h-5 text-green-400 group-hover:text-green-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span x-show="!sidebarCollapsed || isMobile" class="ml-3 transition-opacity duration-300">Payments</span>
                    <svg x-show="!sidebarCollapsed || isMobile" :class="{ 'rotate-90': paymentsOpen }"
                        class="w-4 h-4 ml-auto transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
                <div x-show="(!sidebarCollapsed || isMobile) && paymentsOpen" x-collapse class="mt-1 space-y-1 ml-4">
                    {{--<x-sidebar-link route="payments.overview" wire:navigate
                        class="block px-4 py-2 ml-4 text-slate-300 transition duration-150 rounded-lg hover:bg-blue-600/20 hover:text-white">
                        Payment Overview
                    </x-sidebar-link>
                    <x-sidebar-link route="payments.transactions" wire:navigate
                        class="block px-4 py-2 ml-4 text-slate-300 transition duration-150 rounded-lg hover:bg-blue-600/20 hover:text-white">
                        Payment Transactions
                    </x-sidebar-link>
                    <x-sidebar-link route="payments.reconciliation" wire:navigate
                        class="block px-4 py-2 ml-4 text-slate-300 transition duration-150 rounded-lg hover:bg-blue-600/20 hover:text-white">
                        Reconciliation
                    </x-sidebar-link>--}}
                </div>
            </div>

            <!-- Invoices -->
            <div class="py-1">
                <button @click="toggleDropdown('invoicesOpen')"
                    class="flex items-center w-full px-4 py-3 text-slate-200 transition duration-150 rounded-lg hover:bg-blue-600/20 hover:text-white group mx-2">
                    <svg class="w-5 h-5 text-orange-400 group-hover:text-orange-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                    </svg>
                    <span x-show="!sidebarCollapsed || isMobile" class="ml-3 transition-opacity duration-300">Invoices</span>
                    <svg x-show="!sidebarCollapsed || isMobile" :class="{ 'rotate-90': invoicesOpen }"
                        class="w-4 h-4 ml-auto transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
                <div x-show="(!sidebarCollapsed || isMobile) && invoicesOpen" x-collapse class="mt-1 space-y-1 ml-4">
                    {{--<x-sidebar-link route="invoices.list" wire:navigate
                        class="block px-4 py-2 ml-4 text-slate-300 transition duration-150 rounded-lg hover:bg-blue-600/20 hover:text-white">
                        All Invoices
                    </x-sidebar-link>
                    <x-sidebar-link route="invoices.create" wire:navigate
                        class="block px-4 py-2 ml-4 text-slate-300 transition duration-150 rounded-lg hover:bg-blue-600/20 hover:text-white">
                        Create Invoice
                    </x-sidebar-link>
                    <x-sidebar-link route="invoices.templates" wire:navigate
                        class="block px-4 py-2 ml-4 text-slate-300 transition duration-150 rounded-lg hover:bg-blue-600/20 hover:text-white">
                        Invoice Templates
                    </x-sidebar-link>
                    <x-sidebar-link route="invoices.settings" wire:navigate
                        class="block px-4 py-2 ml-4 text-slate-300 transition duration-150 rounded-lg hover:bg-blue-600/20 hover:text-white">
                        Invoice Settings
                    </x-sidebar-link>--}}
                </div>
            </div>

            <!-- Client Management -->
            <div class="py-1">
                <button @click="toggleDropdown('clientManagementOpen')"
                    class="flex items-center w-full px-4 py-3 text-slate-200 transition duration-150 rounded-lg hover:bg-blue-600/20 hover:text-white group mx-2">
                    <svg class="w-5 h-5 text-cyan-400 group-hover:text-cyan-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <span x-show="!sidebarCollapsed || isMobile" class="ml-3 transition-opacity duration-300">Client Management</span>
                    <svg x-show="!sidebarCollapsed || isMobile" :class="{ 'rotate-90': clientManagementOpen }"
                        class="w-4 h-4 ml-auto transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
                <div x-show="(!sidebarCollapsed || isMobile) && clientManagementOpen" x-collapse class="mt-1 space-y-1 ml-4">
                    <x-sidebar-link route="admin.publication-premises.premises-owner" wire:navigate
                        class="block px-4 py-2 ml-4 text-slate-300 transition duration-150 rounded-lg hover:bg-blue-600/20 hover:text-white">
                        Premises Owners
                    </x-sidebar-link>
                </div>
            </div>

            <!-- Publication Premises -->
            <div class="py-1">
                <button @click="toggleDropdown('publicationPremisesOpen')"
                    class="flex items-center w-full px-4 py-3 text-slate-200 transition duration-150 rounded-lg hover:bg-blue-600/20 hover:text-white group mx-2">
                    <svg class="w-5 h-5 text-emerald-400 group-hover:text-emerald-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                    <span x-show="!sidebarCollapsed || isMobile" class="ml-3 transition-opacity duration-300">Publication Premises</span>
                    <svg x-show="!sidebarCollapsed || isMobile" :class="{ 'rotate-90': publicationPremisesOpen }"
                        class="w-4 h-4 ml-auto transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
                <div x-show="(!sidebarCollapsed || isMobile) && publicationPremisesOpen" x-collapse class="mt-1 space-y-1 ml-4">
                    <!-- Publication Premises items would go here -->
                </div>
            </div>

            <!-- Films & Publication Management -->
            <div class="py-1">
                <button @click="toggleDropdown('filmsPublicationOpen')"
                    class="flex items-center w-full px-4 py-3 text-slate-200 transition duration-150 rounded-lg hover:bg-blue-600/20 hover:text-white group mx-2">
                    <svg class="w-5 h-5 text-amber-400 group-hover:text-amber-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z" />
                    </svg>
                    <span x-show="!sidebarCollapsed || isMobile" class="ml-3 transition-opacity duration-300">Films & Publications</span>
                    <svg x-show="!sidebarCollapsed || isMobile" :class="{ 'rotate-90': filmsPublicationOpen }"
                        class="w-4 h-4 ml-auto transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
                <div x-show="(!sidebarCollapsed || isMobile) && filmsPublicationOpen" x-collapse class="mt-1 space-y-1 ml-4">
                    <x-sidebar-link route="admin.classifications.manage-classifications" wire:navigate
                        class="block px-4 py-2 ml-4 text-slate-300 transition duration-150 rounded-lg hover:bg-blue-600/20 hover:text-white">
                        Manage Classifications
                    </x-sidebar-link>
                    <x-sidebar-link route="admin.classifications.films" wire:navigate
                        class="block px-4 py-2 ml-4 text-slate-300 transition duration-150 rounded-lg hover:bg-blue-600/20 hover:text-white">
                        Films
                    </x-sidebar-link>
                    <x-sidebar-link route="admin.classifications.film-types" wire:navigate
                        class="block px-4 py-2 ml-4 text-slate-300 transition duration-150 rounded-lg hover:bg-blue-600/20 hover:text-white">
                        Film Types
                    </x-sidebar-link>
                    <x-sidebar-link route="admin.classifications.tv-series" wire:navigate
                        class="block px-4 py-2 ml-4 text-slate-300 transition duration-150 rounded-lg hover:bg-blue-600/20 hover:text-white">
                        TV Series
                    </x-sidebar-link>
                </div>
            </div>

            <!-- System -->
            <div class="py-1">
                <button @click="toggleDropdown('systemOpen')"
                    class="flex items-center w-full px-4 py-3 text-slate-200 transition duration-150 rounded-lg hover:bg-blue-600/20 hover:text-white group mx-2">
                    <svg class="w-5 h-5 text-blue-400 group-hover:text-blue-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01" />
                    </svg>
                    <span x-show="!sidebarCollapsed || isMobile" class="ml-3 transition-opacity duration-300">System Variables</span>
                    <svg x-show="!sidebarCollapsed || isMobile" :class="{ 'rotate-90': systemOpen }"
                        class="w-4 h-4 ml-auto transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
                <div x-show="(!sidebarCollapsed || isMobile) && systemOpen" x-collapse class="mt-1 space-y-1 ml-4">
                    <x-sidebar-link route="system.user-types" wire:navigate
                        class="block px-4 py-2 ml-4 text-slate-300 transition duration-150 rounded-lg hover:bg-blue-600/20 hover:text-white">
                        User Types
                    </x-sidebar-link>
                    <x-sidebar-link route="system.prescribed-activities" wire:navigate
                        class="block px-4 py-2 ml-4 text-slate-300 transition duration-150 rounded-lg hover:bg-blue-600/20 hover:text-white">
                        Prescribed Activities
                    </x-sidebar-link>
                    <x-sidebar-link route="system.prescribed-activity-types" wire:navigate
                        class="block px-4 py-2 ml-4 text-slate-300 transition duration-150 rounded-lg hover:bg-blue-600/20 hover:text-white">
                        Prescribed Activity Types
                    </x-sidebar-link>
                    <x-sidebar-link route="admin.classifications.classification-ratings" wire:navigate
                        class="block px-4 py-2 ml-4 text-slate-300 transition duration-150 rounded-lg hover:bg-blue-600/20 hover:text-white">
                        Classification Ratings
                    </x-sidebar-link>
                    <x-sidebar-link route="system.provinces" wire:navigate
                        class="block px-4 py-2 ml-4 text-slate-300 transition duration-150 rounded-lg hover:bg-blue-600/20 hover:text-white">
                        Provinces
                    </x-sidebar-link>
                    <x-sidebar-link route="system.regions" wire:navigate
                        class="block px-4 py-2 ml-4 text-slate-300 transition duration-150 rounded-lg hover:bg-blue-600/20 hover:text-white">
                        Regions
                    </x-sidebar-link>
                </div>
            </div>

            <!-- System Security -->
            <div class="py-1">
                <button @click="toggleDropdown('systemSecurityOpen')"
                    class="flex items-center w-full px-4 py-3 text-slate-200 transition duration-150 rounded-lg hover:bg-blue-600/20 hover:text-white group mx-2">
                    <svg class="w-5 h-5 text-red-400 group-hover:text-red-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                    <span x-show="!sidebarCollapsed || isMobile" class="ml-3 transition-opacity duration-300">System Security</span>
                    <svg x-show="!sidebarCollapsed || isMobile" :class="{ 'rotate-90': systemSecurityOpen }"
                        class="w-4 h-4 ml-auto transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
                <div x-show="(!sidebarCollapsed || isMobile) && systemSecurityOpen" x-collapse class="mt-1 space-y-1 ml-4">
                    <x-sidebar-link route="system.roles" wire:navigate
                        class="block px-4 py-2 ml-4 text-slate-300 transition duration-150 rounded-lg hover:bg-blue-600/20 hover:text-white">
                        Roles Management
                    </x-sidebar-link>
                    <x-sidebar-link route="system.permissions" wire:navigate
                        class="block px-4 py-2 ml-4 text-slate-300 transition duration-150 rounded-lg hover:bg-blue-600/20 hover:text-white">
                        Permissions Management
                    </x-sidebar-link>
                </div>
            </div>
        </div>
    </nav>

    <!-- Footer (only visible when sidebar is expanded) -->
    <div x-show="!sidebarCollapsed && !isMobile" class="px-4 py-2 text-center border-t border-slate-700">
        <span class="text-xs text-slate-500">© 2025 {{ config('app.name') }} v{{ config('app.version') }}</span>
    </div>
</div>

<!-- Mobile Toggle Button (Fixed Position) -->
<button x-show="isMobile" @click="sidebarOpen = !sidebarOpen"
    class="fixed z-40 p-3 text-white bg-blue-600 rounded-full shadow-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 lg:hidden bottom-4 right-4 transition-colors duration-200">
    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            :d="sidebarOpen ? 'M6 18L18 6M6 6l12 12' : 'M4 6h16M4 12h16M4 18h16'" />
    </svg>
</button>
