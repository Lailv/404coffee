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
        Schema::create('employees', function (Blueprint $table) {

            $table->id();

            // EMPLOYEE CODE
            $table->string('employee_code')
                  ->unique();

            // BASIC INFO
            $table->string('name');

            $table->string('email')
                  ->nullable();

            $table->string('phone')
                  ->nullable();

            // JOB ROLE
            $table->string('role');

            // SALARY
            $table->decimal(
                'salary',
                12,
                2
            )->default(0);

            // ATTENDANCE PIN
            $table->string('pin');

            // SHIFT RELATION
            $table->foreignId('shift_id')
                  ->nullable()
                  ->constrained()
                  ->nullOnDelete();

            // EMPLOYEE STATUS
            $table->enum('status', [

                'active',
                'inactive'

            ])->default('active');

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};