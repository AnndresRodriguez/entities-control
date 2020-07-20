<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MailAlarm extends Mailable
{
    use Queueable, SerializesModels;

    public $ente_control;
    public $nombre_informe;
    public $fecha_informe;
    public $responsable;

    public $from    = [['address' => 'sistemashuem@gmail.com', 'name' => 'HUEM']];
    public $replyTo = [['address' => 'no-reply@herasmomeoz.gov.co', 'name' => 'No responder este mensaje']];

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($ente_control, $nombre_informe, $fecha_informe, $responsable)
    {
        $this->ente_control = $ente_control;
        $this->nombre_informe = $nombre_informe;
        $this->fecha_informe = $fecha_informe;
        $this->$responsable = $responsable;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.NotificacionAlarmasEntregas');
    }
}
