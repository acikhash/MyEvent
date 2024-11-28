<?php

namespace App\Exports;

use App\Models\Assignment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class WorkloadExport implements WithMultipleSheets
{
    protected $departments;

    public function __construct($departments)
    {
        $this->departments = $departments;
    }

    public function sheets(): array
    {
        $sheets = [];
        foreach ($this->departments as $department) {
            $sheets[] = new DepartmentWorkloadSheet($department);
        }
        return $sheets;
    }
}
