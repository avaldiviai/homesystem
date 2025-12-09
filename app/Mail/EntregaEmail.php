<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EntregaEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $fecha_entrega;
    public $condominio;
    public $propiedadDireccion;
    public $propiedadTorre;
    public $propiedadNumTorre;
    public $propiedadVivienda;
    public $propiedadCiudad;
    /**
     * Create a new message instance.
     */
    public function __construct($fecha_entrega,$condominio, $propiedadDireccion, $propiedadTorre,$propiedadNumTorre,$propiedadVivienda,$propiedadCiudad,)
    {
        $this->fecha_entrega = $fecha_entrega;
        $this->condominio = $condominio;
        $this->propiedadDireccion = $propiedadDireccion;
        $this->propiedadTorre = $propiedadTorre;
        $this->propiedadNumTorre = $propiedadNumTorre;
        $this->propiedadVivienda = $propiedadVivienda;
        $this->propiedadCiudad = $propiedadCiudad;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Entrega Email',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.emailentrega',
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
