<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class NotificacionAdministradoresPermisosValidados extends Mailable
{
    use Queueable, SerializesModels;

    public $permisos;
    public $empleado;
    public $subject;
    public $ruta_btn;

    public $from    = [['address' => 'sistemashuem@gmail.com', 'name' => 'HUEM']];
    public $replyTo = [['address' => 'no-reply@herasmomeoz.gov.co', 'name' => 'No responder este mensaje']];


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($permisos, $empleado)
    {
        $this->permisos = $permisos;
        $this->empleado = \strtoupper($empleado->empleado->nombreCompleto());

        $this->subject  = "NOTIFICACIÓN DE ASIGNACIÓN DE PERMISOS VALIDADOS PARA EL USUARIO {$this->empleado}";

        $this->ruta_btn = URL::to('/') . '/gestor_permisos/asignar_permisos/empleado/'. base64_encode($empleado->id);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.NotificacionAdministradoresPermisosValidados');
    }
}
