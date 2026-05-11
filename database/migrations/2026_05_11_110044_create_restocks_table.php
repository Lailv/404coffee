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
        Schema::create('restocks', function (Blueprint $table) {

            $table->id();

            $table->foreignId('inventory_id')
                  ->constrained('inventories')
                  ->onDelete('cascade');

            $table->foreignId('supplier_id')
                  ->constrained('suppliers')
                  ->onDelete('cascade');

            $table->integer('qty');

            $table->decimal('price', 12, 2);

            $table->decimal('total', 12, 2);

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restocks');
    }
};