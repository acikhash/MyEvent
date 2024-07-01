<?php

namespace App\Livewire;

use App\Http\Controllers\NotificationController;
// use Illuminate\Database\Query\Builder;
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
use Illuminate\Routing\Redirector;
use App\Models\Guest;


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
        return Guest::query()
            ->where('guests.event_id', '=', $this->eventid)
            ->join('guest_categories', function ($categories) {
                $categories->on('guests.guest_category_id', '=', 'guest_categories.id');
            })
            ->select([
                'guests.*', 'guest_categories.name as category',
            ]);
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')  // Adds the 'id' field
            ->add('salutations')  // Adds the 'salutations' field
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
            ->add('checkedin', fn ($guest) => $guest->checkedin ? 'Yes' : 'No');  // Adds the 'checkedin' field
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
            Column::make('Category', 'category', 'guest_categories.name')
                ->searchable()
                ->sortable(),
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
    public function edit($rowId): Redirector
    {
        return redirect(route('guestl.edit', $rowId));
        // $this->js('alert(' . $rowId . ')');
    }
    #[\Livewire\Attributes\On('QR')]
    public function QR($rowId): Redirector
    {
        $guest = Guest::find($rowId);
        return redirect(route('email.sentqr', $guest));
    }

    #[\Livewire\Attributes\On('email')]
    public function email($rowId): Redirector
    {
        $guest = Guest::find($rowId);
        return redirect(route('email.send', $guest));
    }

    public function actions($row): array
    {
        return [
            Button::add('edit')
                ->id('edit')
                ->class('fas fa-edit text-secondary')
                ->tooltip('Edit Record')
                ->dispatch('edit', ['rowId' => $row->id]),

            Button::add('Send QR')
                ->id('QR')
                ->class('fas fa-qrcode text-secondary')
                ->tooltip('Send QR Code Email')
                ->dispatch('QR', ['rowId' => $row->id]),

            Button::add('Send Invitation')
                ->id('email')
                ->class('fas fa-envelope text-secondary')
                ->tooltip('Send Invitation Email')
                ->dispatch('email', ['rowId' => $row->id]),
        ];
    }
}
