<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'first_name' => 'Admin',
                'last_name' => 'Jonh',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin@123'),
                'role' => 'admin',
                'gender' => 'male'
            ],
            [
                'first_name' => 'Chan',
                'last_name' => 'Thida',
                'email' => 'staff@gmail.com',
                'password' => Hash::make('staff@123'),
                'role' => 'staff',
                'gender' => 'female'
            ],
        ];

        foreach($users as $user){
            User::create($user);
        }
    }
}
