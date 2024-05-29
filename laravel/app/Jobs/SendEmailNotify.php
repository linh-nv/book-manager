<?php

namespace App\Jobs;

use Illuminate\Support\Facades\Mail;
use App\Mail\MailNotify;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendEmailNotify implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $data;
    protected $users;
    protected $email;

    /**
     * Create a new job instance.
     */
    public function __construct($email, $data)
    {
        $this->data = $data;
        // $this->users = $users;
        $this->email = $email;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // foreach ($this->users as $user) {
            // Mail::to($user->email)->send(new MailNotify($this->data));
        // }
        Mail::to($this->email)->send(new MailNotify($this->data));
    }
}
