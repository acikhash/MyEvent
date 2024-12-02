<?php

namespace App\Livewire;

use App\Models\Department;
use App\Models\Gred;
use App\Models\Major;
use App\Models\Title;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Facades\Rule;

final class AssignLec extends PowerGridComponent
{
    public string $sortField = 'Staff.id';
    public bool $showFilters = true;

    protected function queryString()
    {
        return $this->powerGridQueryString();
    }
    public function setUp(): array
    {
        // $this->showCheckBox();

        return [

            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return DB::table('Staff')
            ->select(
                'Staff.id',
                'Staff.title',
                'Staff.name',
                'Staff.department',
                'Staff.major',
                'Staff.gred',
                'Departments.name as department_name',
                'Majors.name as major_name',
                'Titles.name as title_name',
                'Greds.name as gred_name',
                'Assignments.staff_id',
                DB::raw('SUM(Assignments.credit) AS total_credit'), // Use DB::raw for aggregate functions
                DB::raw('Count(Assignments.credit) AS total_course') // Use DB::raw for aggregate functions
            )
            ->leftJoin('Assignments', 'Staff.id', '=', 'Assignments.staff_id') // Fixed capitalization
            ->join('Departments', 'Departments.code', '=', 'Staff.department')
            ->join('Majors', 'Majors.name', '=', 'Staff.major')
            ->join('Titles', 'Titles.name', '=', 'Staff.title')
            ->join('Greds', 'Greds.name', '=', 'Staff.gred')
            ->whereNull('Staff.deleted_at')
            ->groupBy(
                'Staff.id',
                'Staff.title',
                'Staff.name',
                'Staff.department',
                'Staff.major',
                'Staff.gred',
                'Departments.name',
                'Majors.name',
                'Titles.name',
                'Greds.name'
            );
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('title')
            ->add('title_id')
            ->add('name')
            ->add('department_id')
            ->add('department')
            ->add('major_id')
            ->add('major')
            ->add('gred_id')
            ->add('gred')
            ->add('phone')
            ->add('email')
            ->add('staff_id')
            ->add('total_credit')
            ->add('total_course')
            ->add('deleted_at')
            ->add('created_at')
            ->add('updated_at');
    }

    public function columns(): array
    {
        return [
            Column::action('Action'),
            Column::make('Id', 'id'),
            Column::make('Total Credit', 'total_credit')
                ->sortable(),
            Column::make('Total Course', 'total_course')
                ->sortable(),
            Column::make('Title', 'title', 'title_name')->sortable(),
            Column::make('Name', 'name')
                ->sortable()
                ->searchable(),
            Column::make('Department', 'department', 'department_name')->sortable(),
            Column::make('Major', 'major', 'major_name')->sortable(),
            Column::make('Grade', 'gred', 'gred_name')->sortable(),

        ];
    }

    public function filters(): array
    {
        return [
            Filter::select('department_name', 'department')
                ->dataSource(Department::all())
                ->optionLabel('code')
                ->optionValue('code'),
            Filter::select('major_name', 'major')
                ->dataSource(Major::all())
                ->optionLabel('name')
                ->optionValue('name'),
            Filter::select('title_name', 'title')
                ->dataSource(Title::all())
                ->optionLabel('name')
                ->optionValue('name'),
            Filter::select('gred_name', 'gred')
                ->dataSource(Gred::all())
                ->optionLabel('name')
                ->optionValue('name'),
            Filter::inputText('name')->placeholder('name'),
        ];
    }

    #[\Livewire\Attributes\On('add')]
    public function add($rowId, $data): void
    {
        // Extract data
        $name = $data['name'];
        $major = $data['major'];
        $title = $data['title'];
        $department = $data['department'];
        $gred = $data['gred'];
        $notes = ''; // Default value

        // Encode data for JavaScript
        $rowId = json_encode($rowId);
        $name = json_encode($name);
        $major = json_encode($major);
        $title = json_encode($title);
        $department = json_encode($department);
        $gred = json_encode($gred);
        $notes = json_encode($notes);

        // Generate JavaScript
        $this->js("
    (function() {
        const table = document.getElementById('assign');
        if (!table) {
            console.error('Table with ID \"assign\" not found.');
            return;
        }

        const newRow = table.insertRow(); // Add new row at the end
        const rowIndex = newRow.rowIndex; // Get the current row index

        // Create and populate cells
        const cell1 = newRow.insertCell(0);
        const cell2 = newRow.insertCell(1);
        const cell3 = newRow.insertCell(2);
        const cell4 = newRow.insertCell(3);
        const cell5 = newRow.insertCell(4);
        const cell6 = newRow.insertCell(5);
        const deleteCell = newRow.insertCell(6);

        // Populate cells with data
        cell1.textContent = $rowId;
        cell2.textContent = $title + ' ' + $name;
        cell3.textContent = $major;
        cell4.textContent = $gred;
        cell5.textContent = $department;

        // Add hidden inputs to store row data
        cell1.appendChild(createHiddenInput(`rows[\${rowIndex}][staff_id]`, $rowId));
        cell2.appendChild(createHiddenInput(`rows[\${rowIndex}][staff_name]`, $title + ' ' + $name));

        // Add an editable notes input to cell6
        const notesInput = document.createElement('input');
        notesInput.type = 'text';
        notesInput.className = 'form-control';
        notesInput.id = `rows[\${rowIndex}][notes]`;
        notesInput.name = `rows[\${rowIndex}][notes]`;
        notesInput.value = $notes;
        cell6.appendChild(notesInput);
        cell6.appendChild(createHiddenInput(`rows[\${rowIndex}][action]`, 'new'));

        // Add a delete button to the last cell
        const deleteButton = document.createElement('button');
        deleteButton.className = 'fas fa-trash text-secondary btn-md';
        deleteButton.onclick = function() {
            table.deleteRow(newRow.rowIndex);
        };
        deleteCell.appendChild(deleteButton);

        // Utility function to create a hidden input
        function createHiddenInput(name, value) {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = name;
            input.value = value;
            return input;
        }
    })();
    ");
    }

    public function actions($row): array
    {
        return [
            Button::add('add')
                ->id('add')
                ->class('fas fa-edit text-secondary')
                ->tooltip('add lecturer')
                ->dispatch('add', ['rowId' => $row->id, 'data' => ['title' => $row->title, 'name' => $row->name, 'major' => $row->major, 'gred' => $row->gred, 'department' => $row->department]]),
        ];
    }


    public function actionRules($row): array
{
    return [
        // Rule for setting row color to orange
        Rule::rows()
            ->when(function ($row) {
                return ($row->major === 'PENGAJARAN' && $row->total_credit > 10) ||
                       ($row->major === 'PENYELIDIKAN DAN AMALAN PROFESIONAL' && $row->total_credit > 6) ||
                       ($row->major === 'KEPIMPINAN AKADEMIK' && $row->total_credit > 3);
            })
            ->setAttribute('style', 'background-color: orange;'),

        // Rule for setting row color to yellow
        Rule::rows()
            ->when(function ($row) {
                return ($row->major === 'PENGAJARAN' && $row->total_credit <= 10 && $row->total_credit > 6) ||
                       ($row->major === 'PENYELIDIKAN DAN AMALAN PROFESIONAL' && $row->total_credit <= 6 && $row->total_credit > 3) ||
                       ($row->major === 'KEPIMPINAN AKADEMIK' && $row->total_credit <= 3 && $row->total_credit > 1);
            })
            ->setAttribute('style', 'background-color: yellow;'),
    ];
}
}
