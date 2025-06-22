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
            $table->mediumIncrements('class_registeration_id');
            $table->unsignedInteger('member_id');
            $table->unsignedInteger('gym_class_id');
            $table->foreign('member_id')->references('member_id')->on('members')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('gym_class_id')->references('gym_class_id')->on('gym_classes')->onDelete('cascade')->onUpdate('cascade');
            $table->date('registered_date');
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
