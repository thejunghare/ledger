<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('users')->insert([
            // user1
            [
                'name' => 'userone',
                'email' => 'userone@gmail.com',
                'password' => Hash::make('password'),
            ],
            // user2
            [
                'name' => 'usertwo',
                'email' => 'usertwo@gmail.com',
                'password' => Hash::make('password'),
            ]
        ]);
    }
}
