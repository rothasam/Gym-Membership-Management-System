<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = 'members';
    protected $primaryKey = 'member_id';
    public $incrementing = true; 

    protected $fillable = [
        'first_name', 
        'last_name', 
        'gender', 
        'dob', 
        'phone', 
        'email', 
        'address',
        'joined_date',
        'is_deleted'
    ];

    public function planSubscriptions() {
        return $this->hasMany(PlanSubscription::class, 'member_id', 'member_id');
    }

    public function dailyAttendances() {
        return $this->hasMany(DailyAttendance::class, 'member_id', 'member_id');
    }

    public function classRegisterations() {
        return $this->hasMany(ClassRegisteration::class, 'member_id', 'member_id');
    }
}
