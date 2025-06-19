<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassRegisteration extends Model
{
    protected $table = 'class_registerations'; 
    protected $primaryKey = 'class_regissteration_id';
    public $incrementing = true;

    protected $fillable = [
        'member_id', 
        'gym_class_id', 
        'registered_date',
    ];

    public function member() {
        return $this->belongsTo(Member::class, 'member_id', 'member_id');
    }

    public function gymClass() {
        return $this->belongsTo(GymClass::class, 'gym_class_id', 'gym_class_id');
    }
}
