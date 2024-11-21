<?php

namespace App\Livewire;

use App\Models\Department;
use App\Models\Gred;
use App\Models\Major;
use App\Models\Staff;
use App\Models\Title;
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

    public string $sortField = 'Staff.id';
    public bool $showFilters = true;

    use WithExport;

    protected function queryString()
    {
        return $this->powerGridQueryString();
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
            'Staff.title',
            'Staff.name',
            'Staff.department',
            'Staff.major',
            'Staff.gred',
            'Departments.name as department_name',
            'Majors.name as major_name',
            'Titles.name as title_name',
            'Greds.name as gred_name'
        )
            ->join('Departments', 'Departments.code', '=', 'Staff.department')
            ->join('Majors', 'Majors.name', '=', 'Staff.major')
            ->join('Titles', 'Titles.name', '=', 'Staff.title')
            ->join('Greds', 'Greds.name', '=', 'Staff.gred')
            ->whereNull('Staff.deleted_at')
            // ->where('Departments.id', '=', $this->department_id)
        ;
    }
    public function relationSearch(): array
    {
        return [];
    }
    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('no')
            ->add('id')
            ->add('title')
            ->add('name')
            ->add('department')
            ->add('major')
            ->add('gred')
            ->add('department_name', fn($staff) => e($staff->department_name))
        ;
    }

    public function columns(): array
    {
        return [
            Column::action('Action'),
            Column::make('Id', 'id'),
            Column::make('Title', 'title', 'title_name')->sortable(),
            Column::make('Name', 'name')
                ->sortable()
                ->searchable(),
            Column::make('Department', 'department', 'department_name')->sortable(),
            Column::make('Major', 'major', 'major_name')->sortable(),
            Column::make('Grade', 'gred', 'gred_name')->sortable(),

        ];
    }

    public function filters(): array
    {
        return [
            Filter::select('department_name', 'department')
                ->dataSource(Department::all())
                ->optionLabel('code')
                ->optionValue('code'),
            Filter::select('major_name', 'major')
                ->dataSource(Major::all())
                ->optionLabel('name')
                ->optionValue('name'),
            Filter::select('title_name', 'title')
                ->dataSource(Title::all())
                ->optionLabel('name')
                ->optionValue('name'),
            Filter::select('gred_name', 'gred')
                ->dataSource(Gred::all())
                ->optionLabel('name')
                ->optionValue('name'),

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
                ->tooltip('Edit Staff Info')
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
