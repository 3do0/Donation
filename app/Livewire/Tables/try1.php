<?php

namespace App\Livewire\Tables;

use App\Models\OrganizationUser;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Blade;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Components\SetUp\Exportable;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;

final class try1 extends PowerGridComponent
{
    use WithExport;
    
    public string $tableName = 'organization-user-li4myl-table';

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
        return OrganizationUser::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('photo' , fn ($item) =>$item->photo ? '<img class="avatar img-fluid rounded-circle" src="' . asset("storage/{$item->photo}") . '">' : '<img class="avatar img-fluid rounded-circle" src="'.asset('assets/img/id.jpg').'">')
            ->add('name' , fn ($item) => '<p class="text-sm text-center text-dark font-weight-semibold mb-0">'.$item->name.'</p>')
            ->add('email' , fn ($item) => '<p class="text-sm text-center text-dark font-weight-semibold mb-0">'.$item->email.'</p>')
            ->add('phone' , fn ($item) => '<p class="text-sm text-center text-dark font-weight-semibold mb-0">'.$item->phone.'</p>')
            ->add('gender' , fn ($item) => $item->gender ? '<p class="text-sm text-center text-dark font-weight-semibold mb-0">'.$item->gender.'</p>' : '<span class="text-center text-dark font-weight-semibold ">غير محدد</span>')
            ->add('is_online' , fn ($item) => $item->is_online
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
    
    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert('.$rowId.')');
    }

    public function actions(OrganizationUser $row): array
    {
        return [
            Button::add('edit')
                ->slot('Edit: '.$row->id)
                ->id()
                ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
                ->dispatch('edit', ['rowId' => $row->id])
            ];
        }

        public function filters(): array
        {
            return [
                Filter::inputText('email')->placeholder('Dish Name'),
                Filter::inputText('name')->placeholder('Dish Name'),
    
                Filter::boolean('in_stock')->label('In Stock', 'Out of Stock'),
    
                Filter::number('price_BRL', 'price')->thousands('.')
                ->decimal(','),
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
