<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use App\Models\Faculty;
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
    public function store(StoreDepartmentRequest $request)
    {
        $attributes = $request->validate([
            'name' => ['required', 'max:50'],
            'code' => ['required'],
            'faculty_id' => ['required'],
        ]);
        $attributes['name'] = strtoupper($attributes['name']); // Transform name to uppercase
        $attributes['code'] = strtoupper($attributes['code']);
        DB::beginTransaction();

        try {
            $e = Department::create([
                'name'    => $attributes['name'],
                'code' => $attributes['code'],
                'faculty_id' => $attributes['faculty_id'],
                'created_by' => Auth::user()->name,
            ]);

            DB::commit();

            return redirect('department')->with('success', 'Record Created Successfully');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error creating department record: ' . $e->getMessage());

            return redirect('department')->with('error', 'Failed to create record. Please try again.');
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
    public function edit(Department $department)
    {
        $faculties = Faculty::all();
        return view('department.index', ['department' => $department, 'faculties' => $faculties]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDepartmentRequest $request, Department $department)
    {
        if (isset($request["edit"])) {
            $attributes = $request->validate([
                'name' => ['required', 'max:50'],
                'code' => ['required'],
                'faculty_id' => ['required'],
            ]);
            $attributes['name'] = strtoupper($attributes['name']); // Transform name to uppercase
            $attributes['code'] = strtoupper($attributes['code']);
            DB::beginTransaction();

            try {
                $e = $department->update([
                    'name'    => $attributes['name'],
                    'code' => $attributes['code'],
                    'faculty_id' => $attributes['faculty_id'],
                    'updated_by' => Auth::user()->name,
                ]);

                DB::commit();

                return redirect('department')->with('success', 'Record Updated Successfully');
            } catch (\Exception $e) {
                DB::rollback();
                Log::error('Error updating department record: ' . $e->getMessage());

                return redirect('department')->with('error', 'Failed to update record. Please try again.');
            }
        } else {
            //dd("destroy");

            try {
                $e = $department->update(

                    [
                        'updated_by' => Auth::id(),
                        'updated_at' => now(),
                    ]
                );
                $department->delete();
                DB::commit();

                return redirect('department')->with('success', 'Record Deleted Successfully');
            } catch (\Exception $e) {
                DB::rollback();
                Log::error('Error deleting course record: ' . $e->getMessage());

                return redirect('department')->with('error', 'Failed to delete record. Please try again.');
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
