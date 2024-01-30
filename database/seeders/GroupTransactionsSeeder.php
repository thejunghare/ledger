<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GroupTransactionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table("group_budget_transactions")->insert([
            // user 1
            [
                'user_id' => 1,
                'transaction_type_id' => 1,
                'for_budget_id'=> 1,
                'amount'=> 500,
                'category_id' => 1,
                'paymode_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // user 1
            [
                'user_id' => 1,
                'transaction_type_id' => 2,
                'for_budget_id'=> 1,
                'amount'=> 500,
                'category_id' => 1, 
                'paymode_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // user 2
            [
                'user_id' => 2,
                'transaction_type_id' => 1,
                'for_budget_id'=> 1,
                'amount'=> 500,
                'category_id' => 1,
                'paymode_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // user 2
            [
                'user_id' => 2,
                'transaction_type_id' => 2,
                'for_budget_id'=> 1,
                'amount'=> 500,
                'category_id' => 1,
                'paymode_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
