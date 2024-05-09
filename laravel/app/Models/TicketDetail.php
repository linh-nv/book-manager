<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketDetail extends Model
{
    use HasFactory;

    public function lendTickets() {
        return $this->belongsTo(LendTicket::class);
    }

    public function books() {
        return $this->belongsTo(Book::class);
    }
}
