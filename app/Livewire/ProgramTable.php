<?php

namespace App\Livewire;

use App\Models\Department;
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

final class ProgramTable extends PowerGridComponent
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
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return DB::table('Programs')->select(
            'Programs.id',
            'Programs.coordinator',
            'Programs.code',
            'Programs.name',
            'Programs.staff_id',
            'Departments.code as department_code'

        )
            ->join('Departments', 'Departments.id', '=', 'Programs.department_id');
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('name')
            ->add('code')
            ->add('department_id')
            ->add('staff_id')
            ->add('coordinator')
            ->add('department_code')
            ->add('deleted_at')
        ;
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make('Department', 'department_code', 'department_code')->sortable(),
            Column::make('Code', 'code')
                ->sortable()
                ->searchable(),
            Column::make('Name', 'name')
                ->sortable()
                ->searchable(),
            Column::make('Coordinator', 'coordinator')
                ->sortable()
                ->searchable(),
            Column::make('Department id', 'department_id')->hidden(),
            Column::make('Staff id', 'staff_id')->hidden(),
            Column::make('Deleted at', 'deleted_at_formatted', 'deleted_at')->sortable(),
            Column::action('Action'),
        ];
    }

    public function filters(): array
    {
        return [
            Filter::select('department_code', 'department_id')
                ->dataSource(Department::all())
                ->optionLabel('code')
                ->optionValue('id'),
            Filter::inputText('coordinator')->placeholder('Coordinator'),
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): Redirector
    {
        return redirect(route('program.edit', $rowId));
    }

    public function actions($row): array
    {
        return [
            Button::add('edit')
                ->id('edit')
                ->class('fas fa-edit text-secondary')
                ->tooltip('Edit Program')
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
