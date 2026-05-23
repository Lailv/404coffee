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
        Schema::table('orders', function (Blueprint $table) {

            $table->foreignId('user_id')
                ->nullable()
                ->after('id')
                ->constrained()
                ->nullOnDelete();

            $table->string('customer_phone')
                ->nullable()
                ->after('customer_name');

            $table->text('customer_address')
                ->nullable()
                ->after('customer_phone');

            $table->text('notes')
                ->nullable()
                ->after('customer_address');

            $table->string('order_type')
                ->default('pickup')
                ->after('notes');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {

            $table->dropForeign(['user_id']);

            $table->dropColumn([

                'user_id',
                'customer_phone',
                'customer_address',
                'notes',
                'order_type'

            ]);

        });
    }
};