<?php

namespace App\Livewire;

use App\Models\Course;
use App\Models\Program;
use App\Models\Semester;
use Illuminate\Database\Query\Builder;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
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

final class CourseTable extends PowerGridComponent
{
    public string $tableName = 'coursetable';
    public bool $showFilters = true;
    use WithExport;

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
        return DB::table('Courses')->select(
            'Programs.name as program_name',
            'Programs.code as program_code',
            'Courses.id',
            'Courses.name',
            'Courses.code',
            'Courses.credit',
            'Courses.no_of_student',
            'Courses.section',
            'Courses.program_id',
            'Courses.semester_id',
            'Semesters.name as semester_name'
        )
            ->join('Programs', 'Programs.id', '=', 'Courses.program_id')
            ->join('Semesters', 'Semesters.id', '=', 'Courses.semester_id')
            ->where('Courses.deleted_at', '=', null); // filter out deleted records
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('name')
            ->add('code')
            ->add('credit')
            ->add('no_of_student')
            ->add('section')
            ->add('program_id')
            ->add('program_code')
            ->add('program_name')
            ->add('semester_id')
            ->add('semester_name')
            ->add('created_by')
            ->add('updated_by')
            ->add('deleted_at')
            ->add('created_at')
            ->add('updated_at');
    }

    public function columns(): array
    {
        return [
            Column::action('Action'),
            Column::make('Id', 'id'),
            Column::make('Program', 'program_code', 'program_code')->sortable(),
            Column::make('Semester', 'semester_name', 'semester_name')->sortable(),
            Column::make('Code', 'code', 'code')->sortable()->searchable(),
            Column::make('Name', 'name')
                ->sortable()
                ->searchable(),
            Column::make('Section', 'section')
                ->sortable()
                ->searchable(),
            Column::make('Credit', 'credit')
                ->sortable()
                ->searchable(),

            Column::make('No of student', 'no_of_student')
                ->sortable()
                ->searchable(),
            Column::make('Program id', 'program_id')->hidden(),

        ];
    }

    public function filters(): array
    {
        return [
            Filter::select('program_code', 'program_id')
                ->dataSource(Program::all())
                ->optionLabel('code')
                ->optionValue('id'),
            Filter::select('semester_name', 'semester_id')
                ->dataSource(Semester::all())
                ->optionLabel('name')
                ->optionValue('id'),

        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): Redirector
    {
        return redirect(route('course.edit', $rowId));
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
