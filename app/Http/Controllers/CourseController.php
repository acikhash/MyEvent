<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Models\Program;
use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::all();
        return view('course.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $programs = Program::all();
        $semesters = Semester::all();
        return view('course.create', ['programs' => $programs, 'semesters' => $semesters]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name' => ['required', 'max:50'],
            'code' => ['required'],
            'section' => ['required'],
            'credit' => ['required'],
            'no_of_student' => ['required'],
            'program_id' => ['required'],
        ]);
        $attributes['name'] = strtoupper($attributes['name']); // Transform name to uppercase
        $attributes['code'] = strtoupper($attributes['code']);
        DB::beginTransaction();

        try {
            $e = Course::create([
                'name'    => $attributes['name'],
                'code' => $attributes['code'],
                'section' => $attributes['section'],
                'credit' => $attributes['credit'],
                'no_of_student' => $attributes['no_of_student'],
                'program_id' => $attributes['program_id'],
                'created_by' => Auth::user()->name,
            ]);

            DB::commit();

            return redirect('course')->with('success', 'Record Created Successfully');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error creating course record: ' . $e->getMessage());

            return redirect('course')->with('error', 'Failed to create record. Please try again.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        return view('course.show', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Retrieve the course from the database or return a 404 response if not found
        $course = Course::findOrFail($id);

        // Retrieve all programs
        $programs = Program::all();
        $semesters = Semester::all();
        // Return the edit view with the course and programs data
        return view('course.edit', compact('programs', 'course', 'semesters'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        if (isset($request["edit"])) {
            $attributes = $request->validate([
                'name' => ['required', 'max:50'],
                'code' => ['required'],
                'section' => ['required'],
                'credit' => ['required'],
                'no_of_student' => ['required'],
                'program_id' => ['required'],
            ]);
            $attributes['name'] = strtoupper($attributes['name']); // Transform name to uppercase
            $attributes['code'] = strtoupper($attributes['code']);
            DB::beginTransaction();

            try {
                $e = $course->update([
                    'name'    => $attributes['name'],
                    'code' => $attributes['code'],
                    'section' => $attributes['section'],
                    'credit' => $attributes['credit'],
                    'no_of_student' => $attributes['no_of_student'],
                    'program_id' => $attributes['program_id'],
                    'updated_by' => Auth::user()->name,
                ]);

                DB::commit();

                return redirect('course')->with('success', 'Record Updated Successfully');
            } catch (\Exception $e) {
                DB::rollback();
                Log::error('Error updating course record: ' . $e->getMessage());

                return redirect('course')->with('error', 'Failed to update record. Please try again.');
            }
        } else {

            try {
                $e = $course->update(

                    [
                        'updated_by' =>
                        Auth::user()->name,
                        'updated_at' => now(),
                    ]
                );
                $course->delete();
                DB::commit();

                return redirect('course')->with('success', 'Record Deleted Successfully');
            } catch (\Exception $e) {
                DB::rollback();
                Log::error('Error deleting course record: ' . $e->getMessage());

                return redirect('course')->with('error', 'Failed to delete record. Please try again.');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('course.index')->with('success', 'Course deleted successfully.');
    }
}
