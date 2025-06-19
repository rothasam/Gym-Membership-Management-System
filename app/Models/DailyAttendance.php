<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailyAttendance extends Model
{
    protected $table = 'daily_attedances';
    protected $primaryKey = 'daily_attedance_id';
    public $incrementing = true;

    protected $fillable = [
        'member_id', 
        'check_in', 
        'check_out',
    ];

    public function member () {
        return $this->belongsTo(Member::class, 'member_id', 'member_id');
    }
}
