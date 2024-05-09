<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enum\TicketDetail;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ticket_details', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('book_id');
            $table->unsignedBigInteger('lend_ticket_id');
            $table->date('return_date');
            $table->enum('status', TicketDetail::values());
            $table->integer('quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket_details');
    }
};
