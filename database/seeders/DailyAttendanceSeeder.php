<?php

namespace Database\Seeders;

use App\Models\DailyAttendance;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DailyAttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $attendances = [
            [
                'member_id' => 2,
                'check_in' => now(),
            ]
        ];  

        foreach($attendances as $att){
            DailyAttendance::create($att);
        }

    }
}
