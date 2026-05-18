<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Employee;
use App\Models\Shift;

use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    // =========================
    // INDEX
    // =========================
    public function index()
    {
        $employees = Employee::with('shift')
            ->latest()
            ->get();

        $shifts = Shift::all();

        return view(
            'admin.employees.index',
            compact(
                'employees',
                'shifts'
            )
        );
    }

    // =========================
    // STORE
    // =========================
    public function store(Request $request)
    {
        $request->validate([

            'employee_code' => 'required|unique:employees',

            'name' => 'required',

            'role' => 'required',

            'pin' => 'required',

            'shift_id' => 'required'

        ]);

        Employee::create([

            'employee_code' => $request->employee_code,

            'name' => $request->name,

            'email' => $request->email,

            'phone' => $request->phone,

            'role' => $request->role,

            'salary' => $request->salary,

            'pin' => bcrypt($request->pin),

            'shift_id' => $request->shift_id,

            'status' => 'active'

        ]);

        return back()->with(

            'success',
            'Employee added successfully'

        );
    }

    // =========================
    // UPDATE
    // =========================
    public function update(
        Request $request,
        Employee $employee
    )
    {
        $employee->update([

            'employee_code' => $request->employee_code,

            'name' => $request->name,

            'email' => $request->email,

            'phone' => $request->phone,

            'role' => $request->role,

            'salary' => $request->salary,

            'shift_id' => $request->shift_id,

            'status' => $request->status

        ]);

        return back()->with(

            'success',
            'Employee updated successfully'

        );
    }
}