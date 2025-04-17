<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RejectionOrganizationApply extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    public $rejection_reason;

    /**
     * Create a new message instance.
     */
    public function __construct($rejection_reason)
    {
        $this->rejection_reason = $rejection_reason;
    }

    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'))
                    ->subject('نعتذر منكم!')
                    ->view('emails.rejection-organization-apply')  
                    ->with('rejection_reason', $this->rejection_reason);
    }
    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'رفض طلب الانضمام إلى تكافل',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.rejection-organization-apply',
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
