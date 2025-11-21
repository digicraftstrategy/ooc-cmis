<div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50 py-6 px-4 sm:px-6 lg:px-8">

    <!-- Page Header -->
    <header class="mb-6">
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-xl shadow-lg overflow-hidden">
            <div class="px-6 py-6">
                <h1 class="text-xl md:text-2xl font-bold text-white mb-1">User Types</h1>
                <p class="text-blue-100 opacity-90 text-sm">Manage and review system-level user type definitions.</p>
            </div>
        </div>
    </header>

    <!-- Table Container -->
    <div class="bg-white rounded-xl shadow border overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <!-- Table Head -->
                <thead class="bg-gradient-to-r from-blue-50 to-indigo-50">
                    <tr>
                        <th class="px-4 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider text-left">
                            ID
                        </th>
                        <th class="px-4 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider text-left">
                            Type Name
                        </th>
                        <th class="px-4 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider text-left">
                            Slug
                        </th>
                        <th class="px-4 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider text-left">
                            Description
                        </th>
                        <th class="px-4 py-3 text-xs font-semibold text-blue-700 uppercase tracking-wider text-left">
                            Access Code
                        </th>
                    </tr>
                </thead>

                <!-- Table Body -->
                <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($userTypes as $userType)
                    <tr class="hover:bg-gray-50 transition-colors duration-150">
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-800 font-medium">
                            {{ $userType->id }}
                        </td>

                        <td class="px-4 py-3 whitespace-nowrap">
                            <span class="text-sm font-semibold text-gray-900">
                                {{ $userType->type_name }}
                            </span>
                        </td>

                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-700">
                            {{ $userType->slug }}
                        </td>

                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-700 max-w-xs">
                            <span class="truncate block">
                                {{ $userType->description }}
                            </span>
                        </td>

                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-700">
                            <span class="inline-flex items-center px-2 py-0.5 rounded-md text-xs font-medium bg-indigo-100 text-indigo-700 border border-indigo-200">
                                {{ $userType->access_code }}
                            </span>
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center">
                            <div class="flex flex-col items-center text-gray-400">
                                <svg class="w-10 h-10 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                          d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <p class="text-sm font-medium">No user types found</p>
                                <p class="text-xs mt-1">Try adding a new user type</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
