<?php

namespace App\Http\Controllers;

use App\Models\Semester;
use App\Http\Requests\StoreSemesterRequest;
use App\Http\Requests\UpdateSemesterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SemesterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('semester.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('semester.create');
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
            'year' => 'required|integer|digits:4',
        ]);
        // Transform name to uppercase
        $attributes['name'] = strtoupper($attributes['name']);
        $attributes['code'] = strtoupper($attributes['code']);

        // Begin database transaction
        DB::beginTransaction();

        try {
            // Create a new Semester
            $e = Semester::create([
                'name'    => $attributes['name'],
                'code' => $attributes['code'],
                'year' => $attributes['year'],
                'created_by' => Auth::user()->name,
            ]);
            //Commit the transaction
            DB::commit();

            return redirect('semester')->with('success', 'Record Created Successfully');
        } catch (\Exception $e) {
            // Rollback the transaction in case of an error
            DB::rollback();
            // Optionally, you can log the error or return an error response
            return back()->withErrors(['error' => 'Failed to create semester: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Semester $semester)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $semester = Semester::find($id);

        return view('semester.edit', ['semester' => $semester]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Semester $semester)
    {
        if (isset($request["edit"])) {
            // Validate the request attributes
            $attributes = $request->validate([
                'name' => 'required|max:50',
                'code' => 'required',
                'year' => 'required|integer|digits:4',
            ]);
            // Transform name to uppercase
            $attributes['name'] = strtoupper($attributes['name']);
            $attributes['code'] = strtoupper($attributes['code']);

            // Begin database transaction
            DB::beginTransaction();

            try {
                $e = $semester->update([
                    'name'    => $attributes['name'],
                    'code' => $attributes['code'],
                    'year' => $attributes['year'],
                    'updated_by' => Auth::user()->name,
                ]);

                //Commit the transaction
                DB::commit(); // If no exception is thrown, the transaction will be committed

                return redirect('semester')->with('success', 'Record Updated Successfully');
            } catch (\Exception $e) {
                // Rollback the transaction in case of error
                DB::rollback();
                Log::error('Error updating semester record: ' . $e->getMessage());

                return redirect('semester')->with('error', 'Failed to update record. Please try again.');
            }
        } else if (isset($request["delete"])) {

            try {
                $e = $semester->update(

                    [
                        'updated_by' =>
                        Auth::user()->name,
                        'updated_at' => now(),
                    ]
                );
                $semester->delete();
                DB::commit();

                return redirect('semester')->with('success', 'Record Deleted Successfully');
            } catch (\Exception $e) {
                DB::rollback();
                Log::error('Error deleting semester record: ' . $e->getMessage());

                return redirect('semester')->with('error', 'Failed to delete record. Please try again.');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Semester $semester)
    {
        //
    }
}
