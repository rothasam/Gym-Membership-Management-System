<?php

namespace Database\Seeders;

use App\Models\PlanSubscription;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanSubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subscription = [
            [
                'plan_subscription_id' => 1,
                'member_id' => 1,
                'membership_plan_id' => 1,
                'start_date' => '2025-03-01',
                'end_date' => '2025-04-01',
                'status' => 'active',
            ],
            [
                'plan_subscription_id' => 2,
                'member_id' => 2,
                'membership_plan_id' => 2,
                'start_date' => '2025-02-15',
                'end_date' => '2025-05-15',
                'status' => 'expired',
            ],
            [
                'plan_subscription_id' => 3,
                'member_id' => 3,
                'membership_plan_id' => 3,
                'start_date' => '2025-01-01',
                'end_date' => '2025-07-01',
                'status' => 'active',
            ],
            [
                'plan_subscription_id' => 4,
                'member_id' => 4,
                'membership_plan_id' => 4,
                'start_date' => '2025-06-01',
                'end_date' => '2026-06-01',
                'status' => 'expired',
            ],
        ];

        foreach($subscription as $s){
            PlanSubscription::create($s);
        }
    }
}
