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
        Schema::table('lend_tickets', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
        });
        Schema::table('books', function (Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('publisher_id')->references('id')->on('publishers');
            $table->foreign('author_id')->references('id')->on('authors');
        });
        Schema::table('ticket_details', function (Blueprint $table) {
            $table->foreign('book_id')->references('id')->on('books');
            $table->foreign('lend_ticket_id')->references('id')->on('lend_tickets');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('role_id')->references('id')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
        });
        Schema::table('books', function (Blueprint $table) {
            $table->dropForeign(['author_id']);
            $table->dropForeign(['category_id']);
            $table->dropForeign(['publisher_id']);
        });
        Schema::table('lend_tickets', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
        Schema::table('ticket_details', function (Blueprint $table) {
            $table->dropForeign(['book_id']);
            $table->dropForeign(['lend_ticket_id']);
        });
    }
};