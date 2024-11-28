<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Http\Requests\StoreAssignmentRequest;
use App\Http\Requests\UpdateAssignmentRequest;
use App\Models\Course;
use App\Models\Department;
use App\Models\Program;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Exports\WorkloadExport;

class AssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('assignment.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $staff = Staff::all();
        return view('assignment.create', ['staff' => $staff]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Assignment $assignment)
    {
        return view('workload.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $programs = Program::all();
        $assignment = Course::find($id);
        $course = Course::find($id);
        $staffs = Staff::all();
        return view('assignment.edit', ['staffs' => $staffs, 'assignment' => $assignment, 'programs' => $programs, 'course' => $course]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Assignment $assignment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Assignment $assignment)
    {
        //
    }

    /**
     * Download to excel the workload of staff separate each department in different sheet.
     */
    public function workload(Assignment $assignment)
    {
        $departments = Department::all()->pluck('code'); // Assuming you have a Department model
        return Excel::download(new WorkloadExport($departments), 'workloadByDepartment.xlsx');
    }
}
