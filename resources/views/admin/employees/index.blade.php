@extends('admin.layouts.app')

@section('title', 'Employees')

@section('content')

<link rel="stylesheet"
      href="{{ asset('css/admin/employees.css') }}">

<div class="employee-page">

    <!-- HEADER -->
    <div class="employee-header">

        <div>

            <h1>
                Employee Management
            </h1>

            <p>
                Manage employees, roles, shifts, and attendance access
            </p>

        </div>

        <button
            class="add-btn"
            onclick="openAddEmployeeModal()">

            + Add Employee

        </button>

    </div>


    <!-- HR NAVIGATION -->
<div class="hr-nav">

    <a href="{{ route('admin.employees') }}"
       class="hr-tab active">

        Employees

    </a>

    <a href="{{ route('admin.attendance') }}"
       class="hr-tab">

        Attendance

    </a>

</div>

    <!-- STATS -->
    <div class="employee-stats">

        <!-- TOTAL -->
        <div class="stats-card">

            <span>
                Total Employee
            </span>

            <h2>

                {{ $employees->count() }}

            </h2>

        </div>

        <!-- ACTIVE -->
        <div class="stats-card">

            <span>
                Active Employee
            </span>

            <h2>

                {{ $employees->where('status', 'active')->count() }}

            </h2>

        </div>

        <!-- DYNAMIC ROLE STATS -->
        @foreach(
            $employees->groupBy('role')
            as $role => $group
        )

            <div class="stats-card">

                <span>

                    {{ strtoupper($role) }}

                </span>

                <h2>

                    {{ $group->count() }}

                </h2>

            </div>

        @endforeach

    </div>

    <!-- EMPLOYEE TABLE -->
    <div class="employee-card">

        <div class="card-header">

            <h2>
                Employee List
            </h2>

        </div>

        <div class="table-wrapper">

            <table>

                <thead>

                    <tr>

                        <th>
                            Employee ID
                        </th>

                        <th>
                            Name
                        </th>

                        <th>
                            Role
                        </th>

                        <th>
                            Shift
                        </th>

                        <th>
                            Salary
                        </th>

                        <th>
                            Status
                        </th>

                        <th>
                            Action
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($employees as $employee)

                        <tr>

                            <td class="employee-code">

                                {{ $employee->employee_code }}

                            </td>

                            <td class="employee-name">

                                {{ $employee->name }}

                            </td>

                            <td>

                                {{ ucfirst($employee->role) }}

                            </td>

                            <td>

                                {{ $employee->shift->name ?? '-' }}

                            </td>

                            <td>

                                Rp {{ number_format($employee->salary,0,',','.') }}

                            </td>

                            <td>

                                <span class="status-badge {{ $employee->status }}">

                                    {{ strtoupper($employee->status) }}

                                </span>

                            </td>

                            <td>

                                <button
                                    class="edit-btn"

                                    onclick='openEditEmployeeModal(

                                        {{ $employee->id }},

                                        "{{ $employee->employee_code }}",

                                        "{{ $employee->name }}",

                                        "{{ $employee->email }}",

                                        "{{ $employee->phone }}",

                                        "{{ $employee->role }}",

                                        "{{ $employee->salary }}",

                                        "{{ $employee->shift_id }}",

                                        "{{ $employee->status }}"

                                    )'>

                                    ✏ Edit

                                </button>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="7"
                                class="empty-data">

                                No employee data available

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

<!-- =========================
     ADD EMPLOYEE MODAL
========================= -->
<div class="modal-overlay"
     id="addEmployeeModal">

    <div class="modal-box">

        <div class="modal-header">

            <h2>
                Add Employee
            </h2>

            <button
                class="close-modal"
                onclick="closeAddEmployeeModal()">

                ✕

            </button>

        </div>

        <form
            action="{{ route('admin.employees.store') }}"
            method="POST">

            @csrf

            <div class="form-group">

                <label>
                    Employee Code
                </label>

                <input
                    type="text"
                    name="employee_code"
                    required>

            </div>

            <div class="form-group">

                <label>
                    Full Name
                </label>

                <input
                    type="text"
                    name="name"
                    required>

            </div>

            <div class="form-group">

                <label>
                    Email
                </label>

                <input
                    type="email"
                    name="email">

            </div>

            <div class="form-group">

                <label>
                    Phone
                </label>

                <input
                    type="text"
                    name="phone">

            </div>

            <div class="form-group">

                <label>
                    Role
                </label>

                <select
                    name="role"
                    required>

                    <option value="">
                        Select Role
                    </option>

                    <option value="admin">
                        Admin
                    </option>

                    <option value="cashier">
                        Cashier
                    </option>

                    <option value="barista">
                        Barista
                    </option>

                    <option value="kitchen">
                        Kitchen
                    </option>

                </select>

            </div>

            <div class="form-group">

                <label>
                    Shift
                </label>

                <select
                    name="shift_id"
                    required>

                    <option value="">
                        Select Shift
                    </option>

                    @foreach($shifts as $shift)

                        <option value="{{ $shift->id }}">

                            {{ $shift->name }}

                        </option>

                    @endforeach

                </select>

            </div>

            <div class="form-group">

                <label>
                    Salary
                </label>

                <input
                    type="number"
                    name="salary">

            </div>

            <div class="form-group">

                <label>
                    PIN Attendance
                </label>

                <input
                    type="password"
                    name="pin"
                    required>

            </div>

            <div class="button-group">

                <button
                    type="button"
                    class="cancel-btn"
                    onclick="closeAddEmployeeModal()">

                    Cancel

                </button>

                <button
                    type="submit"
                    class="save-btn">

                    Save Employee

                </button>

            </div>

        </form>

    </div>

</div>

<!-- =========================
     EDIT EMPLOYEE MODAL
========================= -->
<div class="modal-overlay"
     id="editEmployeeModal">

    <div class="modal-box">

        <div class="modal-header">

            <h2>
                Edit Employee
            </h2>

            <button
                class="close-modal"
                onclick="closeEditEmployeeModal()">

                ✕

            </button>

        </div>

        <form
            id="editEmployeeForm"
            method="POST">

            @csrf
            @method('PUT')

            <div class="form-group">

                <label>
                    Employee Code
                </label>

                <input
                    type="text"
                    id="edit_employee_code"
                    name="employee_code"
                    required>

            </div>

            <div class="form-group">

                <label>
                    Full Name
                </label>

                <input
                    type="text"
                    id="edit_name"
                    name="name"
                    required>

            </div>

            <div class="form-group">

                <label>
                    Email
                </label>

                <input
                    type="email"
                    id="edit_email"
                    name="email">

            </div>

            <div class="form-group">

                <label>
                    Phone
                </label>

                <input
                    type="text"
                    id="edit_phone"
                    name="phone">

            </div>

            <div class="form-group">

                <label>
                    Role
                </label>

                <select
                    id="edit_role"
                    name="role"
                    required>

                    <option value="admin">
                        Admin
                    </option>

                    <option value="cashier">
                        Cashier
                    </option>

                    <option value="barista">
                        Barista
                    </option>

                    <option value="kitchen">
                        Kitchen
                    </option>

                </select>

            </div>

            <div class="form-group">

                <label>
                    Shift
                </label>

                <select
                    id="edit_shift"
                    name="shift_id"
                    required>

                    @foreach($shifts as $shift)

                        <option value="{{ $shift->id }}">

                            {{ $shift->name }}

                        </option>

                    @endforeach

                </select>

            </div>

            <div class="form-group">

                <label>
                    Salary
                </label>

                <input
                    type="number"
                    id="edit_salary"
                    name="salary">

            </div>

            <div class="form-group">

                <label>
                    Status
                </label>

                <select
                    id="edit_status"
                    name="status">

                    <option value="active">
                        Active
                    </option>

                    <option value="inactive">
                        Inactive
                    </option>

                </select>

            </div>

            <div class="button-group">

                <button
                    type="button"
                    class="cancel-btn"
                    onclick="closeEditEmployeeModal()">

                    Cancel

                </button>

                <button
                    type="submit"
                    class="save-btn">

                    Update Employee

                </button>

            </div>

        </form>

    </div>

</div>

<script src="{{ asset('js/admin/employees.js') }}"></script>

@endsection