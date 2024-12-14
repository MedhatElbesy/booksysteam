<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
                "name"       => "user",
                "email"      => "user@user.com",
                'password'   => Hash::make('Mm.1@23456'),
                'user_type'  => 'teacher'
            ],
            [
                "name"       => "user 1",
                "email"      => "user1@user.com",
                'password'   => Hash::make('Mm.1@23456'),
                                'user_type'  => 'teacher'

            ],
            [
                "name"       => "user 2",
                "email"      => "user2@user.com",

                'user_type'  => 'admin',

                'password'   => Hash::make('12345678'),
            ],

        ];

        DB::table('users')->insert($users);
    }
}
