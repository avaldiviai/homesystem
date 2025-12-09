<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReajusteEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $inicioArriendoFormateada;
    public $fechaConUnAnoMasFormateada;
    /**
     * Create a new message instance.
     */
    public function __construct($inicioArriendoFormateada,$fechaConUnAnoMasFormateada)
    {
        $this->inicioArriendoFormateada = $inicioArriendoFormateada;
        $this->fechaConUnAnoMasFormateada = $fechaConUnAnoMasFormateada;
    }
    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Reajuste Email',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.emailreajuste',
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
