<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('default_categories', function (Blueprint $table) {
            $table->id();
            $table->integer('isDefault');
            $table->unsignedBigInteger('category_type_id');
            $table->string('category_name');
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('category_type_id')
                ->references('id')
                ->on('default_category_types')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('default_categories');
    }
};
