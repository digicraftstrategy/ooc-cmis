<div class="bg-white shadow rounded-lg p-4">
    <h3 class="text-lg font-semibold text-gray-700 mb-2">Premises</h3>
    <div class="grid grid-cols-3 gap-4 text-center">
         
        <div>
            <p class="text-2xl font-bold text-gray-800">{{ $totalPremises }}</p>
            <p class="text-sm text-gray-500">Total</p>
        </div>
        <div>
            <p class="text-2xl font-bold text-green-600">{{ $activePremises }}</p>
            <p class="text-sm text-gray-500">Active</p>
        </div>
        <div>
            <p class="text-2xl font-bold text-red-600">{{ $inactivePremises }}</p>
            <p class="text-sm text-gray-500">Inactive</p>
        </div>
        
    </div>
</div>
