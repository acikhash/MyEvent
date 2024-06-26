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

final class EventGuestTable extends PowerGridComponent
{
    public string  $eventid;
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
        return DB::table('guests')->where('eventid', '=', $this->eventid);
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('salutations')
            ->add('name')
            ->add('organization')
            ->add('address')
            ->add('contactNumber')
            ->add('email')
            ->add('guesttype')
            ->add('bringrep')
            ->add('attendance')
            ->add('checkedin');
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id')
                ->sortable()
                ->searchable(),

            Column::make('Salutations', 'salutations')
                ->sortable()
                ->searchable(),

            Column::make('Name', 'name')
                ->sortable()
                ->searchable(),

            Column::make('Organization', 'organization')
                ->sortable()
                ->searchable(),

            Column::make('Address', 'address')
                ->sortable()
                ->searchable(),

            Column::make('Contact Number', 'contactNumber')
                ->sortable()
                ->searchable(),

            Column::make('Email', 'email')
                ->sortable()
                ->searchable(),

            Column::make('Guest Type', 'guesttype')
                ->sortable()
                ->searchable(),

            Column::make('Bring Representative', 'bringrep')
                ->sortable()
                ->searchable(),

            Column::make('Attendance', 'attendance')
                ->sortable()
                ->searchable(),

            Column::make('Checked In', 'checkedin')
                ->sortable()
                ->searchable(),

            Column::action('Action')
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
                ->class('fas fa-edit text-secondary')
                ->tooltip('Edit Record')
                ->dispatch('edit', ['rowId' => $row->id]),
            Button::add('invitation')
                ->id('guest')
                ->class('fas fa-email text-secondary')
                ->tooltip('Guest List Mangement')
                ->dispatch('guest', ['rowId' => $row->id]),
        ];
    }
}
