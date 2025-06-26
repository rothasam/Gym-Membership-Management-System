<?php

namespace Database\Seeders;

use App\Models\Member;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            MembershipPlanSeeder::class,
            GymClassSeeder::class,
            MemberSeeder::class,
            PlanSubscriptionSeeder::class,
            PaymentSeeder::class,
            DailyAttendanceSeeder::class,
        ]);
    }
}
