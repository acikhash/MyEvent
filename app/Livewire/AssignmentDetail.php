<?php

namespace App\Livewire;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;

final class AssignmentDetail extends PowerGridComponent
{
    // use WithExport;
    public string  $staff_id;
    public string  $year;
    public function __construct()
    {
        $this->year = date('Y');
    }
    public function setUp(): array
    {
        // $this->showCheckBox();

        return [
            // Exportable::make('export2')
            //     ->striped()
            //     ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            //Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return DB::table('Assignments')
            ->where('staff_id', '=', $this->staff_id)
            ->where('year', '=', $this->year);
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('course_id')
            ->add('staff_id')
            ->add('semester_id')
            ->add('course_code')
            ->add('staff_name')
            ->add('year')
            ->add('semester')
            ->add('credit')
            ->add('notes')
            ->add('created_by')
            ->add('updated_by')
            ->add('deleted_at')
            ->add('created_at')
            ->add('updated_at');
    }

    public function columns(): array
    {
        return [
            // Column::action('Action'),
            Column::make('Id', 'id'),
            Column::make('Course id', 'course_id')->hidden(),
            Column::make('Staff id', 'staff_id')->hidden(),
            Column::make('Semester id', 'semester_id')->hidden(),
            Column::make('Course code', 'course_code')
                ->sortable()
                ->searchable(),
            Column::make('Year', 'year')
                ->sortable()
                ->searchable(),
            Column::make('Semester', 'semester')
                ->sortable()
                ->searchable(),

            Column::make('Credit', 'credit')
                ->sortable()
                ->searchable(),
            Column::make('credit', 'credit', 'credit')
                ->withSum('Sum credit', header: true, footer: false)
                ->withAvg('Avg credit', header: true, footer: false)
                ->withCount('Count credit', header: true, footer: false)
                ->withMin('Min credit', header: false, footer: true)
                ->withMax('Max credit', header: false, footer: true)
                ->sortable(),
            Column::make('Notes', 'notes')
                ->sortable()
                ->searchable(),



        ];
    }

    public function filters(): array
    {
        return [];
    }
}
