<?php

namespace App\Livewire;

use App\Models\Department;
use App\Models\Faculty;
use Illuminate\Database\Query\Builder;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;

final class DepartmentTable extends PowerGridComponent
{
    use WithExport;
    public bool $showFilters = true;
    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()
                ->showToggleColumns()
                ->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return DB::table('Departments')
            ->select(
                'Departments.id',
                'Departments.code',
                'Departments.name',
                'Departments.faculty_id',
                'Faculties.name as faculty_name',
                'Faculties.code as faculty_code'
            )
            ->join('Faculties', 'Faculties.id', '=', 'Departments.faculty_id');
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('name')
            ->add('code')
            ->add('faculty_id')
            ->add('faculty_name')
            ->add('faculty_code')
            ->add('deleted_at');
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make('Faculty', 'faculty_code', 'faculty_code')->sortable(),

            Column::make('Name', 'name')
                ->sortable()
                ->searchable(),

            Column::make('Code', 'code')
                ->sortable()
                ->searchable(),

            Column::make('Faculty id', 'faculty_id')->hidden(),

            // Column::make('Deleted at', 'deleted_at_formatted', 'deleted_at')
            //     ->sortable(),

            Column::action('Action'),

        ];
    }

    public function filters(): array
    {
        return [
            Filter::select('faculty_code', 'faculty_id')
                ->dataSource(Faculty::all())
                ->optionLabel('code')
                ->optionValue('id'),
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): Redirector
    {
        return redirect(route('department.edit', $rowId));
    }




    public function actions($row): array
    {
        return [
            Button::add('edit')
                ->id('edit')
                ->class('fas fa-edit text-secondary')
                ->tooltip('Edit Department Info')
                ->dispatch('edit', ['rowId' => $row->id]),

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
