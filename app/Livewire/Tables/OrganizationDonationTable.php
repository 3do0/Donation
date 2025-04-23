<?php

namespace App\Livewire\Tables;

use App\Models\DonationItem;
use App\Models\OrganizationCase;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;

final class OrganizationDonationTable extends PowerGridComponent
{
    public string $tableName = 'organization-donation-table-g3u37v-table';

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            PowerGrid::header()
                ->showSearchInput(),
            PowerGrid::footer()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        $organizationId = Auth::guard('organization')->user()?->organization_id;

        return DonationItem::with(['donatable', 'donation'])
            ->where('donatable_type', OrganizationCase::class)
            ->whereHasMorph(
                'donatable',
                [OrganizationCase::class],
                function ($query) use ($organizationId) {
                    $query->whereHas('organization_user', function ($q) use ($organizationId) {
                        $q->where('organization_id', $organizationId);
                    });
                }
            );
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('donation_id', fn($item) => '<p class="text-sm text-center text-dark font-weight-semibold mb-0">' . $item->donation_id . '</p>')
            ->add('donatable.case_name', fn($item) => '<p class="text-sm text-center text-dark font-weight-semibold mb-0">' . ($item->donatable->case_name ?? '-') . '</p>')
            ->add('amount', fn($item) => '<p class="text-sm text-center text-success font-weight-bold mb-0">' . number_format($item->amount, 2) . '</p>')
            ->add('donation.currency', fn($item) => '<p class="text-sm text-center text-success font-weight-bold mb-0">' . $this->getCurrencyName($item->donation->currency) . '</p>')
            ->add('donation.donor.name', fn($item) => '<p class="text-sm text-center text-dark font-weight-semibold mb-0">' . ($item->donation->donor->name ?? '-') . '</p>')
            ->add('created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('رقم التبرع', 'id')
                ->sortable()
                ->searchable(),

            Column::make('رقم الحالة', 'donatable_id')
                ->sortable()
                ->searchable(),

            Column::make('عنوان الحالة', 'donatable.case_name')
                ->sortable()
                ->searchable(),

            Column::make('المبلغ', 'amount')
                ->sortable()
                ->searchable(),

            Column::make('العملة', 'donation.currency')
                ->sortable()
                ->searchable(),

            Column::make('بواسطة', 'donation.donor.name')
                ->sortable()
                ->searchable(),

            Column::make('تاريخ التبرع', 'created_at')
                ->sortable()
                ->searchable(),
        ];
    }

    public function filters(): array
    {
        return [];
    }

    private function getCurrencyName(string $currency): string
    {

        $currency = strtolower($currency);

        $currencies = [
            'usd' => 'دولار أمريكي',
            'yer' => 'ريال يمني',
            'sar' => 'ريال سعودي',
            'egp' => 'جنيه مصري',
        ];

        return $currencies[$currency] ?? $currency; 
    }
}
