<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Crypt;

class NotificacionJefeInmediatoSolictudPermisos extends Mailable
{
    use Queueable, SerializesModels;

    public $jefe_inmediato;
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
    public function __construct($jefe_inmediato, $permisos)
    {
        $this->jefe_inmediato = $jefe_inmediato;
        $this->permisos       = $permisos;

        $this->empleado = strtoupper(auth()->user()->empleado->nombreCompleto());
        $this->subject  = "NOTIFICACIÓN DE SOLICITUD DE PERMISOS - {$this->empleado}";

        $this->ruta_btn = URL::to('/') . '/gestor_permisos/validar_permisos/'. base64_encode(auth()->user()->id) .'/jefe_inmediato/'. Crypt::encrypt($jefe_inmediato->id);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.NotificacionJefeInmediatoSolictudPermisos');
    }
}
