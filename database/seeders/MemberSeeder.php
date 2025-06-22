<?php

namespace Database\Seeders;

use App\Models\Member;
use Database\Factories\PlanSubscriptionFactory;
use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $members = [
            [
                'first_name' => 'Sok',
                'last_name' => 'Dara',
                'gender' => 'male',
                'dob' => '2000-05-10',
                'phone' => '012345678',
                'email' => 'sok.dara@gmail.com',
                'address' => 'Phnom Penh, Cambodia',
                'joined_date' => '2024-01-15',
                'is_deleted' => 0,
            ],
            [
                'first_name' => 'An',
                'last_name' => 'Menghour',
                'gender' => 'male',
                'dob' => '2005-05-05',
                'phone' => '097865422',
                'email' => 'meng.hour@gmail.com',
                'address' => 'Phnom Penh, Cambodia',
                'joined_date' => '2022-12-20',
                'is_deleted' => 0,
            ],
            [
                'first_name' => 'Then',
                'last_name' => 'Sivthean',
                'gender' => 'female',
                'dob' => '2008-08-08',
                'phone' => '098987654',
                'email' => 'siv.thean@gmail.com',
                'address' => 'Phnom Penh, Cambodia',
                'joined_date' => '2025-01-01',
                'is_deleted' => 0,
            ],
            [
                'first_name' => 'Sim',
                'last_name' => 'Rathana',
                'gender' => 'male',
                'dob' => '2001-11-11',
                'phone' => '011223344',
                'email' => 'sim.rathana@gmail.com',
                'address' => 'Phnom Penh, Cambodia',
                'joined_date' => '2023-01-01',
                'is_deleted' => 0,
            ],
            [
                'first_name' => 'Huy',
                'last_name' => 'Sambath',
                'gender' => 'male',
                'dob' => '2002-02-22',
                'phone' => '099887766',
                'email' => 'sambath@gmail.com',
                'address' => 'Phnom Penh, Cambodia',
                'joined_date' => '2024-06-25',
                'is_deleted' => 0,
            ],
            [
                'first_name' => 'Choun',
                'last_name' => 'Davin',
                'gender' => 'male',
                'dob' => '2003-03-13',
                'phone' => '017889966',
                'email' => 'davin.choun@gmail.com',
                'address' => 'Phnom Penh, Cambodia',
                'joined_date' => '2024-06-25',
                'is_deleted' => 0,
            ],
            [
                'first_name' => 'Sam',
                'last_name' => 'Rotha',
                'gender' => 'female',
                'dob' => '2003-10-29',
                'phone' => '012334455',
                'email' => 'rotha.sam@gmail.com',
                'address' => 'Phnom Penh, Cambodia',
                'joined_date' => '2023-03-29',
                'is_deleted' => 0,
            ],
        ];

        foreach($members as $member){
            Member::create($member);
        }
    }
}
