<?php

namespace Database\Seeders;

use App\Models\MembershipPlan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MembershipPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $planData = [
            [
                'name' => 'Basic',
                'price' => 19.99,
                'duration_month' => 1,
                'description' => 'Perfect for beginners. Access to all basic classes.',
                'total_class' => 8,
            ],
            [
                'name' => 'Standard',
                'price' => 49.99,
                'duration_month' => 3,
                'description' => 'Access to all classes including some advanced workshops.',
                'total_class' => 24,
            ],
            [
                'name' => 'Premium',
                'price' => 89.99,
                'duration_month' => 6,
                'description' => 'Unlimited class access with priority booking and free events.',
                'total_class' => 50, 
            ],
            [
                'name' => 'Yearly VIP',
                'price' => 149.99,
                'duration_month' => 12,
                'description' => 'Best value for frequent members. Unlimited everything.',
                'total_class' => 100,
            ],
        ];

        foreach($planData as $plan){
            MembershipPlan::create($plan);
        }


    }
}
