<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DailyBudgetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table("budgets")->insert([
            //budget for user 1
            [
                'user_id' => 1,
                'date' => now(),
                'amount' => 25000,
                'created_at' => now(),
                'updated_at'  => now(),

            ],
            //budget for user 2
            [
                'user_id' => 2,
                'date' => now(),
                'amount' => 10000,
                'created_at' => now(),
                'updated_at'  => now(),
            ],
        ]);
    }
}
