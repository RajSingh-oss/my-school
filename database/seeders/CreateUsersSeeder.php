<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Student',
                'email' => 'Student@Student.com',
                'type' => 0,
                'password' => bcrypt('123456'),
            ],
            [
                'name' => 'Teacher',
                'email' => 'Teacher@Teacher.com',
                'type' => 1,
                'password' => bcrypt('123456'),
            ],
            [
                'name' => 'HR User',
                'email' => 'HR@HR.com',
                'type' => 2,
                'password' => bcrypt('123456'),
            ],
            [
                'name' => 'Admin',
                'email' => 'Admin@Admin.com',
                'type' => 3,
                'password' => bcrypt('123456'),
            ],
            [
                'name' => 'SuperAdmin',
                'email' => 'SuperAdmin@SuperAdmin.com',
                'type' => 4,
                'password' => bcrypt('123456'),
            ],
        ];

        foreach ($users as $key => $user) {
            User::create($user);
        }
    }
}
