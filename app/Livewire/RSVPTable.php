<?php

namespace App\Livewire;

use Illuminate\Database\Eloquent\Builder;
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
use App\Models\Event;

final class RSVPTable extends PowerGridComponent
{
    public string  $schedule;
    use WithExport;

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make(), //->showSearchInput()
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        if ($this->schedule == "monthly") {
            $startOfMonth = Carbon::now()->startOfMonth();
            $endOfMonth = Carbon::now()->endOfMonth();
            return Event::query()
                ->join('guests', 'guests.event_id', '=', 'events.id')
                ->join('guest_categories', 'guests.guest_category_id', '=', 'guest_categories.id')
                ->select([
                    DB::raw('COUNT(guests.id) as totalGuest'),
                    DB::raw('SUM(CASE WHEN guests.checkedin is not null THEN 1 ELSE 0 END) as checkedin'),
                    DB::raw('SUM(CASE WHEN guests.attendance is not null THEN 1 ELSE 0 END) as attendance'),
                    'guest_categories.name as category',
                    'events.name as event_name', 'events.id as id',
                    'events.maxGuest as event_max_guest'
                ])
                ->where(function ($query) use ($startOfMonth, $endOfMonth) {
                    $query->whereBetween('dateStart', [$startOfMonth, $endOfMonth])
                        ->orWhereBetween('dateEnd', [$startOfMonth, $endOfMonth]);
                })
                ->groupBy('guests.event_id', 'guest_categories.name', 'events.name', 'events.maxGuest')
                ->orderBy('guests.event_id', 'ASC');
        } elseif ($this->schedule == "daily") {
            $today = Carbon::today()->toDateString();
            return Event::query()
                ->join('guests', 'guests.event_id', '=', 'events.id')
                ->join('guest_categories', 'guests.guest_category_id', '=', 'guest_categories.id')
                ->select([
                    DB::raw('COUNT(guests.id) as totalGuest'),
                    DB::raw('SUM(CASE WHEN guests.checkedin = true THEN 1 ELSE 0 END) as checkedin'),
                    DB::raw('SUM(CASE WHEN guests.attendance = true THEN 1 ELSE 0 END) as attendance'),
                    'guest_categories.name as category',
                    'events.name as event_name', 'events.id as id',
                    'events.maxGuest as event_max_guest'
                ])
                ->where('dateStart', '<=', $today)
                ->where('dateEnd', '>=', $today)
                ->groupBy('guests.event_id', 'guest_categories.name', 'events.name', 'events.maxGuest')
                ->orderBy('guests.event_id', 'ASC');
        } else {
            return Event::query()
                ->join('guests', 'guests.event_id', '=', 'events.id')
                ->join('guest_categories', 'guests.guest_category_id', '=', 'guest_categories.id')
                ->select([
                    DB::raw('COUNT(guests.id) as totalGuest'),
                    DB::raw('SUM(CASE WHEN guests.checkedin = true THEN 1 ELSE 0 END) as checkedin'),
                    DB::raw('SUM(CASE WHEN guests.attendance = true THEN 1 ELSE 0 END) as attendance'),
                    'guest_categories.name as category',
                    'events.name as event_name', 'events.id as id',
                    'events.maxGuest as event_max_guest'
                ])
                ->groupBy('guests.event_id', 'guest_categories.name', 'events.name', 'events.maxGuest')
                ->orderBy('guests.event_id', 'ASC');
        }
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('totalGuest')
            ->add('checkedin')
            ->add('category')
            ->add('event_name')
            ->add('event_max_guest')
            ->add('id')
            ->add('attendance');
        // ->add('veneu')
        // ->add('organizer')
        // ->add('maxGuest')
        // ->add('about')
        // ->add('created_by')
        // ->add('updated_by')
        // ->add('deleted_at')
        // ->add('created_at')
        // ->add('updated_at');
    }

    public function columns(): array
    {
        return [
            Column::make('Event', 'event_name'),
            Column::make('eventId', 'event.id')->hidden(),
            Column::make('TotalGuest', 'totalGuest'),
            Column::make('Total Checked In', 'checkedin'),
            Column::make('Total RSVP', 'attendance'),
            Column::make('Category', 'category')->searchable(),
            // Column::add()->title('Event')->field('event_name')->searchable(),

            //     ->sortable()
            //     ->searchable(),

            Column::make('event_max_guest', 'event_max_guest'),
            //     ->sortable()
            //     ->searchable(),

            // Column::make('TimeEnd', 'timeEnd')
            //     ->sortable()
            //     ->searchable(),

            // Column::make('Veneu', 'veneu')
            //     ->sortable()
            //     ->searchable(),

            // Column::make('Organizer', 'organizer')
            //     ->sortable()
            //     ->searchable(),

            // Column::make('MaxGuest', 'maxGuest')
            //     ->sortable()
            //     ->searchable(),

            // Column::make('About', 'about')
            //     ->sortable()
            //     ->searchable(),

            // Column::make('Created by', 'created_by')
            //     ->sortable()
            //     ->searchable(),

            // Column::make('Updated by', 'updated_by')
            //     ->sortable()
            //     ->searchable(),

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
            // Column::action(''),

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

    // public function actions($row): array
    // {
    //     return [
    //         Button::add('edit')
    //             ->slot('Edit: ' . $row->id)
    //             ->id()
    //             ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
    //             ->dispatch('edit', ['rowId' => $row->maxGuest])
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
