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
        Schema::create('plan_subscriptions', function (Blueprint $table) {
            $table->mediumIncrements('plan_subscription_id');
            $table->unsignedInteger('member_id');
            $table->unsignedSmallInteger('membership_plan_id');
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('status', ['active', 'expired ']);
            $table->foreign('member_id')->references('member_id')->on('members')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('membership_plan_id')->references('membership_plan_id')->on('membership_plans')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plan_subscriptions');
    }
};
