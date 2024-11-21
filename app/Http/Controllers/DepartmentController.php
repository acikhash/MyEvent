<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use App\Models\Faculty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $faculties = Faculty::all();
        $department = Department::all();
        return view('department.index', ['department' => $department, 'faculties' => $faculties]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $faculties = Faculty::all();
        return view('department.create', ['faculties' => $faculties]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    { // Validate the request attributes
        $attributes = $request->validate([
            'name' => 'required|max:50',
            'code' => 'required',
            'faculty_id' => 'required|exists:faculties,id',
        ]);
        // Transform name and code to uppercase
        $attributes['name'] = strtoupper($attributes['name']);
        $attributes['code'] = strtoupper($attributes['code']);

        // Begin database transaction
        DB::beginTransaction();

        try {
            // Create a new department
            $e = Department::create([
                'name'    => $attributes['name'],
                'code' => $attributes['code'],
                'faculty_id' => $attributes['faculty_id'],
                'created_by' => Auth::user()->name,
            ]);
            //Commit the transaction
            DB::commit();

            return redirect('departments')->with('success', 'Record Created Successfully');
        } catch (\Exception $e) {
            // Rollback the transaction in case of an error
            DB::rollback();
            // Optionally, you can log the error or return an error response
            return back()->withErrors(['error' => 'Failed to create department: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $department = Department::find($id);
        $faculties = Faculty::all();
        return view('department.edit', ['department' => $department, 'faculties' => $faculties]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Department $department)
    {
        if (isset($request["edit"])) {
            // Validate the request attributes
            $attributes = $request->validate([
                'name' => 'required|max:50',
                'code' => 'required',
                'faculty_id' => 'required|exists:faculties,id',
            ]);
            // Transform name and code to uppercase
            $attributes['name'] = strtoupper($attributes['name']);
            $attributes['code'] = strtoupper($attributes['code']);

            // Begin database transaction
            DB::beginTransaction();

            try {
                $e = $department->update([
                    'name'    => $attributes['name'],
                    'code' => $attributes['code'],
                    'faculty_id' => $attributes['faculty_id'],
                    'updated_by' => Auth::user()->name,
                ]);

                //Commit the transaction
                DB::commit(); // If no exception is thrown, the transaction will be committed

                return redirect('departments')->with('success', 'Record Updated Successfully');
            } catch (\Exception $e) {
                // Rollback the transaction in case of error
                DB::rollback();
                Log::error('Error updating department record: ' . $e->getMessage());

                return redirect('departments')->with('error', 'Failed to update record. Please try again.');
            }
        } else if (isset($request["delete"])) {

            try {
                $e = $department->update(

                    [
                        'updated_by' =>
                        Auth::user()->name,
                        'updated_at' => now(),
                    ]
                );
                $department->delete();
                DB::commit();

                return redirect('departments')->with('success', 'Record Deleted Successfully');
            } catch (\Exception $e) {
                DB::rollback();
                Log::error('Error deleting department record: ' . $e->getMessage());

                return redirect('departments')->with('error', 'Failed to delete record. Please try again.');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        //
    }
}
