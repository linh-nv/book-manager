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
        Schema::create('books', function (Blueprint $table) {
            $table->id('id');
            $table->string('name', 255);
            $table->string('slug', 255);
            $table->integer('quantity');
            $table->string('description', 255)->nullable();
            $table->string('front_image', 255);
            $table->string('thumbnail', 255);
            $table->string('rear_image', 255);
            $table->bigInteger('category_id');
            $table->bigInteger('author_id');
            $table->bigInteger('publisher_id');
            $table->integer('price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
