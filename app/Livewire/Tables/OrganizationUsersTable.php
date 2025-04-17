<?php

namespace App\Livewire\Tables;

use App\Models\OrganizationUser;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Components\SetUp\Exportable;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;

final class OrganizationUsersTable extends PowerGridComponent
{
    public string $tableName = 'organization-table-biyc3g-table';

    public function setUp(): array
    {
        $this->showCheckBox();


        return [
            PowerGrid::exportable(fileName: 'my-export-file')
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),

            PowerGrid::header() 
                ->showSearchInput()
                ->showToggleColumns(),

            PowerGrid::footer()
                ->showPerPage()
                ->showRecordCount(),

        ];
    }

    public function datasource(): Builder
    {
        return OrganizationUser::where('organization_id', auth('organization')->user()->organization_id);
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('photo', fn($item) => $item->photo ? '<img class="avatar img-fluid rounded-circle" src="' . asset("storage/{$item->photo}") . '">' : '<img class="avatar img-fluid rounded-circle" src="' . asset('assets/img/id.jpg') . '">')
            ->add('name', fn($item) => '<p class="text-sm text-center text-dark font-weight-semibold mb-0">' . $item->name . '</p>')
            ->add('email', fn($item) => '<p class="text-sm text-center text-dark font-weight-semibold mb-0">' . $item->email . '</p>')
            ->add('phone', fn($item) => '<p class="text-sm text-center text-dark font-weight-semibold mb-0">' . $item->phone . '</p>')
            ->add('gender', fn($item) => $item->gender ? '<p class="text-sm text-center text-dark font-weight-semibold mb-0">' . $item->gender . '</p>' : '<span class="text-center text-dark font-weight-semibold ">غير محدد</span>')
            ->add('is_online', fn($item) => $item->is_online
                ? '<span class="badge badge-sm border border-success text-success bg-success">Online</span>'
                : '<span class="badge badge-sm border border-secondary text-secondary bg-danger">Offline</span>')
            ->add('created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),

            Column::make('الصورة الشخصية', 'photo')
                ->sortable()
                ->searchable()
                ->visibleInExport(visible: true),

            Column::make('الأسم', 'name')
                ->sortable()
                ->searchable(),

            Column::make('Email', 'email')
                ->sortable()
                ->searchable()
                ->visibleInExport(visible: true),

            Column::make('رقم الهاتف', 'phone')
                ->sortable()
                ->searchable()
                ->visibleInExport(visible: true),

            Column::make('الجنس', 'gender')
                ->sortable()
                ->searchable()
                ->visibleInExport(visible: true),

            Column::make('الحالة', 'is_online')
                ->sortable()
                ->searchable()
                ->visibleInExport(visible: true),



            Column::make('Created at', 'created_at')
                ->sortable()
                ->searchable(),

            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
            Filter::inputText('email')->placeholder('حسب الأيميل'),
            Filter::inputText('name')->placeholder('حسب الاسم'),

            Filter::boolean('in_stock')->label('In Stock', 'Out of Stock'),

            Filter::number('price_BRL', 'price')->thousands('.')
                ->decimal(','),
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert(' . $rowId . ')');
    }

    protected $listeners = ['deleteUser'];
    public function deleteUser($id)
    {
        OrganizationUser::findOrFail($id)->delete();
        $this->dispatch('pg:eventRefresh-default'); // تحديث الجدول بعد الحذف
    }

    public function actions(OrganizationUser $row): array
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
                    'x-on:click' => "confirmDelete({$row->id}, 'deleteUser')",
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
