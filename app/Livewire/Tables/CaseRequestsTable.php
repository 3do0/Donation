<?php

namespace App\Livewire\Tables;

use App\Models\OrganizationCaseRequest;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;

final class CaseRequestsTable extends PowerGridComponent
{
    public string $tableName = 'case-requests-foovyd-table';

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

        return OrganizationCaseRequest::with('organization_user')
        ->whereHas('organization_user', function ($query) use ($organizationId) {
            $query->where('organization_id', $organizationId );
        }) ->where('approval_status', 'pending');
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('case_name' , fn($item) =>'<p class="text-sm text-center text-dark font-weight-semibold mb-0">' . $item->case_name . '</p>')
            ->add('case_photo', fn($item) => '
             <div class="text-center">
                 <a class="profile-img " href="' . asset('storage/' . $item->case_photo) . '" target="_blank">
                    <img src="' . asset('storage/' . $item->case_photo) . '" alt="صورة الحالـة" style="width: 60px; height: 60px; object-fit: cover; border-radius: .375rem;">
                 </a>
             </div>
                ')

            ->add('case_file', fn($item) => '
                 <a href="' . asset('storage/' . $item->case_file) . '" target="_blank"
                   class="btn btn-outline-info btn-rounded btn-sm">
                    عرض الملف
                 </a>
                ')
            
            ->add('beneficiaries_count', fn($item) => '<p class="text-sm text-center text-dark font-weight-semibold mb-0">' . $item->beneficiaries_count . '</p>')

            ->add('description', fn($item) => '
                    <div class="text-center text-nowrap text-dark">
                        <span title="' . e($item->description) . '">
                            ' . \Illuminate\Support\Str::limit($item->description, 10, '...') . '
                        </span>
                    </div>
                ')

                ->add('target_amount' , fn($item) => '<p class="text-sm text-center font-weight-semibold mb-0 text-warning">' . $item->target_amount . '</p>')
            ->add('currency' , fn($item) => '<p class="text-sm text-center text-dark font-weight-semibold mb-0">' . $item->currency . '</p>')
            ->add('organization_user.name' , fn($item) => '<p class="text-sm text-center text-dark font-weight-semibold mb-0">' . $item->organization_user->name . '</p>')
            ->add('created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('المعرف', 'id'),
            Column::make('اسم الحالـة', 'case_name')
                ->sortable()
                ->searchable(),

            Column::make('صورة الحالـة', 'case_photo')
                ->sortable()
                ->searchable(),

            Column::make('ملف الحالـة', 'case_file')
                ->sortable()
                ->searchable(),

            Column::make('عدد المستفيدين', 'beneficiaries_count')
                ->sortable()
                ->searchable(),

            Column::make('الوصف', 'description')
                ->sortable()
                ->searchable(),

            Column::make('المبلغ المطلوب', 'target_amount')
                ->sortable()
                ->searchable(),

            Column::make('العملة', 'currency')
                ->sortable()
                ->searchable(),


            Column::make('بواسطة', 'organization_user.name'),

            Column::make('تاريخ الإنشاء', 'created_at')
                ->sortable(),

            Column::action('الخيارات')
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
        $this->dispatch('editcase', $rowId);
        $this->dispatch('pg:eventRefresh-default'); 
    }

    protected $listeners = ['deleteRequest'];
    public function deleteRequest($id)
    {
        OrganizationCaseRequest::findOrFail($id)->delete();
        $this->dispatch('pg:eventRefresh-default'); 
    }


    public function actions(OrganizationCaseRequest $row): array
    {
        return [
            Button::add('edit')
                ->slot('<a type="button" data-toggle="tooltip" data-placement="top"
                            title="" data-original-title="Edit"><svg
                            xmlns="http://www.w3.user/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-check-circle text-primary">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                        </svg></a>'
                        )
                ->id()
                ->class('border-0 bg-transparent')
                ->dispatch('edit', ['rowId' => $row->id]),

            Button::add('delete')
                ->slot('
                    <a type="button" data-toggle="tooltip" data-placement="top" title="حذف"
                       data-original-title="Delete">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                             viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2"
                             stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-x-circle text-danger">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="15" y1="9" x2="9" y2="15"></line>
                            <line x1="9" y1="9" x2="15" y2="15"></line>
                        </svg>
                    </a>
                ')
                ->class('border-0 bg-transparent')
                ->attributes([
                    'x-on:click' => "confirmDelete({$row->id}, 'deleteRequest')",
                ])
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
