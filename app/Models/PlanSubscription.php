<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanSubscription extends Model
{
    protected $table = 'plan_subscriptions';
    protected $primaryKey = 'plan_subscription_id';
    public $incrementing = true;

    protected $fillable = [
        'member_id', 
        'membership_plan_id',
        'start_date',
        'end date',
        'status',
    ];

    public function member() {
        return $this->belongsTo(Member::class, 'member_id', 'member_id');
    }

    public function membershipPlan() {
        return $this->belongsTo(MembershipPlan::class, 'membership_plan_id', 'membership_plan_id');
    }

    public function payments() {
        return $this->hasMany(Payment::class, 'payment_id', 'payment_id');
    }
}
