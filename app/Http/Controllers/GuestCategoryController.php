<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\GuestCategory;
use App\Http\Requests\StoreGuestCategoryRequest;
use App\Http\Requests\UpdateGuestCategoryRequest;
use App\Http\Controllers\Request;

class GuestCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($event)
    {
        //
        $event = Event::find($event);
        return view('guestcategory.index', ['event' => $event]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($event)
    {
        $event = Event::find($event);
        return view('guestcategory.create', ['event' => $event]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGuestCategoryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(GuestCategory $guestCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GuestCategory $guestCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGuestCategoryRequest $request, GuestCategory $guestCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GuestCategory $guestCategory)
    {
        //
    }
}
