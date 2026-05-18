<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Attendance;
use App\Models\Employee;

use Carbon\Carbon;

use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    // =========================
    // INDEX
    // =========================
    public function index()
    {
        $attendances = Attendance::with(
                'employee.shift'
            )
            ->latest()
            ->get();

        return view(
            'admin.attendance.index',
            compact(
                'attendances'
            )
        );
    }

    // =========================
    // CHECK IN
    // =========================
    public function checkIn(Request $request)
    {
        // VALIDATION
        $request->validate([

            'pin' => 'required'

        ]);

        // FIND EMPLOYEE
        $employee = Employee::with('shift')
            ->get()
            ->first(function ($employee) use ($request) {

                return password_verify(

                    $request->pin,
                    $employee->pin

                );
            });

        // EMPLOYEE NOT FOUND
        if (!$employee) {

            return back()->with(

                'error',
                'Invalid PIN'

            );
        }

        // TODAY
        $today = Carbon::today();

        // CHECK EXISTING ATTENDANCE
        $existingAttendance = Attendance::where(

                'employee_id',
                $employee->id

            )
            ->whereDate(
                'attendance_date',
                $today
            )
            ->first();

        // ALREADY CHECK IN
        if ($existingAttendance) {

            return back()->with(

                'error',
                'Employee already checked in today'

            );
        }

        // CURRENT TIME
        $now = Carbon::now();

        // SHIFT START
        $shiftStart = Carbon::parse(

            $employee->shift->start_time

        );

        // TOLERANCE
        $tolerance = $employee
            ->shift
            ->late_tolerance;

        // LATE LIMIT
        $lateLimit = $shiftStart
            ->copy()
            ->addMinutes($tolerance);

        // DEFAULT
        $status = 'present';

        $lateMinutes = 0;

        // CHECK LATE
        if ($now->greaterThan($lateLimit)) {

            $status = 'late';

            $lateMinutes = $lateLimit
                ->diffInMinutes($now);
        }

        // SAVE ATTENDANCE
        Attendance::create([

            'employee_id' => $employee->id,

            'attendance_date' => $today,

            'clock_in' => $now->format('H:i:s'),

            'late_minutes' => $lateMinutes,

            'status' => $status

        ]);

        return back()->with(

            'success',
            'Attendance checked in successfully'

        );
    }
}