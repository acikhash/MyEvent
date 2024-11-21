<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Gred;
use App\Models\Major;
use App\Models\Title;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $staff = Staff::all();
        return view('staff.index', compact('staff'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::all();
        $titles = Title::all();
        $greds = Gred::all();
        $majors = Major::all();
        return view('staff.create', ['departments' => $departments, 'greds' => $greds, 'titles' => $titles, 'majors' => $majors]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attributes = request()->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:staff,email',
            'phone' => 'required|string|max:15',
            'gred_id' => 'required|exists:greds,id',
            'department_id' => 'required|exists:departments,id',
            'title_id' => 'required|exists:titles,id',
            'major_id' => 'required|exists:majors,id',
        ]);
        $attributes['name'] = strtoupper($attributes['name']); // Transform name to uppercase
        $title = Title::find($attributes['title_id']); // get title name
        $gred = Gred::find($attributes['gred_id']);
        $department = Department::find($attributes['department_id']);
        $major = Major::find($attributes['major_id']);
        DB::beginTransaction();

        try {
            $e = Staff::create([
                'name'    => $attributes['name'],
                'email' => $attributes['email'],
                'phone' => $request['phone'],
                'gred_id' => $attributes['gred_id'],
                'gred' => $gred->code,
                'department_id' => $attributes['department_id'],
                'department' => $department->code,
                'title_id' => $attributes['title_id'],
                'title' => $title->name,
                'major_id' => $attributes['major_id'],
                'major' => $major->name,
                'created_by' => Auth::user()->name,
            ]);

            DB::commit();

            return redirect('staff')->with('success', 'Record Created Successfully');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error creating staff record: ' . $e->getMessage());

            return redirect('staff')->with('error', 'Failed to create record. Please try again.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Staff $staff)
    {
        return view('staff.show', compact('staff'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id)
    {
        $staff = Staff::find($id);

        $departments = Department::all();
        $titles = Title::all();
        $greds = Gred::all();
        $majors = Major::all();
        return view('staff.edit', ['staff' => $staff, 'departments' => $departments, 'greds' => $greds, 'titles' => $titles, 'majors' => $majors]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Staff $staff)
    {

        if (isset($request["edit"])) {
            $attributes = request()->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email',
                'phone' => 'required|string|max:15',
                'gred_id' => 'required|exists:greds,id',
                'department_id' => 'required|exists:departments,id',
                'title_id' => 'required|exists:titles,id',
                'major_id' => 'required|exists:majors,id',
            ]);
            $attributes['name'] = strtoupper($attributes['name']); // Transform name to uppercase
            $title = Title::find($attributes['title_id']); // get title name
            $gred = Gred::find($attributes['gred_id']);
            $department = Department::find($attributes['department_id']);
            $major = Major::find($attributes['major_id']);
            DB::beginTransaction();

            try {
                $e = $staff->update([
                    'name'    => $attributes['name'],
                    'email' => $attributes['email'],
                    'phone' => $attributes['phone'],
                    'gred_id' => $attributes['gred_id'],
                    'gred' => $gred->code,
                    'department_id' => $attributes['department_id'],
                    'department' => $department->code,
                    'title_id' => $attributes['title_id'],
                    'title' => $title->name,
                    'major_id' => $attributes['major_id'],
                    'major' => $major->name,
                    'updated_by' => Auth::user()->name,
                ]);

                DB::commit();

                return redirect('staff')->with('success', 'Record Updated Successfully');
            } catch (\Exception $e) {
                DB::rollback();
                Log::error('Error updating staff record: ' . $e->getMessage());

                return redirect('staff')->with('error', 'Failed to update record. Please try again.');
            }
        } else {
            //dd("destroy");

            try {
                $e = $staff->update(

                    [
                        'updated_by' => Auth::id(),
                        'updated_at' => now(),
                    ]
                );
                $staff->delete();
                DB::commit();

                return redirect('staff')->with('success', 'Record Deleted Successfully');
            } catch (\Exception $e) {
                DB::rollback();
                Log::error('Error deleting staff record: ' . $e->getMessage());

                return redirect('staff')->with('error', 'Failed to delete record. Please try again.');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Staff $staff)
    {
        $staff->delete();
        return redirect()->route('staff.index')->with('success', 'Staff member deleted successfully.');
    }
}
