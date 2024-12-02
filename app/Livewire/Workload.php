<?php

namespace App\Livewire;

use App\Models\Department;
use App\Models\Gred;
use App\Models\Major;
use App\Models\Semester;
use App\Models\Title;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use PowerComponents\LivewirePowerGrid\Facades\Rule;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Detail;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;

final class Workload extends PowerGridComponent
{
    // use WithExport;

    public bool $showFilters = true;


    public function setUp(): array
    {
        //  $this->showCheckBox();

        return [

            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
            Detail::make()
                ->view('components.detail')


            // Exportable::make('workload')
            //     ->striped()
            //     ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),

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
            // // 'Assignments.course_code',
            // 'Assignments.year',
            // 'Assignments.semester',

        )

            // ->leftjoin('Assignments', 'Staff.id', '=', 'Assignments.staff_id')
            ->whereNull('Staff.deleted_at');
        // ->groupBy(

        //     'Assignments.year',
        //     'Assignments.semester',
        //     'Staff.id',
        //     'Staff.title',
        //     'Staff.name',
        //     'Staff.department',
        //     'Staff.major',
        //     'Staff.gred',
        //     // 'Assignments.course_code',
        // );
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')

            ->add('title')
            ->add('name')
            ->add('department')
            ->add('major')
            ->add('gred')
            // ->add('department_name', fn($staff) => e($staff->department_name))
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
            Column::make('Department', 'department', 'department')->sortable(),
            Column::make('Major', 'major', 'major')->sortable(),
            Column::make('Grade', 'gred', 'gred')->sortable(),


        ];
    }

    public function filters(): array
    {
        return [
            // Filter::select('year', 'year')
            //     ->dataSource(
            //         Semester::distinct()
            //             ->pluck('year')
            //             ->map(fn($year) => ['year' => $year])
            //             ->toArray()
            //     )
            //     ->optionLabel('year')
            //     ->optionValue('year'),
            Filter::select('department', 'department')
                ->dataSource(Department::all())
                ->optionLabel('code')
                ->optionValue('code'),
            Filter::select('major', 'major')
                ->dataSource(Major::all())
                ->optionLabel('name')
                ->optionValue('name'),
            Filter::select('gred', 'gred')
                ->dataSource(Gred::all())
                ->optionLabel('name')
                ->optionValue('name'),
            Filter::select('title', 'title')
                ->dataSource(Title::all())
                ->optionLabel('name')
                ->optionValue('name'),
            Filter::inputText('name')->placeholder('name'),
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert(' . $rowId . ')');
    }

    public function actions($row): array
    {
        return [

            Button::add('edit')
                ->id('edit')
                ->class('fa-solid fa-circle-plus text-secondary')
                ->tooltip('View detail')
                ->toggleDetail($row->id),
        ];
    }

    // public function actionRules(): array
    // {
    //     return [
    //         Rule::rows()
    //             ->when(fn($dish) => $dish->id == 1)
    //             ->detailView('components.detail-rules', ['fromActionRule' => true]),
    //     ];
    // }
}
