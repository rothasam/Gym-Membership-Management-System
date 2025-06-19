<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GymClass extends Model
{
    protected $table = 'gym_classes';
    protected $primaryKey = 'gym_class_id';
    
    protected $fillable = [
        'class_name', 
        'description',
        'total_member',
        'start_time',
        'end_time',
    ];

    public function classRegisterations() {
        return $this->hasMany(ClassRegisteration::class, 'gym_class_id', 'gym_class_id');
    }
}
