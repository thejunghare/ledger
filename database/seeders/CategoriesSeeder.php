<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table("default_categories")->insert([
            // type income
            [
                'category_type_id' => 1,
                'category_name' => 'Other',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // type income
            [
                'category_type_id' => 1,
                'category_name' => 'Salary',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // type expense
            [
                'category_type_id' => 2,
                'category_name' => 'Other',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // type expense
            [
                'category_type_id' => 2,
                'category_name' => 'Food and Drinks',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
