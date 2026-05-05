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
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();

            $table->string('name'); // nama bahan (susu, kopi)
            $table->decimal('stock', 10, 2); // jumlah stok
            $table->string('unit'); // gram, ml, pcs
            $table->decimal('min_stock', 10, 2)->default(0); // batas minimum

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};