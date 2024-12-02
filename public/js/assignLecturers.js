// public/js/assignLecturers.js
document.addEventListener('DOMContentLoaded', function () {
    // const editButton = document.querySelector('button[name="edit"]');
    // const assignTable = document.getElementById('assign');

    // if (editButton && assignTable) {
    //     editButton.addEventListener('click', function () {
    //         const rows = Array.from(assignTable.rows).map((row,rowIndex) => {
    //             const staffId = document.getElementById(`rows[${rowIndex}][staff_id]`).value;
    //             const staffName = document.getElementById(`rows[${rowIndex}][staff_name]`).value;
    //             const courseId = document.getElementById(`rows[${rowIndex}][course_id]`).value;
    //             const semesterId = document.getElementById(`rows[${rowIndex}][semester_id]`).value;
    //             const courseCode = document.getElementById(`rows[${rowIndex}][course_code]`).value;
    //             const credit = document.getElementById(`rows[${rowIndex}][credit]`).value;
    //             const year =document.getElementById(`rows[${rowIndex}][year]`).value;
    //             const semester = document.getElementById(`rows[${rowIndex}][semester]`).value;
    //             const notes = document.getElementById(`rows[${rowIndex}][notes]`).value;
    //             const action = document.getElementById(`rows[${rowIndex}][action]`).value;

    //             return { staff_id: staffId, staff_name: staffName, course_id: courseId, semester_id: semesterId, course_code: courseCode, credit, year, semester, notes, action };
    //         });

    //         fetch('/store', {
    //             method: 'POST',
    //             headers: { 'Content-Type': 'application/json' },
    //             body: JSON.stringify({ rows }),
    //         })
    //             .then((response) => response.json())
    //             .then((data) => console.log(data))
    //             .catch((error) => console.error('Error:', error));
    //     });
    // }

    window.removeRow = function (button) {
        const row = button.closest('tr');
        // Get the index of the row within its parent (the table body)
        const rowIndex = Array.from(row.parentNode.children).indexOf(row);

        // Construct the ID for the action input field based on the row index
        const actionInputId = `rows[${rowIndex}][action]`;
        const actionInput = document.getElementById(actionInputId);

        // Append '0' to the input field's value
        if (actionInput) {
            actionInput.value = 'delete';
        }

        // hidden the row from the table
        row.hidden = true;

    };

    window.updateRow = function (button) {
        const row = button.closest('tr');
        // Get the index of the row within its parent (the table body)
        const rowIndex = Array.from(row.parentNode.children).indexOf(row);
        // Construct the ID for the action input field based on the row index
        const actionInputId = `rows[${rowIndex}][action]`;
        const actionInput = document.getElementById(actionInputId);

        const notesInputId = `rows[${rowIndex}][notes]`;
        const notesInput = document.getElementById(notesInputId);

        if (actionInput) {
            actionInput.value = 'update';

            // readonly the row from the table
            notesInput.readOnly = !notesInput.readOnly
        }

    };

    window.toggleSearchLecturer = function () {
        const searchlec = document.getElementById('searchlec');
        if (searchlec) {
            searchlec.hidden = !searchlec.hidden;
        }
    };
});
