<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\URL;

class NotificacionColaboradorPermisosAsignados extends Mailable
{
    use Queueable, SerializesModels;

    public $empleado;
    public $permisos;
    public $subject;
    public $ruta_btn;

    public $from    = [['address' => 'sistemashuem@gmail.com', 'name' => 'HUEM']];
    public $replyTo = [['address' => 'no-reply@herasmomeoz.gov.co', 'name' => 'No responder este mensaje']];


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($empleado, $permisos)
    {
        $this->permisos = $permisos;
        $this->empleado = $empleado;

        $this->subject  = "NOTIFICACIÓN DE PERMISOS ASIGNADOS";

        $this->ruta_btn = URL::to('/') .'/gestor_permisos/solicitar_permisos';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.NotificacionColaboradorPermisosAsignados');
    }
}
