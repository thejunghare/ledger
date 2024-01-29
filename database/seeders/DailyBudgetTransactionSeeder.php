<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DailyBudgetTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        DB::table("transactions")->insert([
            //transactions for user 1
            [
                'user_id' => 1,
                'transaction_type_id' => 1,
                'date' => now(),
                'amount' => 25000,
                'category_id' => 1,
                'paymode_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),

            ],
            //transactions for user 2
            [
                'user_id' => 2,
                'transaction_type_id' => 2,
                'date' => now(),
                'amount' => 10000,
                'category_id' => 1,
                'paymode_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
