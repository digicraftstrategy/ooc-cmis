<?php

namespace App\Livewire\System\Analytics\Dashboard;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\PublicationPremises;

class PremisesChart extends Component
{
    public array $labels = [];
    public array $data = [];

    public function mount()
    {
        // Generate labels for the last 6 months
        $months = collect(range(0, 5))->map(function ($i) {
            return Carbon::now()->subMonths($i);
        })->reverse();

        $this->labels = $months->map(fn($m) => $m->format('M'))->toArray();

        // Count total premises created each month
        $this->data = $months->map(function ($m) {
            return PublicationPremises::whereMonth('created_at', $m->month)
                ->whereYear('created_at', $m->year)
                ->count();
        })->toArray();
    }

    public function render()
    {
        return view('livewire.system.analytics.dashboard.premises-chart');
    }
}
