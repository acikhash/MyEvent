<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\GuestCategory;
use App\Http\Requests\StoreGuestCategoryRequest;
use App\Http\Requests\UpdateGuestCategoryRequest;
use App\Http\Controllers\Request;
use Illuminate\Support\Facades\Auth;

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
        $attributes = $request->validate([
            'name' => ['required', 'max:50'],
            'description' => ['required', 'max:150']

        ]);

        GuestCategory::create([
            'name'    => $attributes['name'],
            'description' => $attributes['description'],

            'created_by' => Auth::user()->id,
        ]);

        return redirect('guestcategory')->with('success', 'Record Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(GuestCategory $guestcategory)
    {
        //
        return view('guestcategory.edit', ['guestcategory' => $guestcategory]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id)
    {
        //
        $guestcategory = GuestCategory::find($id);
        return view('guestcategory.edit', ['guestcategory' => $guestcategory]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGuestCategoryRequest $request, GuestCategory $guestcategory)
    {
        //
        $guestCategory = GuestCategory::find($request->id);
        if (isset($request["edit"])) {
            //
            $attributes = request()->validate([
                'name' => ['required', 'max:50'],
                'description' => ['required', 'max:150']

            ]);

            $guestCategory->update([
                'name'    => $attributes['name'],
                'decription' => $attributes['description'],
                'updated_by' => Auth::id(),
                'updated_at' => now(),
            ]);

            return redirect('event')->with('success', 'Record Updated Successfully');
        } else {
            //dd("destroy");

            $guestCategory->update(

                [
                    'updated_by' => Auth::id(),
                    'updated_at' => now(),
                ]
            );
            $guestCategory->delete();
            return redirect()->route('guestcategory.index')->with('success', 'Record Deleted');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UpdateGuestCategoryRequest $request)
    {
        //
        GuestCategory::find($request->event)->update(
            [
                'updated_by' => Auth::id(),
                'updated_at' => now(),
            ]
        );
        GuestCategory::find($request->event)->delete();
        return redirect()->route('event.index')->with('success', 'Record Deleted');
    }
}
