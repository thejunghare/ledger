<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategoryTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table("default_category_types")->insert([
            // type 1
            [

                'category_type' => 'Income',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // type 2
            [

                'category_type' => 'Expense',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
