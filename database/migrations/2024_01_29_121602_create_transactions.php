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
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('transaction_type_id');
            $table->date('date');
            $table->integer('amount')->unsigned();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('paymode_id');
            $table->timestamps();

            $table->index('user_id');

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('transaction_type_id')->references('id')->on('default_category_types');
            $table->foreign('category_id')->references('id')->on('default_categories');
            $table->foreign('paymode_id')->references('id')->on('pay_mode');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
