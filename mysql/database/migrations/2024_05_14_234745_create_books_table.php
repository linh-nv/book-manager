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
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('slug')->unique();
            $table->tinyInteger('status');
            $table->foreignId('author_id')->constrained('authors');
            $table->foreignId('category_id')->constrained('categories');
            $table->foreignId('child_category_id')->constrained('child_categories');
            $table->foreignId('publisher_id')->constrained('publishers');
            $table->decimal('regular_price', 10, 2);
            $table->decimal('sale_price', 10, 2)->nullable();
            $table->date('publication_date')->nullable();
            $table->string('language', 20)->nullable();
            $table->integer('pages')->nullable();
            $table->text('description')->nullable();
            $table->string('image_url')->nullable();
            $table->decimal('rating', 3, 2)->default(0);
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
