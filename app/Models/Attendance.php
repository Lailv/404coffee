<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [

        'employee_id',
        'attendance_date',
        'clock_in',
        'clock_out',
        'late_minutes',
        'status'

    ];

    // =========================
    // EMPLOYEE RELATION
    // =========================
    public function employee()
    {
        return $this->belongsTo(
            Employee::class
        );
    }
}