<?php

namespace Database\Seeders;

use App\Models\GymClass;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GymClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $gymClasses = [
            [
                'class_name' => 'Yoga Basics',
                'description' => 'A beginner-friendly yoga class focused on flexibility and breathing.',
                'total_member' => 15,
                'start_time' => '08:00:00',
                'end_time' => '10:00:00',
                'is_deleted' => 0
            ],
            [
                'class_name' => 'HIIT Blast',
                'description' => 'High Intensity Interval Training to burn calories fast.',
                'total_member' => 20,
                'start_time' => '17:00:00',
                'end_time' => '19:00:00',
                'is_deleted' => 0
            ],
            [
                'class_name' => 'Pilates Core',
                'description' => 'Strengthen your core and improve posture with Pilates exercises.',
                'total_member' => 12,
                'start_time' => '06:30:00',
                'end_time' => '07:30:00',
                'is_deleted' => 0
            ],
            [
                'class_name' => 'Zumba Dance',
                'description' => 'Fun and energetic dance workout for all fitness levels.',
                'total_member' => 25,
                'start_time' => '13:30:00',
                'end_time' => '15:00:00',
                'is_deleted' => 0
            ],
            [
                'class_name' => 'Strength Training',
                'description' => 'Build muscle and improve strength with weights and resistance training.',
                'total_member' => 18,
                'start_time' => '06:40:00',
                'end_time' => '08:00:00',
                'is_deleted' => 0
            ],
        ];

        foreach($gymClasses as $class){
            GymClass::create($class);
        }
    }
}
