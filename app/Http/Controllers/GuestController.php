<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Guest;
use App\Models\GuestCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class GuestController extends Controller
{
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
        $attributes['bringrep'] = request('bringrep');
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
            // $attributes['guesttype'] = request('guesttype');
            $attributes['created_by'] =   Auth::user()->id;

            $guest->update([
                'name'    => $attributes['name'],
                'salutations' => $attributes['salutations'],
                'organization'     => $attributes['organization'],
                'address'     =>
                $attributes['address'],
                'contactNumber' => $attributes['contactNumber'],
                'email'    =>
                $attributes['email'],
                //'guesttype'    => $attributes['guesttype'],
                // Update guest attributes based on form submission
                'checkedin' => $request['checkin'],
                'bringrep' => $request['bringrep'], // Check if bringrep checkbox is checked
                'guest_category_id'
                => $attributes['guest_category_id'],
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
}
