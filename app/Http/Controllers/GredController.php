<?php

namespace App\Http\Controllers;

use App\Models\Gred;
use App\Http\Requests\StoreGredRequest;
use App\Http\Requests\UpdateGredRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class GredController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('grade.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('grade.create');
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
            // Create a new gred
            $e = Gred::create([
                'name'    => $attributes['name'],
                'code' => $attributes['code'],
                'created_by' => Auth::user()->name,
            ]);
            //Commit the transaction
            DB::commit();

            return redirect('grade')->with('success', 'Record Created Successfully');
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
    public function show(Gred $gred)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $gred = Gred::find($id);
        return view('grade.edit', ['gred' => $gred]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gred $gred)
    {
        if (isset($request["edit"])) {
            // Validate the request attributes
            $attributes = $request->validate([
                'name' => 'required|max:50',
                'code' => 'required',
                'grade_id' => 'required'
            ]);
            // Transform name and code to uppercase
            $attributes['name'] = strtoupper($attributes['name']);
            $attributes['code'] = strtoupper($attributes['code']);
            $gred = Gred::find($attributes['grade_id']);

            // Begin database transaction
            DB::beginTransaction();

            try {
                $e = $gred->update([
                    'name'    => $attributes['name'],
                    'code' => $attributes['code'],
                    'updated_by' => Auth::user()->name,
                ]);

                //Commit the transaction
                DB::commit(); // If no exception is thrown, the transaction will be committed

                return redirect('grade')->with('success', 'Record Updated Successfully');
            } catch (\Exception $e) {
                // Rollback the transaction in case of error
                DB::rollback();
                Log::error('Error updating department record: ' . $e->getMessage());

                return redirect('grade')->with('error', 'Failed to update record. Please try again.');
            }
        } else if (isset($request["delete"])) {

            try {
                $e = $gred->update(

                    [
                        'updated_by' =>
                        Auth::user()->name,
                        'updated_at' => now(),
                    ]
                );
                $gred->delete();
                DB::commit();

                return redirect('grade')->with('success', 'Record Deleted Successfully');
            } catch (\Exception $e) {
                DB::rollback();
                Log::error('Error deleting grade record: ' . $e->getMessage());

                return redirect('grade')->with('error', 'Failed to delete record. Please try again.');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gred $gred)
    {
        //
    }
}
