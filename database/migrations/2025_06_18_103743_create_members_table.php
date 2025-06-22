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
        Schema::create('members', function (Blueprint $table) {
            $table->integerIncrements('member_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->enum('gender', ['male', 'female','none'])->default('none');
            $table->date('dob');
            $table->string('phone', 20);
            $table->string('email', 100)->unique();
            $table->text('address')->nullable();
            $table->date('joined_date');
            $table->timestamps();    
        }); 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
