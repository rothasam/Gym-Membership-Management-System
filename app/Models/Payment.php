<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';
    protected $primaryKey = 'payment_id';
    public $incrementing = true; 

    protected $fillable = [
        'plan_subscription_id', 
        'amount',
        'payment_method',
        'paid_date', 
        'user_id',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function planSubscription() {
        return $this->belongsTo(PlanSubscription::class, 'plan_subscription_id', 'plan_subscription_id');
    }
}
