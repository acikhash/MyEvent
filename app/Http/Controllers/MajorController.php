<?php

namespace App\Http\Controllers;

use App\Models\Major;
use App\Http\Requests\StoreMajorRequest;
use App\Http\Requests\UpdateMajorRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MajorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('major.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('major.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request attributes
        $attributes = $request->validate([
            'name' => 'required|max:50',
            'credit' => 'required',
        ]);
        // Transform name to uppercase
        $attributes['name'] = strtoupper($attributes['name']);


        // Begin database transaction
        DB::beginTransaction();

        try {
            // Create a new Major
            $e = Major::create([
                'name'    => $attributes['name'],
                'credit' => $attributes['credit'],
                'created_by' => Auth::user()->name,
            ]);
            //Commit the transaction
            DB::commit();

            return redirect('major')->with('success', 'Record Created Successfully');
        } catch (\Exception $e) {
            // Rollback the transaction in case of an error
            DB::rollback();
            // Optionally, you can log the error or return an error response
            return back()->withErrors(['error' => 'Failed to create major: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Major $major)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $major = Major::find($id);

        return view('major.edit', ['major' => $major]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Major $major)
    {
        if (isset($request["edit"])) {
            // Validate the request attributes
            $attributes = $request->validate([
                'name' => 'required|max:50',
                'credit' => 'required',
            ]);
            // Transform name and code to uppercase
            $attributes['name'] = strtoupper($attributes['name']);

            // Begin database transaction
            DB::beginTransaction();

            try {
                $e = $major->update([
                    'name'    => $attributes['name'],
                    'credit' => $attributes['credit'],
                    'updated_by' => Auth::user()->name,
                ]);

                //Commit the transaction
                DB::commit(); // If no exception is thrown, the transaction will be committed

                return redirect('major')->with('success', 'Record Updated Successfully');
            } catch (\Exception $e) {
                // Rollback the transaction in case of error
                DB::rollback();
                Log::error('Error updating major record: ' . $e->getMessage());

                return redirect('major')->with('error', 'Failed to update record. Please try again.');
            }
        } else if (isset($request["delete"])) {

            try {
                $e = $major->update(

                    [
                        'updated_by' =>
                        Auth::user()->name,
                        'updated_at' => now(),
                    ]
                );
                $major->delete();
                DB::commit();

                return redirect('major')->with('success', 'Record Deleted Successfully');
            } catch (\Exception $e) {
                DB::rollback();
                Log::error('Error deleting major record: ' . $e->getMessage());

                return redirect('major')->with('error', 'Failed to delete record. Please try again.');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Major $major)
    {
        //
    }
}
