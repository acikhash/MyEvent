<?php

namespace App\Livewire;

use App\Models\Department;
use App\Models\Staff;
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

final class StaffTable extends PowerGridComponent
{
    public string  $department_id;
    public string $tableName = 'stafftable';

    public string $sortField = 'departments.id';
    public bool $showFilters = true;

    use WithExport;
    public function boot(): void
    {
        config(['livewire-powergrid.filter' => 'outside']);
    }
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
        return DB::table('Staff')->select(
            'Staff.id',
            'Titles.name as salutation',
            'Staff.name',
            'Departments.code as department',
            'Majors.name as major',
            'Greds.name as grade'
        )

            ->leftJoin('Titles', 'Staff.title_id', '=', 'Titles.id')
            ->leftJoin('Departments', 'Staff.department_id', '=', 'Departments.id')
            ->leftJoin('Majors', 'Staff.major_id', '=', 'Majors.id')
            ->leftJoin('Greds', 'Staff.gred_id', '=', 'Greds.id')
            ->where('Departments.id', '=', $this->department_id);
    }
    public function relationSearch(): array
    {
        return [
            'Departments' => [
                'code',
            ],

            'Titles' => [
                'name',
            ],
        ];
    }
    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('no')
            ->add('id')
            ->add('salutation')
            ->add('name')
            ->add('department')
            ->add('major')
            ->add('grade')
        ;
    }

    public function columns(): array
    {
        return [
            Column::make('No', 'no'),
            Column::make('Id', 'id')->hidden(),
            Column::make('Title', 'salutation')->searchable(),
            Column::make('Name', 'name')
                ->sortable()
                ->searchable(),

            Column::make('Department', 'department', 'department.id')->searchable(),
            Column::make('Major', 'major'),
            Column::make('Grade', 'grade'),
            Column::make('Deleted at', 'deleted_at_formatted', 'deleted_at')
                ->sortable(),
            Column::make('Deleted at', 'deleted_at')
                ->sortable()
                ->searchable(),
            Column::action('Action'),
        ];
    }

    public function filters(): array
    {
        return [
            Filter::select('code', 'id')
                ->dataSource(Department::all())
                ->optionLabel('code')
                ->optionValue('id'),

        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): Redirector
    {
        return redirect(route('staff.edit', $rowId));
    }

    public function actions($row): array
    {
        return [
            Button::add('edit')
                ->id('edit')
                ->class('fas fa-edit text-secondary')
                ->tooltip('Edit Event')
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
