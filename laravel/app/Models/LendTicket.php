<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LendTicket extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'start_date',
        'end_date',
        'status',
        'note',
    ];

    public function user() 
    {

        return $this->belongsTo(User::class);
    }
    
    public function ticketDetails()
    {

        return $this->hasMany(TicketDetail::class, 'lend_ticket_id');
    }

    public function books()
    {
        
        return $this->belongsToMany(Book::class, 'ticket_details', 'lend_ticket_id', 'book_id');
    }
    
    protected static function boot()
    {
        parent::boot();
    
        static::deleting(function (LendTicket $lendTicket) {
            $lendTicket->ticketDetails()->delete();
        });
    }
    
}
