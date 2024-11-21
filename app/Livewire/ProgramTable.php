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
            'Programs.department',
            'Programs.deleted_at'
        )
            ->join('Departments', 'Departments.id', '=', 'Programs.department_id')
            ->whereNull('Programs.deleted_at');
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
            ->add('department')
            ->add('deleted_at')
        ;
    }

    public function columns(): array
    {
        return [
            Column::action('Action'),
            Column::make('Id', 'id'),
            Column::make('Department', 'department', 'department')->sortable(),
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


        ];
    }

    public function filters(): array
    {
        return [
            Filter::select('department', 'department_id')
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
