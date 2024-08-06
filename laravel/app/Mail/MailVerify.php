<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MailVerify extends Mailable
{
    use Queueable, SerializesModels;

   public $token;

   /**
    * Create a new data instance.
    *
    * @return void
    */

   public function __construct($token)
   {
       $this->token = $token;
   }

   /**
    * Build the message.
    *
    * @return $this
    */
   public function build()
   {
            $token = $this->token;

            return $this->from('nvlinh.rin@gmail.com')
            ->view('mails.verify', compact('token'))
            ->subject('Linh eCommerce - Confirm your email address');
   }
}
