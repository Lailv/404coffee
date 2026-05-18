<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [

        'employee_code',
        'name',
        'email',
        'phone',
        'role',
        'salary',
        'pin',
        'shift_id',
        'status'

    ];

    // =========================
    // SHIFT RELATION
    // =========================
    public function shift()
    {
        return $this->belongsTo(
            Shift::class
        );
    }

    // =========================
    // ATTENDANCE RELATION
    // =========================
    public function attendances()
    {
        return $this->hasMany(
            Attendance::class
        );
    }
}