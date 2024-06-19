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
        dd($request);
        //
        $attributes = request()->validate([
            'name' => ['required', 'max:50'],
            'theme' => ['required', 'max:50'],
            'dateStart' => ['required'],
            'veneu' => ['max:70']

        ]);

        Event::create([
            'name'    => $attributes['name'],
            'theme' => $attributes['theme'],
            'dateStart'     => $attributes['dateStart'],
            'veneu' => $attributes['veneu'],
            'timeStart'    => $request["timeStart"],
            'created_by' => Auth::user()->id,
        ]);

        return redirect('event')->with('success', 'Record Created Successfully');
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
