<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PaymodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("pay_mode")->insert([
            // type 1
            [

                'paymode_type' => 'UPI',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // type 2
            [

                'paymode_type' => 'Cash',
                'created_at' => now(),
                'updated_at' => now(),
            ],
             // type 3
             [

                'paymode_type' => 'Bank transfer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
