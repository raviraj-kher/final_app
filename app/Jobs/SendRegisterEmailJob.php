<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\UserRegistrationEmail;
use Mail;

class SendRegisterEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $emaiId;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($emaiId)
    {
        $this->emaiId = $emaiId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    { 
        $userEmail = new UserRegistrationEmail();
        Mail::to($this->emaiId)->send($userEmail);
    }
}
