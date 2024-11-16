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
            'name' => ['required', 'max:50'],
            'email' => ['required']
        ]);

        DB::beginTransaction();

        try {
            $e = Staff::create([
                'name'    => $attributes['name'],
                'email' => $attributes['email'],
                'department_id' => $request->department_id,
                'title_id' => $request->title_id,
                'major_id' => $request->major_id,
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
    public function edit(Staff $staff)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreStaffRequest $request, Staff $staff)
    {
        $staff->update($request->validated());
        return redirect()->route('staff.index')->with('success', 'Staff member updated successfully.');
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
