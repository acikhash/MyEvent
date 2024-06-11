<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\View;


class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // $list = Event::paginate(10);
        return view('event.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('event.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $attributes = request()->validate([
            'name' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:50'],
            'phone'     => ['max:12'],
            'location' => ['max:70'],
            'about_me'    => ['max:150'],
        ]);



        Event::where('id',)
            ->cr([
                'name'    => $attributes['name'],
                'email' => $attributes['email'],
                'phone'     => $attributes['phone'],
                'veneu' => $attributes['location'],
                'about_me'    => $attributes["about_me"],
                'created_by' => Auth::user()->id,
            ]);


        return redirect('/user-profile')->with('success', 'Profile updated successfully');
        return redirect()->route('event.index')->with('success', 'Record Created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        //
        return view('event.edit', ['event' => $event]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        //
        return view('event.edit', ['event' => $event]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateeventRequest $request, Event $event)
    {
        //
        $event = Event::find($request->id);
        return view('event.edit', ['event' => $event]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        //
    }
}
