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
        Schema::create('daily_attendances', function (Blueprint $table) {
            $table->mediumIncrements('daily_attendance_id');
            $table->unsignedInteger('member_id');
            $table->date('check_in')->nullable();
            // $table->date('check_out')->nullable();
            $table->boolean('is_deleted')->default(false);
             $table->foreign('member_id')->references('member_id')->on('members')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_attendances');
    }
};
