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
use App\Models\Semester;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
        $rows = $request->input('rows'); // Retrieve all rows from the request.
        // Define validation rules
        $validatedData = $request->validate([
            'rows' => 'required|array', // Ensure rows is an array
            'rows.*.staff_id' => 'required|integer|exists:staff,id', // Ensure ID exists in the staff table
            'rows.*.staff_name' => 'required|string|max:255',
            'rows.*.notes' => 'nullable|string|max:255', //not required
            'rows.*.action' => 'nullable|string|max:255', //not required
            'course_id' =>  'required|integer|exists:courses,id', // Ensure ID exists in the course table
            'semester_id' => 'required|integer|exists:semesters,id', // Ensure ID exists in the semester table
            'code' => 'required|string|max:100',
            'credit' => 'required|integer',
            'year' => 'required|integer',
            'semester' => 'required|string|max:100',
        ]);

        // dd($request);
        // If validation passes, process each row
        // Loop through each assignment and save to the database
        foreach ($validatedData['rows'] as $rowData) {
             DB::beginTransaction();
            try {
               
                $action = $rowData['action'] ?? null;
                $notes = $rowData['notes'] ?? null;
                $updatedBy = Auth::user()->name;

                // Fetch existing assignment
                $assign = Assignment::where('course_id', $validatedData['course_id'])
                    ->where('staff_id', $rowData['staff_id'])
                    ->first();
                
                if ($action === 'delete' && $assign) {
                    // Delete the assignment
                    $assign->update([
                        'notes' => $notes,
                        'updated_by' => $updatedBy,
                    ]);
                    $assign->delete();
                    
                    Log::info('Record deleted successfully: Course ID ' . $validatedData['course_id'] . ', Staff ID ' . $rowData['staff_id']);
                } elseif ($action !== 'delete' && $assign) {
                    // Update the assignment
                    $assign->update([
                        'notes' => $notes,
                        'updated_by' => $updatedBy,
                    ]);
                    
                    Log::info('Record updated successfully: Course ID ' . $validatedData['course_id'] . ', Staff ID ' . $rowData['staff_id']);
                } elseif (!$assign && $action === 'new') {
                    // Create new assignment
                    Assignment::create([
                        'staff_id' => $rowData['staff_id'],
                        'staff_name' => $rowData['staff_name'],
                        'course_id' => $validatedData['course_id'],
                        'semester_id' => $validatedData['semester_id'],
                        'course_code' => $validatedData['code'],
                        'credit' => $validatedData['credit'],
                        'year' => $validatedData['year'],
                        'semester' => $validatedData['semester'],
                        'notes' => $notes,
                        'created_by' => $updatedBy,
                    ]);
                   
                    Log::info('Record created successfully: Course ID ' . $validatedData['course_id'] . ', Staff ID ' . $rowData['staff_id']);
                }
                 DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
                Log::error('Error processing record: ' . $e->getMessage());
            }
        }
        return back()->with('success', 'Record Created Successfully');
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
        $staffs = Staff::whereIn('id', function ($query) use ($id) {
            $query->select('staff_id')
                ->from('Assignments')
                ->where('course_id', $id);
        })->get();
        $semesters = Semester::all();
        $programs = Program::all();
        $assignments = Assignment::where('course_id', $id)->get();
        $course = Course::find($id);

        $departments = Department::all();
        return view('assignment.edit', ['staffs' => $staffs, 'assignments' => $assignments, 'programs' => $programs, 'course' => $course, 'departments' => $departments, 'semesters' => $semesters]);
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
