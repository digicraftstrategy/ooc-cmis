<?php

namespace App\Livewire\System\Analytics\Dashboard;

use Livewire\Component;
use App\Models\PremisesOwner;
use App\Models\PublicationPremises;
use App\Models\PremisesApplication;
use App\Models\PrescribedActivity;
use Carbon\Carbon;

class GeneralStatsCards extends Component
{
    public $ownerCount, $premisesCount, $applicationCount, $activityCount;
    public $ownerTrend, $premisesTrend, $applicationTrend, $activityTrend;

    public function mount()
    {
        // Counts
        $this->ownerCount = PremisesOwner::count();
        $this->premisesCount = PublicationPremises::count();
        $this->applicationCount = PremisesApplication::count();
        $this->activityCount = PrescribedActivity::count();

        // Trends (compare last month vs previous month)
        $this->ownerTrend = $this->calculateTrend(PremisesOwner::class);
        $this->premisesTrend = $this->calculateTrend(PublicationPremises::class);
        $this->applicationTrend = $this->calculateTrend(PremisesApplication::class);
        $this->activityTrend = $this->calculateTrend(PrescribedActivity::class);
    }

    private function calculateTrend($model)
    {
        $lastMonth = Carbon::now()->subMonth();
        $twoMonthsAgo = Carbon::now()->subMonths(2);

        $current = $model::whereBetween('created_at', [$lastMonth->startOfMonth(), $lastMonth->endOfMonth()])->count();
        $previous = $model::whereBetween('created_at', [$twoMonthsAgo->startOfMonth(), $twoMonthsAgo->endOfMonth()])->count();

        if ($previous === 0) {
            return $current > 0 ? 100 : 0; // Avoid division by zero
        }

        return round((($current - $previous) / $previous) * 100);
    }

    public function render()
    {
        return view('livewire.system.analytics.dashboard.general-stats-cards');
    }
}
