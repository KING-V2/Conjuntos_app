<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RespuestaTrasteoMail extends Mailable
{
    use Queueable, SerializesModels;

    public $datos; // Datos que se enviarán a la vista

    public function __construct($datos)
    {
        $this->datos = $datos;
    }

    public function build()
    {
        return $this->subject('Respuesta Solicitud de Trasteo')
                    ->view('admin.email_template.respuesta_trasteo_admin'); 
    }
}
