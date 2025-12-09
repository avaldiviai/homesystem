<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ElementoEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $nombre;
    public $createdAtFormateada;
    public $fechaConUnAnoMasFormateada;
    /**
     * Create a new message instance.
     */
    public function __construct($nombre,$createdAtFormateada,$fechaConUnAnoMasFormateada)
    {
        $this->nombre = $nombre;
        $this->createdAtFormateada = $createdAtFormateada;
        $this->fechaConUnAnoMasFormateada = $fechaConUnAnoMasFormateada;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Elemento Email',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.emailelemento',
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
