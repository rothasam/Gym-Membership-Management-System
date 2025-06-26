<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailyAttendance extends Model
{
    protected $table = 'daily_attendances';
    protected $primaryKey = 'daily_attendance_id';
    public $incrementing = true;

    protected $fillable = [
        'member_id', 
        'check_in', 
        'is_deleted'
    ];

    public function member () {
        return $this->belongsTo(Member::class, 'member_id', 'member_id');
    }
}
