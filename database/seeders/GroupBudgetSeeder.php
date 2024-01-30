<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GroupBudgetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table("group_budgets")->insert([
            //group budget for user 1
            [
                'user_id' => 1,
                'budget_name' => 'budget One',
                'budget_amount' => 25000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
             //group budget for user 1
             [
                'user_id' => 1,
                'budget_name' => 'budget Two',
                'budget_amount' => 25000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            //group budget user 2
            [
                'user_id' => 2,
                'budget_name' => 'budget One',
                'budget_amount' => 25000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
             //group budget for user 1
             [
                'user_id' => 2,
                'budget_name' => 'budget Two',
                'budget_amount' => 25000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
