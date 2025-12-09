<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MantencionEmail extends Mailable
{
    use Queueable, SerializesModels;

public $nombre;
public $descripcion;
public $fecha_mantencion;
public $meses;
public $fecha_prox_man;
public $propiedadDireccion;
public $propiedadTorre;
public $propiedadCondominio;
public $propiedadNumTorre;
public $propiedadVivienda;
public $propiedadCiudad;



/**
 * Constructor de la clase.
 *
 * @param string $nombre
 * @param string $descripcion
 * @param string $fecha_mantencion
 * @param int $meses
 * @param string $fecha_prox_man
 */
public function __construct($nombre, $descripcion, $fechaMantencion, $meses, $fechaProxMan, $propiedadCondominio, $propiedadDireccion, $propiedadTorre,$propiedadNumTorre,$propiedadVivienda,$propiedadCiudad,)
{
    $this->nombre = $nombre;
    $this->descripcion = $descripcion;
    $this->fecha_mantencion = $fechaMantencion;
    $this->meses = $meses;
    $this->fecha_prox_man = $fechaProxMan;

    $this->propiedadCondominio = $propiedadCondominio;
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
            subject: 'Mantencion Email',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.emailmantencion',
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
