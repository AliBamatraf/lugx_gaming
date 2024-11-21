<?php

namespace App\Jobs;

use App\Mail\ThanksForBuying;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use phpDocumentor\Reflection\Types\This;

class SendThanksForBuyingEmail implements ShouldQueue
{
    use Queueable;

    protected $user;
    protected $currentGame;
    /**
     * Create a new job instance.
     */
    public function __construct($user, $currentGame)
    {
        $this->user = $user;
        $this->currentGame = $currentGame;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->user)->send(new ThanksForBuying($this->user, $this->currentGame));
    }
}
