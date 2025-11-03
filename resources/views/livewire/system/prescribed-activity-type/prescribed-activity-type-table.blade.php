<div>
    <x-slot name='header'>
        <div class="px-2 py-2 bg-blue-100">
            <h2 class="text-xl font-semibold">
                Prescribed Activity Types
            </h2>
        </div>
    </x-slot>

    <!-- Table -->
    <div class="p-4 overflow-y-auto bg-white rounded-lg shadow">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-blue-50">
                <tr>
                    <th scope="col"
                        class="px-6 py-6 text-xs font-medium tracking-wider text-left text-blue-700 uppercase cursor-pointer">
                        ID
                    </th>
                    <th scope="col"
                        class="px-6 py-6 text-xs font-medium tracking-wider text-left  text-blue-700 uppercase cursor-pointer">
                        Prescribed Activity Type
                    </th>
                    <th scope="col"
                        class="px-6 py-6 text-xs font-medium tracking-wider text-left  text-blue-700 uppercase cursor-pointer">
                        Description
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($prescribedActivityTypes as $prescribedActivityType)
                    <tr>
                        <td class="px-4 py-2 ">{{ $prescribedActivityType->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $prescribedActivityType->type }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">
                                {{ $prescribedActivityType->description }}
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr class="px-6 text-left border">
                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                            No Prescibed Activity Type found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

