@extends('admin.layouts.app')

@section('title', 'Attendance')

@section('content')

<link rel="stylesheet"
      href="{{ asset('css/admin/attendance.css') }}">

<div class="attendance-page">

    <!-- HEADER -->
    <div class="attendance-header">

        <div>

            <h1>
                Attendance System
            </h1>

            <p>
                Employee attendance monitoring and shift tracking
            </p>

        </div>

        <div class="attendance-badge">

            HR Attendance

        </div>

    </div>


    <!-- HR NAVIGATION -->
<div class="hr-nav">

    <a href="{{ route('admin.employees') }}"
       class="hr-tab">

        Employees

    </a>

    <a href="{{ route('admin.attendance') }}"
       class="hr-tab active">

        Attendance

    </a>

</div>

    <!-- ALERT -->
    @if(session('success'))

        <div class="alert success-alert">

            {{ session('success') }}

        </div>

    @endif

    @if(session('error'))

        <div class="alert error-alert">

            {{ session('error') }}

        </div>

    @endif

    <!-- STATS -->
    <div class="attendance-stats">

        <div class="stats-card">

            <span>
                Total Attendance Today
            </span>

            <h2>

                {{
                    $attendances
                    ->where(
                        'attendance_date',
                        now()->toDateString()
                    )
                    ->count()
                }}

            </h2>

        </div>

        <div class="stats-card">

            <span>
                Present
            </span>

            <h2>

                {{
                    $attendances
                    ->where(
                        'status',
                        'present'
                    )
                    ->count()
                }}

            </h2>

        </div>

        <div class="stats-card">

            <span>
                Late
            </span>

            <h2>

                {{
                    $attendances
                    ->where(
                        'status',
                        'late'
                    )
                    ->count()
                }}

            </h2>

        </div>

    </div>

    <!-- CHECK IN -->
    <div class="attendance-card">

        <div class="card-header">

            <h2>
                Employee Check In
            </h2>

        </div>

        <form
            action="{{ route('admin.attendance.checkin') }}"
            method="POST">

            @csrf

            <div class="attendance-form">

                <input
                    type="password"
                    name="pin"
                    placeholder="Enter Attendance PIN"
                    required>

                <button type="submit">

                    Check In

                </button>

            </div>

        </form>

    </div>

    <!-- ATTENDANCE TABLE -->
    <div class="attendance-card">

        <div class="card-header">

            <h2>
                Attendance History
            </h2>

        </div>

        <div class="table-wrapper">

            <table>

                <thead>

                    <tr>

                        <th>
                            Employee
                        </th>

                        <th>
                            Role
                        </th>

                        <th>
                            Shift
                        </th>

                        <th>
                            Date
                        </th>

                        <th>
                            Clock In
                        </th>

                        <th>
                            Late
                        </th>

                        <th>
                            Status
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($attendances as $attendance)

                        <tr>

                            <td class="employee-name">

                                {{ $attendance->employee->name }}

                            </td>

                            <td>

                                {{ ucfirst($attendance->employee->role) }}

                            </td>

                            <td>

                                {{ $attendance->employee->shift->name ?? '-' }}

                            </td>

                            <td>

                                {{
                                    \Carbon\Carbon::parse(
                                        $attendance->attendance_date
                                    )->format('d M Y')
                                }}

                            </td>

                            <td>

                                {{ $attendance->clock_in }}

                            </td>

                            <td>

                                {{ $attendance->late_minutes }} min

                            </td>

                            <td>

                                <span class="status-badge {{ $attendance->status }}">

                                    {{ strtoupper($attendance->status) }}

                                </span>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="7"
                                class="empty-data">

                                No attendance data available

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection