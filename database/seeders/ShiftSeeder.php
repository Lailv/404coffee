<?php

namespace Database\Seeders;

use App\Models\Shift;
use Illuminate\Database\Seeder;

class ShiftSeeder extends Seeder
{
    public function run(): void
    {
        Shift::create([

            'name' => 'Morning Shift',

            'start_time' => '07:00:00',

            'end_time' => '15:00:00',

            'late_tolerance' => 10

        ]);

        Shift::create([

            'name' => 'Afternoon Shift',

            'start_time' => '15:00:00',

            'end_time' => '23:00:00',

            'late_tolerance' => 10

        ]);
    }
}