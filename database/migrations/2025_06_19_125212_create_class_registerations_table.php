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
        Schema::create('class_registerations', function (Blueprint $table) {
            $table->mediumIncrements('class_registeration_id')->primary();
            $table->unsignedInteger('member_id');
            $table->unsignedInteger('gym_class_id');
            $table->date('registered_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_registerations');
    }
};
