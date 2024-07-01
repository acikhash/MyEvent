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

        // $attributes = request()->validate([
        //     'name' => ['required', 'max:50'],
        //     'theme' => ['required', 'max:50'],
        //     'dateStart' => ['required'],
        //     'veneu' => ['max:70']

        // ]);


        // // dd($request);
        // Guest::create([
        //     'name'    => $attributes['name'],
        //     'theme' => $attributes['theme'],
        //     'veneu' => $attributes['veneu'],
        //     'timeStart'    => $request["timeStart"],
        //     'timeEnd'    => $request["timeEnd"],
        //     'maxGuest' => $request["maxGuest"],
        //     'organizer' => $request["organizer"],
        //     'about' => $request["about"],
        //     'created_by' => Auth::user()->id,
        // ]);

        // return redirect('guest')->with('success', 'Record Created Successfully');
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
        //dd($id);
        $event = Event::find($id);
        //dd($event->name);
        return view('guestl.edit', ['event' => $event]);
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
                'salutations' => [],
                'guest_category_id' => ['required'],
                'name' => ['required', 'max:50'],
                'organization' => [],
                'address' => [],
                'contactNumber' => [],
                'email' => ['required', 'email', 'max:50'],
                'guesttype' => [],
                'attendance' => [],
                'bringrep' => [],
            ]);


            $guest->update([
                'name'    => $attributes['name'],
                'salutations' => $attributes['salutations'],
                'organization'     => $attributes['organization'],
                'address'     =>
                $attributes['address'],
                'contactNumber' => $attributes['contactNumber'],
                'email'    =>
                $attributes['email'],
                'guesttype'    => $attributes['guesttype'],
                'attendance' => $attributes['attendance'],
                'bringrep' => $attributes['bringrep'],
                'category_id' => $request["about"],
                'updated_by' => Auth::id(),
                'updated_at' => now(),
            ]);

            return redirect()->route('guest.index', [$guest->event_id])->with('success', 'Record Updated Successfully');
        } else {
            //dd("destroy");

            $guest->update(

                [
                    'updated_by' => Auth::id(),
                    'updated_at' => now(),
                ]
            );
            $guest->delete();
            return redirect()->route('guest.index', [$guest->event_id])->with('success', 'Record Deleted');
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
