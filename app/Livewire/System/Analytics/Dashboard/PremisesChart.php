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
        // Group premises by date and order by date
        $premisesByDate = PublicationPremises::selectRaw('DATE(created_at) as date, COUNT(*) as daily_total')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $cumulativeTotal = 0;

        foreach ($premisesByDate as $row) {
            $cumulativeTotal += $row->daily_total;

            // Label: e.g. "05 Jan", "21 Feb"
            $this->labels[] = Carbon::parse($row->date)->format('d M');

            // Data: cumulative count of premises up to that date
            $this->data[] = $cumulativeTotal;
        }
    }

    public function render()
    {
        return view('livewire.system.analytics.dashboard.premises-chart');
    }
}
