<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Guest;
use App\Models\GuestCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class GuestController extends Controller
{
    /** copy from guestlistmanagement controller */
    public $selectedEventId;
    /**  end here */

    //
    public function index($event)
    {

        $event = Event::find($event);

        return view(
            'guest.index',
            ['event' => $event]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($event)
    {
        $event = Event::find($event);
        $category = GuestCategory::all()->where("event_id", "=", $event->id);
        return view('guest.create', ['event' => $event, 'categories' => $category]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $attributes = request()->validate([
            'event_id' => ['required'],
            'guest_category_id' => ['required'],
            'salutations' => ['required'],
            'name' => ['required', 'max:50'],
            'organization' => ['required'],
            'address' => ['required'],
            'contactNumber' => ['required'],
            'email' => ['required', 'email', 'max:50'],


        ]);
        $attributes['bringrep'] = isset($request['bringrep']) ? 'on' : null;
        // Assign default values
        $attributes['guesttype'] = $attributes['guesttype'] ?? 'Invitation';
        $attributes['created_by'] =   Auth::user()->id;
        Guest::create($attributes);

        return redirect()->route('guestl.index', $request['event_id'])->with('success', 'Record Created Successfully');
    }


    /**
     * Display the specified resource.
     */
    public function show(Guest $guest)
    {
        //
        return view('guest.edit', ['guest' => $guest]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id)
    {
        // Fetch the guest data for editing, assuming Guest model exists
        $guest = Guest::find($id);
        $event = Event::find($guest->event_id);
        $category = GuestCategory::all()->where("event_id", "=", $event->id);

        return view('guest.edit', ['event' => $event, 'guest' => $guest, 'categories' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // dd(isset($request["edit"]));
        $guest = Guest::findOrFail($id);
        if (isset($request["edit"])) {
            //
            $attributes = $request->validate([
                'event_id' => ['required'],
                'guest_category_id' => ['required'],
                'salutations' => ['required'],
                'name' => ['required', 'max:50'],
                'organization' => ['required'],
                'address' => ['required'],
                'contactNumber' => ['required'],
                'email' => ['required', 'email', 'max:50'],

            ]);


            // Assign default values

            $attributes['created_by'] =   Auth::user()->id;

            $guest->update([
                'name' => $attributes['name'],
                'salutations' => $attributes['salutations'],
                'organization' => $attributes['organization'],
                'address' =>  $attributes['address'],
                'contactNumber' => $attributes['contactNumber'],
                'email' => $attributes['email'],
                'checked' => isset($request['checkin']) ? now() : null,
                'checkedin' => isset($request['checkin']) ? 'on' : null,
                'bringrep' => isset($request['bringrep']) ? 'on' : null, // Check if bringrep checkbox is checked
                'guest_category_id' => $attributes['guest_category_id'],
                'updated_by' => Auth::id(),
                'updated_at' => now(),
            ]);

            return redirect()->route('guestl.index', [$guest->event_id])->with('success', 'Record Updated Successfully');
        } else {
            //dd("destroy");

            $guest->update(

                [
                    'updated_by' => Auth::id(),
                    'updated_at' => now(),
                ]
            );
            $guest->delete();
            return redirect()->route('guestl.index', [$guest->event_id])->with('success', 'Record Deleted');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        // dd("destroy");
        Event::find($request->event)->update(
            [
                'updated_by' => Auth::id(),
                'updated_at' => now(),
            ]
        );
        Event::find($request->event)->delete();
        return redirect()->route('event.index')->with('success', 'Record Deleted');
        //
        //
    }
    /* copy from guestlistmanagement controller */


    /**
     * Display a listing of the resource.
     */
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

    public function RepresentativeCreate($id)
    {
        $guest = Guest::find($id);
        return view('guest.Representative.representativeform', compact('guest'));
    }

    public function RepresentativeStore(Request $request, $id)
    {
        $guest = Guest::findOrFail($id); // Find the guest by ID

        $valid = $guest->bringrep;


        // Validate representative information
        $attributes = $request->validate([

            'name' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:50'],
            'event_id' => ['required'],
            'salutations' => ['required'],
            //'name' => ['required', 'max:50'],
            'organization' => ['required'],
            'address' => ['required'],
            'contactNumber' => ['required'],
            //'email' => ['required', 'email', 'max:50'],
        ]);


        // Set default values if not provided
        $attributes['guesttype'] = $attributes['guesttype'] ?? 'Representative';
        $attributes['bringrep'] = $attributes['bringrep'] = '';
        $category = GuestCategory::where('event_id', $attributes['event_id'])->first();
        $attributes['guest_category_id'] = $category->id;
        // Create new representative record
        $representative = Guest::create($attributes);

        session()->flash('success', $representative->name . ' added successfully.');

        return redirect('/Thankyouform');
    }



    public function walkincreate($event_id)
    {
        return view('guest.Walk-In.walkinregistrationform', ['event_id' => $event_id]);
    }

    public function walkinstore()
    {
        $attributes = request()->validate([
            'name' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:50'],
            'event_id' => ['required'],
            'salutations' => ['required'],
            //'name' => ['required', 'max:50'],
            'organization' => ['required'],
            'address' => ['required'],
            'contactNumber' => ['required'],
            //'email' => ['required', 'email', 'max:50'],

        ]);

        // Assign default values
        $attributes['guesttype'] = $attributes['guesttype'] ?? 'Walk-in';

        $attributes['checkedin'] = $attributes['checkedin'] ?? 'on';
        $category = GuestCategory::where('event_id', $attributes['event_id'])->first();
        $attributes['guest_category_id'] = $category->id;
        Guest::create($attributes);


        session()->flash('success', 'Thank you for registering.');

        // Auth::login($user);
        return redirect('/Thankyouform');
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
        $guest->rsvp = now();
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


    /* end here */
}
