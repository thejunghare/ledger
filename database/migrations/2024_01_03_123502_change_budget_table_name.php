<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::rename('budget', 'budgets');
    }

    public function down()
    {
        // If you want to revert the changes, define the down() method
        // This is especially useful when rolling back migrations
        Schema::rename('budgets', 'budget');
    }
};
