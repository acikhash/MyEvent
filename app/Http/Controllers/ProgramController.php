<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Http\Requests\StoreProgramRequest;
use App\Http\Requests\UpdateProgramRequest;
use App\Models\Department;
use App\Models\Staff;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $programs = Program::all();
        return view('program.index', compact('programs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $staffs = Staff::all();
        $departments = Department::all();
        return view('program.create', compact('staffs', 'departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProgramRequest $request)
    {
        $attributes = request()->validate([
            'name' => ['required', 'max:50'],
            'code' => ['required', 'email'],
            'department_id' => ['required'],
            'staff_id' => ['required']
        ]);
        $attributes['name'] = strtoupper($attributes['name']); // Transform name to uppercase
        $attributes['code'] = strtoupper($attributes['code']);
        $department = Department::find($attributes['department_id']);
        $coordinator = Staff::find($attributes['staff_id']);
        DB::beginTransaction();

        try {
            $e = Program::create([
                'name'    => $attributes['name'],
                'code' => $attributes['code'],
                'department_id' => $attributes['department_id'],
                'department' => $department->code,
                'staff_id' => $attributes['staff_id'],
                'coordinator' => $coordinator->name,
                'created_by' => Auth::user()->name,
            ]);

            DB::commit();

            return redirect('staff')->with('success', 'Record Created Successfully');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error creating program record: ' . $e->getMessage());

            return redirect('program')->with('error', 'Failed to create record. Please try again.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Program $program)
    {
        $staffs = Staff::all();
        $departments = Department::all();
        return view('program.show', compact('program', 'staffs', 'departments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Program $program)
    {
        $staffs = Staff::all();
        $departments = Department::all();
        return view('program.show', compact('program', 'staffs', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProgramRequest $request, Program $program)
    {
        if (isset($request["edit"])) {
            $attributes = request()->validate([
                'name' => ['required', 'max:50'],
                'code' => ['required', 'email'],
                'department_id' => ['required'],
                'staff_id' => ['required']
            ]);
            $attributes['name'] = strtoupper($attributes['name']); // Transform name to uppercase
            $attributes['code'] = strtoupper($attributes['code']);
            $department = Department::find($attributes['department_id']);
            $coordinator = Staff::find($attributes['staff_id']);
            DB::beginTransaction();

            try {
                $e = $program->update([
                    'name'    => $attributes['name'],
                    'code' => $attributes['code'],
                    'department_id' => $attributes['department_id'],
                    'department' => $department->code,
                    'staff_id' => $attributes['staff_id'],
                    'coordinator' => $coordinator->name,
                    'updated_by' => Auth::user()->name,
                ]);

                DB::commit();

                return redirect('program')->with('success', 'Record Updated Successfully');
            } catch (\Exception $e) {
                DB::rollback();
                Log::error('Error updating program record: ' . $e->getMessage());

                return redirect('program')->with('error', 'Failed to update record. Please try again.');
            }
        } else {
            //dd("destroy");

            try {
                $e = $program->update(

                    [
                        'updated_by' => Auth::id(),
                        'updated_at' => now(),
                    ]
                );
                $program->delete();
                DB::commit();

                return redirect('program')->with('success', 'Record Deleted Successfully');
            } catch (\Exception $e) {
                DB::rollback();
                Log::error('Error deleting program record: ' . $e->getMessage());

                return redirect('program')->with('error', 'Failed to delete record. Please try again.');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Program $program)
    {
        $program->delete();
        return redirect()->route('program.index')->with('success', 'Program deleted successfully.');
    }
}
