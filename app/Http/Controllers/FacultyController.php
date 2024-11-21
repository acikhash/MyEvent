<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Http\Requests\StoreFacultyRequest;
use App\Http\Requests\UpdateFacultyRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $faculties = Faculty::all();
        return view('faculty.index', compact('faculties'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('faculty.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request attributes
        $attributes = $request->validate([
            'name' => 'required|max:50',
            'code' => 'required',
        ]);
        // Transform name and code to uppercase
        $attributes['name'] = strtoupper($attributes['name']);
        $attributes['code'] = strtoupper($attributes['code']);

        // Begin database transaction
        DB::beginTransaction();

        try {
            // Create a new faculty
            $e = Faculty::create([
                'name'    => $attributes['name'],
                'code' => $attributes['code'],
                'created_by' => Auth::user()->name,
            ]);
            //Commit the transaction
            DB::commit();

            return redirect('faculty')->with('success', 'Record Created Successfully');
        } catch (\Exception $e) {
            // Rollback the transaction in case of an error
            DB::rollback();
            // Optionally, you can log the error or return an error response
            return back()->withErrors(['error' => 'Failed to create faculty: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Faculty $faculty)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $faculty = Faculty::find($id);

        return view('faculty.edit', ['faculty' => $faculty]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Faculty $faculty)
    {
        if (isset($request["edit"])) {
            // Validate the request attributes
            $attributes = $request->validate([
                'name' => 'required|max:50',
                'code' => 'required',
            ]);
            // Transform name and code to uppercase
            $attributes['name'] = strtoupper($attributes['name']);
            $attributes['code'] = strtoupper($attributes['code']);

            // Begin database transaction
            DB::beginTransaction();

            try {
                $e = $faculty->update([
                    'name'    => $attributes['name'],
                    'code' => $attributes['code'],
                    'updated_by' => Auth::user()->name,
                ]);

                //Commit the transaction
                DB::commit(); // If no exception is thrown, the transaction will be committed

                return redirect('faculty')->with('success', 'Record Updated Successfully');
            } catch (\Exception $e) {
                // Rollback the transaction in case of error
                DB::rollback();
                Log::error('Error updating department record: ' . $e->getMessage());

                return redirect('faculty')->with('error', 'Failed to update record. Please try again.');
            }
        } else if (isset($request["delete"])) {

            try {
                $e = $faculty->update(

                    [
                        'updated_by' =>
                        Auth::user()->name,
                        'updated_at' => now(),
                    ]
                );
                $faculty->delete();
                DB::commit();

                return redirect('faculty')->with('success', 'Record Deleted Successfully');
            } catch (\Exception $e) {
                DB::rollback();
                Log::error('Error deleting faculty record: ' . $e->getMessage());

                return redirect('faculty')->with('error', 'Failed to delete record. Please try again.');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Faculty $faculty)
    {
        //
    }
}
