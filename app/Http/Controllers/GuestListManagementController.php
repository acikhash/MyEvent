<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Guest;
use App\Models\Event;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;
use BaconQrCode\Writer\PngWriter;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class  GuestListManagementController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $event = Event::find($id);

        return view('guestlist.index', $event);
    }

    public function GuestList()
    {
        return view('guest.guestlist');
    }

    public function EventTables()
    {
        $events = Event::all();
        return view('guest.eventtables', compact('events'));
    }


    public function create()
    {
        return view('guest.registrationform');
    }




    public function store()
    {
        $attributes = request()->validate([
            'eventid',
            'eventname',
            'salutations' => [],
            'name' => ['required', 'max:50'],
            'organization' => [],
            'address' => [],
            'contactNumber' => [],
            'email' => ['required', 'email', 'max:50'],
            'guesttype' => [],
            'bringrep' => '',
            'attendance' => [],

        ]);

        // Assign default values
        $attributes['guesttype'] = $attributes['guesttype'] ?? 'Invitations';
        $attributes['attendance'] = $attributes['attendance'] ?? 'off';

        Guest::create($attributes);


        session()->flash('success', 'Guest added successfully.');

        // Auth::login($user);
        return redirect('/GuestList');
    }






    public function showEdit($id)
    {
        // Fetch the guest data for editing, assuming Guest model exists
        $guest = Guest::find($id);

        // Return view with guest data
        return view('guest.edit', compact('guest'));
    }





    public function edit(Request $request, $id)
    {
        $attributes = $request->validate([
            'eventid',
            'eventname',
            'salutations' => [],
            'name' => ['required', 'max:50'],
            'organization' => [],
            'address' => [],
            'contactNumber' => [],
            'email' => ['required', 'email', 'max:50'],
            'bringrep' => '',

        ]);


        $guest = Guest::find($id);

        $guest->bringrep = $request->has('bringrep') ? 'on' : 'off';


        $guest->fill($attributes); // Assuming fillable fields in Guest model
        $guest->save();



        session()->flash('success', 'successfully updated.');

        // Auth::login($user);
        return redirect('/GuestList');
    }

    public function RepresentativeCreate()
    {
        return view('guest.representativeform');
    }

    public function RepresentativeStore()
    {
        $attributes = request()->validate([
            'eventid',
            'eventname',
            'salutations' => [],
            'name' => ['required', 'max:50'],
            'organization' => [],
            'address' => [],
            'contactNumber' => [],
            'email' => ['required', 'email', 'max:50'],
            'guesttype' => [],
            'attendance' => [],

        ]);

        // Assign default values
        $attributes['guesttype'] = $attributes['guesttype'] ?? 'Representative';
        $attributes['attendance'] = $attributes['attendance'] ?? 'off';

        Guest::create($attributes);


        session()->flash('success', 'Guest added successfully.');

        // Auth::login($user);
        return redirect('/Registrationform');
    }
}
