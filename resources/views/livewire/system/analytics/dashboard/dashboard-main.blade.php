<div>
    {{-- General Stats --}}
    <livewire:system.analytics.dashboard.general-stats-cards lazy />

    {{-- Applications & Premises --}}
    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 mt-4">
        <livewire:system.analytics.dashboard.applications-stats />
        <livewire:system.analytics.dashboard.premises-stats />
    </div>

    {{-- Owners & Activities --}}
    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 mt-4">
        <livewire:system.analytics.dashboard.owners-stats />
        <livewire:system.analytics.dashboard.activities-stats />
    </div>

    {{-- Geo Stats --}}
    <div class="mt-4">
        <livewire:system.analytics.dashboard.geo-stats />
    </div>

    {{-- Users --}}
    <div class="mt-4">
        <livewire:system.analytics.dashboard.users-stats />
    </div>
</div>

