<?php

namespace App\Livewire;

use App\Models\Guest;

use Illuminate\Database\Query\Builder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Exportable;
use Livewire\Component;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;
use Illuminate\Contracts\View\View;
use App\Models\Event;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Redirect;

final class GuestTable extends PowerGridComponent
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
        return DB::table('guests')
            ->select(
                'guests.id',
                'guests.salutations',
                'events.name as event_name', // Alias the events.name as event_name
                'guests.name',
                'guests.organization',
                'guests.address',
                'guests.contactNumber',
                'guests.email',
                'guests.guesttype',
                'guests.guest_category_id', // Adjust this as per your actual implementation
                'guests.bringrep',
                'guests.attendance',
                'guests.checkedin'
            )
            ->leftJoin('events', 'guests.event_id', '=', 'events.id');
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')  // Adds the 'id' field
            ->add('salutations')  // Adds the 'salutations' field
            ->add('event_name') // Adds the 'id' field
            ->add('name')  // Adds the 'name' field
            ->add('organization')  // Adds the 'organization' field
            ->add('address')  // Adds the 'address' field
            ->add('contactNumber')  // Adds the 'contactNumber' field
            ->add('email')  // Adds the 'email' field
            ->add('guesttype')  // Adds the 'guesttype' field
            ->add('category')  // Adds the 'category' field
            ->add('bringrep', fn ($guest) => $guest->bringrep ? 'Yes' : 'No')  // Adds the 'bringrep' field with a conditional display
            ->add('attendance', fn ($guest) => match ($guest->attendance) {  // Adds the 'attendance' field with a switch-case for display values
                'on' => 'Yes',
                'off' => 'No',
                default => 'No Reply',
            })
            ->add('checkedin', fn ($guest) => $guest->checkedin ? 'Yes' : 'No')  // Adds the 'checkedin' field
            ->add('id')  // Adds the 'id' field
            ->add('salutations')  // Adds the 'salutations' field
            ->add('event_name') // Adds the 'id' field
            ->add('name')  // Adds the 'name' field
            ->add('organization')  // Adds the 'organization' field
            ->add('address')  // Adds the 'address' field
            ->add('contactNumber')  // Adds the 'contactNumber' field
            ->add('email')  // Adds the 'email' field
            ->add('guesttype')  // Adds the 'guesttype' field
            ->add('category')  // Adds the 'category' field
            ->add('bringrep', fn ($guest) => $guest->bringrep ? 'Yes' : 'No')

            ->add('attendance', fn ($guest) => match ($guest->attendance) {  // Adds the 'attendance' field with a switch-case for display values
                'on' => 'Yes',
                'off' => 'No',
                default => 'No Reply',
            })
            ->add('checkedin', fn ($guest) => $guest->checkedin ? 'Yes' : 'No');  // Adds the 'checkedin' field
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id')
                ->sortable()
                ->searchable(),

            Column::make('Event Name', 'event_name')
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

            Column::make('RSVP', 'attendance')
                ->sortable()
                ->searchable(),

            Column::make('Checked In', 'checkedin')
                ->sortable()
                ->searchable(),

            //Column::action('Action'),

        ];
    }

    public function filters(): array
    {
        return [];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): Redirector
    {
        $guest = Guest::findOrFail($rowId);
        return redirect(route('guest.edit', ['id' => $guest->id]));
    }

    #[\Livewire\Attributes\On('QR')]
    public function QR($rowId): Redirector
    {
        $guest = Guest::findOrFail($rowId);
        return redirect(route('guest.qrcode', ['id' => $guest->id]));
    }

    #[\Livewire\Attributes\On('email')]
    public function email($rowId): Redirector
    {
        $guest = Guest::findOrFail($rowId);
        return redirect(route('guest.representativeform', ['id' => $guest->id]));
    }
}
