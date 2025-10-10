<div class="bg-white shadow rounded-lg p-4">
    <h3 class="text-lg font-semibold text-gray-700 mb-2">Applications</h3>
    <div class="grid grid-cols-3 gap-4 text-center">
        
        <div>
            <p class="text-2xl font-bold text-gray-800">{{ $totalApplications }}</p>
            <p class="text-sm text-gray-500">Total</p>
        </div>
        <div>
            <p class="text-2xl font-bold text-yellow-600">{{ $pendingApplications }}</p>
            <p class="text-sm text-gray-500">Pending</p>
        </div>
        <div>
            <p class="text-2xl font-bold text-green-600">{{ $approvedApplications }}</p>
            <p class="text-sm text-gray-500">Approved</p>
        </div>
        
    </div>
</div>
