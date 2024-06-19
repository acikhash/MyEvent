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

final class EventTable extends PowerGridComponent
{
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
        return DB::table('Events');
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('name')
            ->add('theme')
            ->add('veneu')
            ->add('dateStart')
            ->add('timeStart')
            ->add('dateEnd')
            ->add('timeEnd')
            ->add('organizer')
            ->add('maxGuest')
            ->add('deleted_at')
            ->add('created_at')
            ->add('updated_at');
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id')
                ->sortable()
                ->searchable(),

            Column::make('Name', 'name')
                ->sortable()
                ->searchable(),

            Column::make('Theme', 'theme')
                ->sortable()
                ->searchable(),

            Column::make('Date Start', 'dateStart')
                ->sortable()
                ->searchable(),

            Column::make('Time Start', 'timeStart')
                ->sortable()
                ->searchable(),

            Column::make('Date End', 'dateEnd')
                ->sortable()
                ->searchable(),

            Column::make('Time End', 'timeEnd')
                ->sortable()
                ->searchable(),

            Column::make('Veneu', 'veneu')
                ->sortable()
                ->searchable(),

            Column::make('Organizer', 'organizer')
                ->sortable()
                ->searchable(),

            Column::make('MaxGuest', 'maxGuest')
                ->sortable()
                ->searchable(),

            // Column::make('Deleted at', 'deleted_at_formatted', 'deleted_at')
            //     ->sortable(),

            // Column::make('Deleted at', 'deleted_at')
            //     ->sortable()
            //     ->searchable(),

            // Column::make('Created at', 'created_at_formatted', 'created_at')
            //     ->sortable(),

            // Column::make('Created at', 'created_at')
            //     ->sortable()
            //     ->searchable(),

            // Column::make('Updated at', 'updated_at_formatted', 'updated_at')
            //     ->sortable(),

            // Column::make('Updated at', 'updated_at')
            //     ->sortable()
            //     ->searchable(),
            Column::action('Action'),

        ];
    }

    public function filters(): array
    {
        return [];
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
                // ->slot('Edit: ' . $row->id)
                ->id()
                ->class('fas fa-edit text-secondary')
                // ->class('btn btn-primary')
                ->route('event.edit', ['id' => $row->id])
                ->tooltip('Edit Record'),


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
