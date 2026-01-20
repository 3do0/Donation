<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DonationSuccessful extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $donationDetails;

    public function __construct($donationDetails)
    {
        $this->donationDetails = $donationDetails;
    }

    public function build()
    {
        return $this->from(config('mail.from.address'))
                    ->subject('شكراً لتبرعك!')
                    ->view('emails.donation-success')  
                    ->with('donationDetails', $this->donationDetails);
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'نجاح عملية التبرع 🎇',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.donation-success',  
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
