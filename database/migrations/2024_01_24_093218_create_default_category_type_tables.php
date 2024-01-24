<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('default_category_types', function (Blueprint $table) {
            $table->id();
            $table->string('category_type');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('default_category_type');
    }
};
