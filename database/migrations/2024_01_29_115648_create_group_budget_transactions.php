<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
            Schema::create('group_budget_transactions', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('user_id');
                $table->unsignedBigInteger('transaction_type_id'); // Foreign key for default_category_types
                $table->unsignedBigInteger('for_budget_id'); // Foreign key for group_budgets
                $table->unsignedBigInteger('amount');
                $table->unsignedBigInteger('category_id'); // Foreign key for default_categories
                $table->unsignedBigInteger('paymode_id'); // Foreign key for pay_mode
                $table->timestamps();

                $table->index('user_id');

                // Foreign key constraints
                $table->foreign('user_id')->references('id')->on('users');
                $table->foreign('transaction_type_id')->references('id')->on('default_category_types');
                $table->foreign('for_budget_id')->references('id')->on('group_budgets')->onDelete('cascade');
                $table->foreign('category_id')->references('id')->on('default_categories');
                $table->foreign('paymode_id')->references('id')->on('pay_mode');
            });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_budget_transactions');
    }
};
