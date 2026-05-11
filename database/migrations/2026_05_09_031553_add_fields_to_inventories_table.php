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
        Schema::table(
            'inventories',
            function (Blueprint $table) {

                // CODE BAHAN
                $table->string('ingredient_code')
                    ->nullable()
                    ->after('id');

                // CATEGORY
                $table->string('category')
                    ->nullable()
                    ->after('name');
            }
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table(
            'inventories',
            function (Blueprint $table) {

                $table->dropColumn(
                    'ingredient_code'
                );

                $table->dropColumn(
                    'category'
                );
            }
        );
    }
};