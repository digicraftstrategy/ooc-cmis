<div>
    {{-- General Stats --}}
    <livewire:system.analytics.dashboard.general-stats-cards lazy />

    <div class="mt-6">
        <div class="bg-white rounded-2xl p-4 shadow-sm border">
            <h2 class="text-lg font-semibold text-gray-700 mb-2">Premises Location Map</h2>
            <livewire:system.analytics.dashboard.premises-map />
        </div>
    </div>
    {{-- Applications & Premises Overview --}}
    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 mt-6">

        {{-- <div class="bg-white rounded-2xl p-4 shadow-sm border">
            <h2 class="text-lg font-semibold text-gray-700 mb-2">Premises Location Map</h2>
            <livewire:system.analytics.dashboard.premises-map />

        </div> --}}

        <div class="bg-white rounded-2xl p-4 shadow-sm border">
            <h2 class="text-lg font-semibold text-gray-700 mb-2">Applications Trend</h2>
            <livewire:system.analytics.dashboard.applications-chart />
        </div>

        <div class="bg-white rounded-2xl p-4 shadow-sm border">
            <h2 class="text-lg font-semibold text-gray-700 mb-2">Premises Growth Overview</h2>
            <livewire:system.analytics.dashboard.premises-chart />
        </div>
    </div>

    {{-- Owners & Activities --}}
    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 mt-6">
        <livewire:system.analytics.dashboard.owners-stats />
        <livewire:system.analytics.dashboard.activities-stats />
    </div>

    {{-- Geo Stats --}}
    <div class="mt-6">
        <livewire:system.analytics.dashboard.geo-stats />
    </div>

    {{-- Users --}}
    <div class="mt-6">
        <livewire:system.analytics.dashboard.users-stats />
    </div>
</div>
