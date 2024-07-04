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
    public $selectedEventId;

    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $event = Event::find($id);
        // dd($event);
        return view('guest.index', compact('event'));
    }

    public function GuestList()
    {
        // Fetch necessary data from your database or other sources
        $events = Event::all(); // Fetch all events for the dropdown

        $guests = Guest::query()
            ->when($this->selectedEventId, function ($query) {
                $query->where('event_id', $this->selectedEventId);
            })
            ->get();

        return view('guest.guestlist', [
            'guests' => $guests,
            'events' => $events,
        ]);

        //return view('guest.guestlist');
    }

    public function EventTables()
    {
        $events = Event::all();
        return view('guest.eventtables', compact('events'));
    }


    public function create()
    {
        return view('guest.Invitation.registrationform');
    }



    //for invitations guest type
    public function store()
    {
        //dd(request());


        $attributes = request()->validate([
            'event_id' => ['required'],
            'guest_category_id' => ['required'],
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
        // dd($attributes);

        // Assign default values
        $attributes['guesttype'] = $attributes['guesttype'] ?? 'Invitation';
        //$attributes['attendance'] = $attributes['attendance'] ?? 'off';
        $totalGuest = Guest::all()->count();
        $event = Event::find(request('event_id'));
        if ($totalGuest < intval($event->maxGuest)) {
            Guest::create($attributes);
        }

        //session()->flash('success', 'Guest added successfully.');

        // Auth::login($user);
        return redirect('/GuestList')->with('success', 'Guest added successfully.');
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
        $guest = Guest::findOrFail($id);

        if ($request->has('delete')) {
            // Delete guest
            $guest->delete();
            return redirect('/GuestList')->with('success', 'Guest deleted successfully.');
        }

        $attributes = $request->validate([
            'eventid',
            'eventname',
            'salutations' => [],
            'name' =>  ['required', 'max:50'],
            'organization' => [],
            'address' => [],
            'contactNumber' => [],
            'email' => ['required', 'email', 'max:50'],
            'bringrep' => '',
            'attendance' => [],

        ]);


        $guest = Guest::find($id);

        $guest->bringrep = $request->has('bringrep') ? 'on' : 'off';

        // Assuming fillable fields in Guest model
        $guest->fill($attributes);
        $guest->save();



        session()->flash('success', 'successfully updated.');

        // Auth::login($user);
        return redirect('/GuestList');
    }

    public function RepresentativeCreate($id)
    {
        $guest = Guest::find($id);
        $event = Event::find($id);
        return view('guest.Representative.representativeform', compact('guest','event'));
    }

    public function RepresentativeStore(Request $request, $id)
    {
        $guest = Guest::findOrFail($id); // Find the guest by ID
        //$event = Event::find($guest->event_id);

        $valid = $guest->bringrep;


        // Validate representative information
        $attributes = $request->validate([
            'event_id',
            'salutations' => [],
            'name' => ['required', 'max:50'],
            'organization' => [],
            'address' => [],
            'contactNumber' => [],
            'email' => ['required', 'email', 'max:50'],
            'guesttype' => [],
            'attendance' => [],
            'bringrep' => [],
        ]);

        

        // Assign event details
        //$attributes['eventid'] = $guest->eventid;
        //$attributes['eventname'] = $guest->eventname;

        // Set default values if not provided
        $attributes['guesttype'] = $attributes['guesttype'] ?? 'Representative';
        $attributes['bringrep'] = $attributes['bringrep'] ?? 'No';
        $attributes['event_id'] = $guest->event_id;
        //dd($attributes);

        // Create new representative record
        $representative = Guest::create($attributes);

        session()->flash('success', 'Guest added successfully.');

        return redirect('/Thankyouform');
    }





    public function walkincreate()
    {
        return view('guest.Walk-In.walkinregistrationform');
    }




    public function walkinstore()
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
            'checkedin' => [],

        ]);

        // Assign default values
        $attributes['guesttype'] = $attributes['guesttype'] ?? 'Walk-in';
        $attributes['attendance'] = $attributes['attendance'] ?? 'on';
        $attributes['bringrep'] = $attributes['bringrep'] ?? 'off';
        $attributes['checkedin'] = $attributes['checkedin'] ?? 'on';

        Guest::create($attributes);


        session()->flash('success', 'Thank you for registering.');

        // Auth::login($user);
        return redirect('/Walk-inRegistrationform');
    }



    public function Updateattendanceshow($id)
    {
        $guest = Guest::find($id);

        if ($guest->attendance !== null) {

            return redirect('/Thankyouform')->with('success', 'Attendance updated successfully.');
        } else {

            return view("guest.Attendance.Updateattendanceform", compact('guest'));
        }
    }
    public function Updateattendancestore(Request $request, $id)
    {
        $guest = Guest::find($id);


        if ($guest->attendance !== null) {
            return redirect("/Thankyouform");
        }


        // Validate request data
        $attributes = $request->validate([
            'attendance' => 'required|string|in:on,off', // Validate attendance as a string and allow only 'on' or 'off'
            'bringrep' => [], // Assuming this is an array that might contain other data
        ]);


        // Update guest attributes based on form submission
        $guest->attendance = $request->input('attendance');
        $guest->bringrep = $request->has('bringrep') ? 'on' : 'off'; // Check if bringrep checkbox is checked
        $guest->save();


        // Check if bringrep is 'yes' to redirect to representative form
        if ($request->has('bringrep') && $request->input('bringrep') == 'on') {
            return redirect("/guest/{$id}/Representativeform")->with('success', 'Attendance updated successfully.');
        } else {
            return redirect('/Thankyouform')->with('success', 'Attendance updated successfully.');
        }
    }


    public function Thankyou()
    {
        return view('guest.Attendance.Thankyouform');
    }








    /* QR code
       public function show($id)
    {
        // Fetch guest information
        $guest = Guest::findOrFail($id);

        // Generate QR code content
        $qrCodeContent = url('/confirmation/' . $guest->id);

        // Generate QR code image
        $qrCode = QrCode::size(200)->generate($qrCodeContent);

        // Pass the QR code image and guest data to the view
        return view('guest.show', compact('guest', 'qrCode'));
    }

    public function confirmation($id)
    {
        $guest = Guest::findOrFail($id);

        return view('guest.confirmation', compact('guest'));

    }*/
}
