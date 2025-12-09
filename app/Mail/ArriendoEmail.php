<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ArriendoEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $valor_real;
    public $fecha_pago;
    public $condominio;
    public $propiedadDireccion;
    public $propiedadTorre;
    public $propiedadNumTorre;
    public $propiedadVivienda;
    public $propiedadCiudad;
    public $diasAtraso;



    /**
     * Create a new message instance.
     */
    public function __construct($valor_real,$fecha_pago,$condominio, $propiedadDireccion, $propiedadTorre,$propiedadNumTorre,$propiedadVivienda,$propiedadCiudad,$diasAtraso)
    {
        $this->valor_real = $valor_real;
        $this->fecha_pago = $fecha_pago;
        $this->condominio = $condominio;
        $this->propiedadDireccion = $propiedadDireccion;
        $this->propiedadTorre = $propiedadTorre;
        $this->propiedadNumTorre = $propiedadNumTorre;
        $this->propiedadVivienda = $propiedadVivienda;
        $this->propiedadCiudad = $propiedadCiudad;
        $this->diasAtraso = $diasAtraso;

    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Arriendo Email',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.emailarriendo',
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
