<?php

namespace App\Exports;

use App\Models\Staff;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class DepartmentWorkloadSheet implements FromQuery, WithHeadings, WithTitle
{
    protected $department;

    public function __construct($department)
    {
        $this->department = $department;
    }

    public function query()
    {
        return Staff::select(
            'Staff.id',
            'Staff.title',
            'Staff.name',
            'Staff.department',
            'Staff.major',
            'Staff.gred',
            'Assignments.course_code',
            'Assignments.year',
            'Assignments.semester',
            'Assignments.credit',
            'Assignments.notes',
            DB::raw('SUM(Assignments.credit) as totalCredit') // Calculate total credit
        )
            ->leftJoin('Assignments', 'Staff.id', '=', 'Assignments.staff_id')
            ->whereNull('Staff.deleted_at')
            ->where('Staff.department', $this->department)
            ->groupBy(
                'Staff.id',
                'Staff.title',
                'Staff.name',
                'Staff.department',
                'Staff.major',
                'Staff.gred',
                'Assignments.course_code',
                'Assignments.year',
                'Assignments.semester',
                'Assignments.notes'
            );
    }

    public function headings(): array
    {
        return [
            'ID',
            'Title',
            'Name',
            'Department',
            'Major',
            'Grade',
            'Course Code',
            'Year',
            'Semester',
            'Credit',
            'Notes',
            'Total Credit'
        ];
    }
    // Method to set the title of the worksheet
    public function title(): string
    {
        return $this->department; // Use the department name as the title
    }
}
