<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TicketDetail extends Model
{
    use HasFactory,
        SoftDeletes;

    protected $fillable = [
        'book_id',
        'lend_ticket_id',
        'status',
        'return_date',
        'quantity',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($ticketDetail) {
            $ticketDetail->status = 1;
            $ticketDetail->created_at = Carbon::now();
            $ticketDetail->updated_at = Carbon::now();
        });
    }

    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }

    public function lendTicket()
    {
        return $this->belongsTo(LendTicket::class, 'lend_ticket_id');
    }
}
