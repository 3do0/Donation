<?php

namespace App\Livewire\Tables;

use App\Models\OrganizationCaseRequest;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;

final class rashad extends PowerGridComponent
{
    public string $tableName = 'rashad-cbgm6t-table';

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
        return OrganizationCaseRequest::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('organization_user_id')
            ->add('case_name')
            ->add('case_photo')
            ->add('case_file')
            ->add('case_type')
            ->add('beneficiaries_count')
            ->add('description')
            ->add('currency')
            ->add('target_amount')
            ->add('approval_status')
            ->add('rejection_reason')
            ->add('user_id')
            ->add('reviewed_at')
            ->add('created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make('Organization user id', 'organization_user_id'),
            Column::make('Case name', 'case_name')
                ->sortable()
                ->searchable(),

            Column::make('Case photo', 'case_photo')
                ->sortable()
                ->searchable(),

            Column::make('Case file', 'case_file')
                ->sortable()
                ->searchable(),

            Column::make('Case type', 'case_type')
                ->sortable()
                ->searchable(),

            Column::make('Beneficiaries count', 'beneficiaries_count')
                ->sortable()
                ->searchable(),

            Column::make('Description', 'description')
                ->sortable()
                ->searchable(),

            Column::make('Currency', 'currency')
                ->sortable()
                ->searchable(),

            Column::make('Target amount', 'target_amount')
                ->sortable()
                ->searchable(),

            Column::make('Approval status', 'approval_status')
                ->sortable()
                ->searchable(),

            Column::make('Rejection reason', 'rejection_reason')
                ->sortable()
                ->searchable(),

            Column::make('User id', 'user_id'),
            Column::make('Reviewed at', 'reviewed_at_formatted', 'reviewed_at')
                ->sortable(),

            Column::make('Reviewed at', 'reviewed_at')
                ->sortable()
                ->searchable(),

            Column::make('Created at', 'created_at_formatted', 'created_at')
                ->sortable(),

            Column::make('Created at', 'created_at')
                ->sortable()
                ->searchable(),

            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert('.$rowId.')');
    }

    public function actions(OrganizationCaseRequest $row): array
    {
        return [
            Button::add('edit')
                ->slot('Edit: '.$row->id)
                ->id()
                ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
                ->dispatch('edit', ['rowId' => $row->id])
        ];
    }

    /*
    public function actionRules($row): array
    {
       return [
            // Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($row) => $row->id === 1)
                ->hide(),
        ];
    }
    */
}
