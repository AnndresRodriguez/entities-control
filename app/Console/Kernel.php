<?php

namespace App\Console;

use App\Mail\MailAlarm;
use DateTime;
use Illuminate\Console\Scheduling\Schedule;

use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [

    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {





        $schedule->call(function()  {

            $users = DB::table('alarmas')
                    ->join('informes', 'alarmas.id_informe', '=', 'informes.id')
                    ->join('dependencias', 'informes.id_dependencia', '=', 'dependencias.id')
                    ->join('entes', 'informes.id_ente_control', '=', 'entes.id')
                    ->select('alarmas.fecha_hora_alarma', 'dependencias.correo_responsable', 'dependencias.responsable', 'entes.nombre as nombre_ente', 'informes.nombre as nombre_informe', 'informes.fecha_entrega')
                    ->get();

            foreach ($users as $user) {

                $today = date("Y-m-d H:i:s");
                $today_dt = DateTime::createFromFormat("Y-m-d H:i:s", $today);
                $today_dtf = $today_dt->format('Y-m-d');

                $dt = DateTime::createFromFormat("Y-m-d", $user->fecha_hora_alarma);
                $dtf = $dt->format('Y-m-d');

                 if(strcmp($today_dtf, $dtf) === 0){

                     Mail::to($user->correo_responsable)->send(new MailAlarm($user->nombre_ente, $user->nombre_informe, $user->fecha_entrega, $user->responsable));


                 }


               }




        })->twiceDaily(7, 12)->timezone('America/New_York');





    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
