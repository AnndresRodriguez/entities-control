<?php

namespace Tests\Browser;

use App\Console\Kernel;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Filesystem\Filesystem;


class GestorPermisosTest extends DuskTestCase
{
    /**
     * Ejecutar las migraciones antes de cargar la clase.
     */
    public static function setUpBeforeClass()
    {
        parent::setUpBeforeClass();
        $app = require __DIR__ . '/../../bootstrap/app.php';
        $kernel = $app->make(Kernel::class);
        $kernel->bootstrap();
        $kernel->call('migrate:fresh');
        $kernel->call('db:seed');
        
        $file = new Filesystem();
        $file->deleteDirectory( base_path('tests/Browser/screenshots/gestor_permisos') );
    }

    /**
     * @test
     */
    public function un_empleado_puede_solicitar_permisos()
    {
        $user = \App\User::find(3);

        $this->browse(function (Browser $browser) use ($user){
            $browser->loginAs($user)
                    ->visit('/gestor_permisos/solicitar_permisos')
                    ->assertSee('Gestor de Permisos')
                    ->assertSee('Solicitar permisos')

                    ->pause(1000)

                    // Seleccionar permisos del software de Dinamica
                    ->waitForText('DINAMICA GERENCIAL')
                    ->doClickToNumberElementXFromAClass('.btn-open-modulos', 0)
                    
                    ->waitForText('HISTORIA CLINICA')
                    ->doClickToNumberElementXFromAClass('.btn-open-procesos', 0)
                    ->waitForText('PROCESO 1')
                    ->doClickToNumberElementXFromAClass('.check-seleccionar-permisos', 0)

                    ->waitForText('FACTURACIÓN')
                    ->doClickToNumberElementXFromAClass('.btn-open-procesos', 1)
                    ->waitForText('PROCESO 2')
                    ->doClickToNumberElementXFromAClass('.check-seleccionar-permisos', 1)


                    // Seleccionar permisos del software de HuemApp
                    ->waitForText('APLICATIVOS HUEM')
                    ->doClickToNumberElementXFromAClass('.btn-open-modulos', 1)

                    ->waitForText('HISTORIA CLINICA')
                    ->doClickToNumberElementXFromAClass('.btn-open-procesos', 2)
                    ->waitForText('PROCESO 3')
                    ->doClickToNumberElementXFromAClass('.check-seleccionar-permisos', 0)

                    ->scrollWindow(0, 500)
                    ->screenshot('gestor_permisos/1.0_listado_de_permisos')

                    ->pause(500)
                    ->click('#solicitar-permisos')

                    ->scrollWindow(0, 0)
                    
                    ->waitForText('Su solicitud de permisos sé registro correctamente.')
                    ->assertSee('Su solicitud de permisos sé registro correctamente.')

                    ->screenshot('gestor_permisos/1_un_empleado_puede_solicitar_permisos')
                    ;
        });
    }

    /**
     * @test
     */
    public function un_jefe_puede_validar_los_permisos_de_un_colaborador_asignado()
    {
        $user = \App\User::find(2);

        $this->browse(function (Browser $browser) use ($user){
            $browser->loginAs($user)
                    ->visit('/gestor_permisos/validar_permisos')
                    ->assertSee('Gestor de Permisos')
                    ->assertSee('Validar permisos')

                    ->pause(1000)

                    ->select2('#listado-colaboradores', '1090111223')
                    ->waitForText('PERMISOS SOLICITADOS POR EL COLABORADOR')
                    ->assertSee('PERMISOS SOLICITADOS POR EL COLABORADOR')
                    ->type('#fecha_global', '3-5-2020')

                    ->click('#validar-permisos')
                    ->waitForText('La validación de los permisos se registro correctamente.')
                    ->assertSee('La validación de los permisos se registro correctamente.')

                    ->screenshot('gestor_permisos/2_un_jefe_puede_validar_los_permisos_de_un_colaborador_asignado')
                    ;
        });
    }

    /**
     * @test
     */
    public function un_administrador_puede_dar_de_alta_los_permisos_ya_validados_de_un_colaborador()
    {
        $user = \App\User::find(1);

        $this->browse(function (Browser $browser) use ($user){
            $browser->loginAs($user)
                    ->visit('/gestor_permisos/asignar_permisos')
                    ->assertSee('Gestor de Permisos')
                    ->assertSee('Asignar permisos')

                    ->pause(1000)

                    ->select2('#listado-colaboradores', '1090111223')
                    ->waitForText('PERMISOS SOLICITADOS POR EL COLABORADOR')
                    ->assertSee('PERMISOS SOLICITADOS POR EL COLABORADOR')

                    ->doClickToNumberElementXFromAClass('.check-asignar-permiso', 0)
                    ->doClickToNumberElementXFromAClass('.check-asignar-permiso', 1)

                    ->pause(500)

                    ->screenshot('gestor_permisos/3_un_administrador_puede_dar_de_alta_los_permisos_ya_validados_de_un_colaborador')
                    ;
        });
    }

    /**
     * @test
     */
    public function un_administrador_puede_notificar_a_un_colaborador_los_permisos_asignados()
    {
        $user = \App\User::find(1);

        $this->browse(function (Browser $browser) use ($user){
            $browser->loginAs($user)
                    ->visit('/gestor_permisos/asignar_permisos')
                    ->assertSee('Gestor de Permisos')
                    ->assertSee('Asignar permisos')

                    ->pause(1000)

                    ->select2('#listado-colaboradores', '1090111223')
                    ->waitForText('PERMISOS SOLICITADOS POR EL COLABORADOR')
                    ->assertSee('PERMISOS SOLICITADOS POR EL COLABORADOR')

                    ->click('#notificar-colaborador-permisos')
                    ->waitForText('Se envío la notificación con los permisos asignados al usuario.')

                    ->screenshot('gestor_permisos/4_un_administrador_puede_notificar_a_un_colaborador_los_permisos_asignados')
                    ;
        });
    }

    /**
     * @test
     */
    public function un_administrador_puede_registrar_softwares_modulos_procesos()
    {
        $user = \App\User::find(1);

        $this->browse(function (Browser $browser) use ($user){
            $browser->loginAs($user)
                    ->visit('/gestor_permisos/listado_softwares')
                    ->assertSee('LISTADO DE SOFTWARES REGISTRADOS')

                    ->type('#software-nombre', 'Nuevo Software')
                    ->click('#registrar-software')

                    ->waitForText('NUEVO SOFTWARE')
                    ->assertSee('NUEVO SOFTWARE')

                    ->doClickToNumberElementXFromAClass('.btn-open-modulos', 0)
                    ->doClickToNumberElementXFromAClass('.btn-open-modulos', 1)
                    ->pause(500)

                    ->type('#add-modulo-in-3', 'Nuevo modulo')
                    ->doClickToNumberElementXFromAClass('.registrar-modulo', 2)
                    ->waitForText('NUEVO MODULO')
                    ->assertSee('NUEVO MODULO')

                    ->type('#add-proceso-in-5', 'Nuevo proceso')
                    ->doClickToNumberElementXFromAClass('.registrar-proceso', 4)
                    ->waitForText('NUEVO PROCESO')
                    ->assertSee('NUEVO PROCESO')

                    ->pause(500)
                    ->screenshot('gestor_permisos/5_un_administrador_puede_registrar_softwares_modulos_procesos')
                    ;
        });
    }

    /**
     * @test
     */
    public function un_empleado_puede_solicitar_retiro_de_sus_permisos()
    {
        $user = \App\User::find(3);

        $this->browse(function (Browser $browser) use ($user){
            $browser->loginAs($user)
                    ->visit('/gestor_permisos/solicitar_permisos')
                    ->assertSee('Gestor de Permisos')
                    ->assertSee('Solicitar permisos')

                    ->pause(1000)

                    ->click('#solicitar-retiro')

                    ->waitForText('¿Está realmente seguro de solicitar el retiro de sus permisos?')
                    ->assertSee('¿Está realmente seguro de solicitar el retiro de sus permisos?')

                    ->click('.swal2-confirm')
                    
                    ->waitForText('Su solicitud de retiro de permisos sé registro correctamente.')
                    ->assertSee('Su solicitud de retiro de permisos sé registro correctamente.')

                    ->screenshot('gestor_permisos/6_un_empleado_puede_solicitar_retiro_de_sus_permisos')
                    ;
        });
    }

    /**
     * @test
     */
    public function un_administrador_puede_retirar_los_permisos_de_un_colaborador()
    {
        $user = \App\User::find(1);

        $this->browse(function (Browser $browser) use ($user){
            $browser->loginAs($user)
                    ->visit('/gestor_permisos/asignar_permisos')
                    ->assertSee('Gestor de Permisos')
                    ->assertSee('Asignar permisos')

                    ->pause(1000)

                    ->select2('#listado-colaboradores', '1090111223')
                    ->waitForText('PERMISOS SOLICITADOS POR EL COLABORADOR')
                    ->assertSee('PERMISOS SOLICITADOS POR EL COLABORADOR')

                    ->waitForText('El usuario ah solicitado que se le retiren todos los permisos.')
                    ->assertSee('El usuario ah solicitado que se le retiren todos los permisos.')

                    ->assertSee('Dar de baja')

                    ->click('#dar-de-baja-colaborador')

                    ->waitForText('¿Está realmente seguro de dar de baja los permisos del colaborador?')
                    ->assertSee('¿Está realmente seguro de dar de baja los permisos del colaborador?')

                    ->click('.swal2-confirm')

                    ->waitForText('El retiro de los permisos del colaborador sé realizo correctamente.')
                    ->assertSee('El retiro de los permisos del colaborador sé realizo correctamente.')

                    ->screenshot('gestor_permisos/7_un_administrador_puede_retirar_los_permisos_de_un_colaborador')
                    ;
        });
    }

    /**
     * @test
     */
    public function un_empleado_puede_imprimir_su_solicitud_de_retiro_ya_tramitada()
    {
        $user = \App\User::find(3);

        $this->browse(function (Browser $browser) use ($user){
            $response = $browser->loginAs($user)
                        ->visit('/gestor_permisos/solicitar_permisos')
                        ->assertSee('Gestor de Permisos')
                        ->assertSee('Solicitar permisos')

                        ->pause(1000)
                        ->assertButtonEnabled('#imprimir-paz-salvo')

                        ->visit('/gestor_permisos/solicitud_retiro/MQ==/imprimir')

                        ->screenshot('gestor_permisos/8_un_empleado_puede_imprimir_su_solicitud_de_retiro_ya_tramitada')
                        ;

            // Obtener la ultima pestaña abierta en el navegador
            //$window = collect($response->driver->getWindowHandles())->last();
            // Switch to the new tab that contains the screenshot
            //$response->driver->switchTo()->window($window);
            // Assert Path  
            //$response->assertPathIs('/gestor_permisos/solicitud_retiro/MQ==/imprimir');

        });

    }

}
