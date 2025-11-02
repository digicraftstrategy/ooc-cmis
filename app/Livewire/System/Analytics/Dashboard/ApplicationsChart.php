<?php

namespace App\Livewire\System\Analytics\Dashboard;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\PremisesApplication;

class ApplicationsChart extends Component
{
    public array $labels = [];
    public array $data = [];

    public function mount()
    {
        // Example: count approved applications for last 6 months
        $months = collect(range(0, 5))->map(function ($i) {
            return Carbon::now()->subMonths($i);
        })->reverse();

        $this->labels = $months->map(fn($m) => $m->format('M'))->toArray();

        $this->data = $months->map(function ($m) {
            return PremisesApplication::whereMonth('created_at', $m->month)
                ->whereYear('created_at', $m->year)
                ->count();
        })->toArray();
    }

    public function render()
    {
        return view('livewire.system.analytics.dashboard.applications-chart');
    }
}
