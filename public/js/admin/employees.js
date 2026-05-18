// ============================================================
// OPEN ADD MODAL
// ============================================================

function openAddEmployeeModal()
{
    document
        .getElementById('addEmployeeModal')
        .classList
        .add('active');
}


// ============================================================
// CLOSE ADD MODAL
// ============================================================

function closeAddEmployeeModal()
{
    document
        .getElementById('addEmployeeModal')
        .classList
        .remove('active');
}


// ============================================================
// OPEN EDIT MODAL
// ============================================================

function openEditEmployeeModal(
    id,
    code,
    name,
    email,
    phone,
    role,
    salary,
    shiftId,
    status
)
{
    // FORM ACTION
    document
        .getElementById('editEmployeeForm')
        .action =
            `/admin/employees/${id}`;

    // FILL INPUTS
    document
        .getElementById('edit_employee_code')
        .value = code;

    document
        .getElementById('edit_name')
        .value = name;

    document
        .getElementById('edit_email')
        .value = email;

    document
        .getElementById('edit_phone')
        .value = phone;

    document
        .getElementById('edit_role')
        .value = role;

    document
        .getElementById('edit_salary')
        .value = salary;

    document
        .getElementById('edit_shift')
        .value = shiftId;

    document
        .getElementById('edit_status')
        .value = status;

    // OPEN MODAL
    document
        .getElementById('editEmployeeModal')
        .classList
        .add('active');
}


// ============================================================
// CLOSE EDIT MODAL
// ============================================================

function closeEditEmployeeModal()
{
    document
        .getElementById('editEmployeeModal')
        .classList
        .remove('active');
}


// ============================================================
// CLOSE MODAL OUTSIDE CLICK
// ============================================================

window.addEventListener(

    'click',

    function(e)
    {
        const addModal = document.getElementById(
            'addEmployeeModal'
        );

        const editModal = document.getElementById(
            'editEmployeeModal'
        );

        // ADD MODAL
        if (e.target === addModal)
        {
            closeAddEmployeeModal();
        }

        // EDIT MODAL
        if (e.target === editModal)
        {
            closeEditEmployeeModal();
        }
    }

);