<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id',
        'lend_ticket_id',
        'return_date',
        'quantity',
    ];

    // Define the 'creating' event to automatically set status to 1 and add timestamp
    protected static function boot()
    {
        parent::boot();

        // Listen for the 'creating' event
        static::creating(function ($ticketDetail) {
            $ticketDetail->status = 1; // Set status to 1
            $ticketDetail->quantity = 1; // Set status to 1
            $ticketDetail->created_at = Carbon::now(); // Add created_at timestamp
            $ticketDetail->updated_at = Carbon::now(); // Add updated_at timestamp
        });
    }

    public function lendTickets()
    {

        return $this->belongsToMany(LendTicket::class, 'lend_tickets','book_id' ,'lend_ticket_id');
    }
    public function books() 
    {
        return $this->belongsTo(Book::class);
    }
}
