<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use Illuminate\Http\RedirectResponse;

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
    public function store(StoreEventRequest $request): RedirectResponse
    {
        //
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
