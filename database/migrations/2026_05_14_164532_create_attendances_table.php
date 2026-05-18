<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('attendances', function (Blueprint $table) {

            $table->id();

            // EMPLOYEE RELATION
            $table->foreignId('employee_id')
                  ->constrained()
                  ->cascadeOnDelete();

            // ATTENDANCE DATE
            $table->date('attendance_date');

            // CLOCK IN / OUT
            $table->time('clock_in')
                  ->nullable();

            $table->time('clock_out')
                  ->nullable();

            // LATE MINUTES
            $table->integer('late_minutes')
                  ->default(0);

            // ATTENDANCE STATUS
            $table->enum('status', [

                'present',
                'late',
                'absent',
                'leave'

            ])->default('present');

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};