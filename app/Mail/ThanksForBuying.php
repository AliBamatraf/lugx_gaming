<?php

namespace App\Mail;

use App\Models\Game;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ThanksForBuying extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(public User $user, public Game $game)
    {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Thanks For Buying',
            from: new Address('luxgaming@gmail.com', 'management'),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            // markdown: 'mail.thanks-for-buying',
            view: 'mail.thanksForBuying',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        $imagePath = $this->game->image; // Assuming this is the relative path in 'storage/app/public'

        // Log and add attachment if exists
        if (Storage::disk('public')->exists($imagePath)) {
            return [
                Attachment::fromStorageDisk('public', $imagePath)
            ];
        } else {
            Log::error("Image not found: " . $imagePath);
            return []; // No attachment if file is missing
        }
    }
}
