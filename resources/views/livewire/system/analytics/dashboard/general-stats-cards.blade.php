<div class="p-6">
    <div class="grid grid-cols-1 gap-6 md:grid-cols-4">

        {{-- Premises Owners --}}
        <div class="flex flex-col h-full p-6 bg-white border-t-4 border-yellow-600 rounded-lg shadow-md">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-700">Premises Owners</h3>
                <div class="p-3 bg-indigo-100 rounded-full">
                    <x-icons.users />
                </div>
            </div>
            <div class="mt-2">
                <span class="text-3xl font-bold text-yellow-600">{{ number_format($ownerCount) }}</span>
            </div>
            <div class="flex items-center mt-4">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-4 w-4 {{ $ownerTrend >= 0 ? 'text-green-500' : 'text-red-500' }}"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="{{ $ownerTrend >= 0 ? 'M13 7h8m0 0v8m0-8l-8 8-4-4-6 6' : 'M13 17h8m0 0V9m0 8l-8-8-4 4-6-6' }}" />
                </svg>
                <span class="ml-1 {{ $ownerTrend >= 0 ? 'text-green-500' : 'text-red-500' }} font-medium">
                    {{ abs($ownerTrend) }}% {{ $ownerTrend >= 0 ? 'increase' : 'decrease' }}
                </span>
                <span class="ml-1 text-sm text-gray-500">since last month</span>
            </div>
        </div>

        {{-- Premises --}}
        <div class="flex flex-col h-full p-6 bg-white border-t-4 border-indigo-600 rounded-lg shadow-md">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-700">Premises</h3>
                <div class="p-3 bg-indigo-100 rounded-full">
                     <x-icons.building />
                </div>
            </div>
            <div class="mt-2">
                <span class="text-3xl font-bold text-indigo-600">{{ number_format($premisesCount) }}</span>
            </div>
            <div class="flex items-center mt-4">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-4 w-4 {{ $premisesTrend >= 0 ? 'text-green-500' : 'text-red-500' }}"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="{{ $premisesTrend >= 0 ? 'M13 7h8m0 0v8m0-8l-8 8-4-4-6 6' : 'M13 17h8m0 0V9m0 8l-8-8-4 4-6-6' }}" />
                </svg>
                <span class="ml-1 {{ $premisesTrend >= 0 ? 'text-green-500' : 'text-red-500' }} font-medium">
                    {{ abs($premisesTrend) }}% {{ $premisesTrend >= 0 ? 'increase' : 'decrease' }}
                </span>
                <span class="ml-1 text-sm text-gray-500">since last month</span>
            </div>
        </div>

        {{-- Applications --}}
        <div class="flex flex-col h-full p-6 bg-white border-t-4 border-sky-500 rounded-lg shadow-md">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-700">Applications</h3>
                <div class="p-3 bg-sky-100 rounded-full">
                    <x-icons.permit />
                </div>
            </div>
            <div class="mt-2">
                <span class="text-3xl font-bold text-sky-500">{{ number_format($applicationCount) }}</span>
            </div>
            <div class="flex items-center mt-4">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-4 w-4 {{ $applicationTrend >= 0 ? 'text-green-500' : 'text-red-500' }}"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="{{ $applicationTrend >= 0 ? 'M13 7h8m0 0v8m0-8l-8 8-4-4-6 6' : 'M13 17h8m0 0V9m0 8l-8-8-4 4-6-6' }}" />
                </svg>
                <span class="ml-1 {{ $applicationTrend >= 0 ? 'text-green-500' : 'text-red-500' }} font-medium">
                    {{ abs($applicationTrend) }}% {{ $applicationTrend >= 0 ? 'increase' : 'decrease' }}
                </span>
                <span class="ml-1 text-sm text-gray-500">since last month</span>
            </div>
        </div>

        {{-- Prescribed Activities --}}
        <div class="flex flex-col h-full p-6 bg-white border-t-4 border-emerald-500 rounded-lg shadow-md">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-700">Prescribed Activities</h3>
                <div class="p-3 bg-emerald-100 rounded-full">
                    <x-icons.activity />
                </div>
            </div>
            <div class="mt-2">
                <span class="text-3xl font-bold text-emerald-500">{{ number_format($activityCount) }}</span>
            </div>
            <div class="flex items-center mt-4">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-4 w-4 {{ $activityTrend >= 0 ? 'text-green-500' : 'text-red-500' }}"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="{{ $activityTrend >= 0 ? 'M13 7h8m0 0v8m0-8l-8 8-4-4-6 6' : 'M13 17h8m0 0V9m0 8l-8-8-4 4-6-6' }}" />
                </svg>
                <span class="ml-1 {{ $activityTrend >= 0 ? 'text-green-500' : 'text-red-500' }} font-medium">
                    {{ abs($activityTrend) }}% {{ $activityTrend >= 0 ? 'increase' : 'decrease' }}
                </span>
                <span class="ml-1 text-sm text-gray-500">since last month</span>
            </div>
        </div>

    </div>
</div>
