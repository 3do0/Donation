<?php

namespace App\Livewire\OrganizationDashboard;

use App\Models\DonationItem;
use App\Models\OrganizationCase;
use App\Models\OrganizationProject;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Main extends Component
{

    public $cases;
    public $latestCases;
    public $totalDonations = 0;
    public $targetDonations = 0;
    public $donationLevel = 0;

    public $totalPendingCases = 0;
    public $pendingCasesLevel = 0;

    public $totalCompletedCases = 0;
    public $completedCasesLevel = 0;

    public $totalCases = 0;
    public $totalProjects = 0;
    public $projectsLevel = 0;

    public function mount()
    {
        $organizationId = Auth::guard('organization')->user()?->organization_id;

        $this->cases = OrganizationCase::with('organization_user')
            ->whereHas('organization_user', fn($q) => $q->where('organization_id', $organizationId))
            ->get();

        $this->totalDonations = $this->sumCases('raised_amount', $organizationId);
        $this->targetDonations = $this->sumCases('target_amount', $organizationId);
        $this->donationLevel = $this->targetDonations > 0 ? ($this->totalDonations / $this->targetDonations) * 100 : 0;

        $this->totalPendingCases = $this->countCasesByStatus('in_progress', $organizationId);
        $this->totalCompletedCases = $this->countCasesByStatus('completed', $organizationId);
        $this->totalCases = $this->countCasesByStatus(null, $organizationId);

        $this->pendingCasesLevel = $this->totalCases > 0 ? ($this->totalPendingCases / $this->totalCases) * 100 : 0;
        $this->completedCasesLevel = $this->totalCases > 0 ? ($this->totalCompletedCases / $this->totalCases) * 100 : 0;

        $this->totalProjects = OrganizationProject::with('organization_user')
            ->whereHas('organization_user', fn($q) => $q->where('organization_id', $organizationId))
            ->count();

        $this->projectsLevel = $this->totalProjects > 0 ? 100 : 0;

        $this->latestCases = $this->cases->sortByDesc('created_at')->take(10);

        $this->dispatch('updateChart', [
            'cases' => $this->latestCases->pluck('raised_amount')->toArray(),
            'targets' => $this->latestCases->pluck('target_amount')->toArray(),
            'caseNumbers' => $this->latestCases->pluck('id')->toArray(),
        ]);
        $this->dispatch('loadChart', $this->getChartData());
    }



    private function sumCases(string $field, int $organizationId): float
    {
        return OrganizationCase::with('organization_user')
            ->whereHas(
                'organization_user',
                fn($q) =>
                $q->where('organization_id', $organizationId)
            )->sum($field);
    }

    private function countCasesByStatus(?string $status, int $organizationId): int
    {
        $query = OrganizationCase::with('organization_user')
            ->whereHas(
                'organization_user',
                fn($q) =>
                $q->where('organization_id', $organizationId)
            );

        if ($status !== null) {
            $query->where('status', $status);
        }

        return $query->count();
    }

    public function getChartData()
    {
        $currency = 'yer';

        $donations = DonationItem::with('donation')
            ->whereHas('donation', function ($query) use ($currency) {
                $query->where('currency', $currency);
            })
            ->selectRaw('DATE(created_at) as date, SUM(amount) as total')
            ->groupByRaw('DATE(created_at)')
            ->orderByRaw('DATE(created_at)')
            ->get();

        return [
            'labels' => $donations->pluck('date')->map(fn($date) => \Carbon\Carbon::parse($date)->format('M d')),
            'datasets' => [
                [
                    'label' => 'مقدار',
                    'data' => $donations->pluck('total'),
                ]
            ],
        ];
    }

    public function render()
    {
        return view('livewire.organization-dashboard.main')->layout('layouts.Organization_Dashboard.app');
    }
}
