<div class="mx-auto max-w-12xl sm:px-6 lg:px-8">

    @if (auth()->user()->isAdmin())
        <livewire:system.analytics.dashboard.dashboard-main />

    @elseif (auth()->user()->isSuperAdmin())
        <livewire:system.analytics.dashboard.dashboard-main />

    @elseif (auth()->user()->isRole('client'))
        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <livewire:client.dashboard.client-dashboard lazy />
            </div>
        </div>

    @elseif (auth()->user()->isRole('auditor'))
        <livewire:auditor.dashboard.auditor-dashboard />
    @endif

</div>

