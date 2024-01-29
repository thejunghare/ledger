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
            // user 1
            [
                'user_id' => 1,
                'budget_name' => 'bugdet One',
                'budget_amount' => 25000,
            ],
            // user 2
            [
                'user_id' => 2,
                'budget_name' => 'bugdet One',
                'budget_amount' => 25000,
            ],
        ]);
    }
}
