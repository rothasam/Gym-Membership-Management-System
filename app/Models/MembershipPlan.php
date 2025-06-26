<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MembershipPlan extends Model
{
    protected $table = 'membership_plans';
    protected   $primaryKey = 'membership_plan_id';
    public $incrementing = true; 

    protected $fillable = [
        'name', 
        'price', 
        'duration_month', 
        'description',
        'total_class',
        'is_deleted'
    ];

    public function planSubscriptions() {
        return $this->hasMany(PlanSubscription::class, 'membership_plan_id', 'membership_plan_id');
    }
}
