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
        Schema::create('membership_plans', function (Blueprint $table) {
            $table->smallIncrements('membership_plan_id');
            $table->string('name');
            $table->decimal('price', 10, 2);
            $table->unsignedSmallInteger('duration_month');
            $table->text('description')->nullable();
            $table->unsignedTinyInteger('total_class')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('membership_plans');
    }
};
