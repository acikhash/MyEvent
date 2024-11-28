<?php

namespace App\Livewire;

use Illuminate\Database\Query\Builder;
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

final class AssignmentDetail extends PowerGridComponent
{
    use WithExport;
    public string  $staff_id;
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
        return DB::table('Assignments')->where('staff_id', '=', $this->staff_id);
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

    // #[\Livewire\Attributes\On('edit')]
    // public function edit($rowId): void
    // {
    //     $this->js('alert(' . $rowId . ')');
    // }

    // public function actions($row): array
    // {
    //     return [
    //         Button::add('edit')
    //             ->slot('Edit: ' . $row->id)
    //             ->id()
    //             ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
    //             ->dispatch('edit', ['rowId' => $row->id])
    //     ];
    // }

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
