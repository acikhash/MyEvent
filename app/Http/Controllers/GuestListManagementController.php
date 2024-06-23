<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Guest;
use App\Models\Event;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        ]);

        Guest::create($attributes);


        session()->flash('success', 'Guest added successfully.');

        // Auth::login($user);
        return redirect('/Registrationform');
    }
}
