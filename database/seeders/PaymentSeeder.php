<?php

namespace Database\Seeders;

use App\Models\Payment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $payments = [
            [
                'payment_id' => 1,
                'plan_subscription_id' => 1,
                'amount' => 100,
                'payment_method' => 'cash',
                'paid_date' => now(),
                'user_id' => 1
            ],
            [
                'payment_id' => 2,
                'plan_subscription_id' => 2,
                'amount' => 49.99,
                'payment_method' => 'bank_transfer',
                'paid_date' => now(),
                'user_id' => 1
            ],
            [
                'payment_id' => 3,
                'plan_subscription_id' => 3,
                'amount' => 89.99,
                'payment_method' => 'bank_transfer',
                'paid_date' => now(),
                'user_id' => 1
            ],
            [
                'payment_id' => 4,
                'plan_subscription_id' => 4,
                'amount' => 149.99,
                'payment_method' => 'cash',
                'paid_date' => now(),
                'user_id' => 1
            ],
            [
                'payment_id' => 5,
                'plan_subscription_id' => 5,
                'amount' => 19.99,
                'payment_method' => 'cash',
                'paid_date' => now(),
                'user_id' => 1
            ],
            [
                'payment_id' => 6,
                'plan_subscription_id' => 6,
                'amount' => 49.99,
                'payment_method' => 'cash',
                'paid_date' => now(),
                'user_id' => 1
            ],
        ];

        foreach($payments as $pay){
            Payment::create($pay);
        }
    }
}
