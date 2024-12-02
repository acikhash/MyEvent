<?php

namespace App\Livewire;

use App\Models\Course;
use App\Models\Program;
use App\Models\Semester;
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

final class AssignmentTable extends PowerGridComponent
{
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
            'Courses.code as course_code',
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
            ->add('course_code')
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
            Column::make('Code', 'course_code', 'course_code')->sortable(),
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
        $distinctCourses = Course::select('code')->distinct()->get();
        return [
            Filter::select('program_code', 'program_id')
                ->dataSource(Program::all())
                ->optionLabel('code')
                ->optionValue('id'),
            Filter::select('semester_name', 'semester_id')
                ->dataSource(Semester::all())
                ->optionLabel('name')
                ->optionValue('id'),
            Filter::select('course_code', 'courses.code')
                ->dataSource($distinctCourses)
                ->optionLabel('code')
                ->optionValue('code'),

        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): Redirector
    {
        return redirect(route('assignment.edit', $rowId));
    }

    public function actions($row): array
    {
        return [
            Button::add('edit')
                ->id('edit')
                ->class('fas fa-user text-secondary')
                ->tooltip('assign lecturer')
                ->dispatch('edit', ['rowId' => $row->id]),
        ];
    }
}
