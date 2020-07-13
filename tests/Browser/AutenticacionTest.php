<?php

namespace Tests\Browser;

use App\Console\Kernel;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AutenticacionTest extends DuskTestCase
{
    //use DatabaseMigrations;

    /**
     * Ejecutar las migraciones una sola vez.
     */
    public static function setUpBeforeClass()
    {
        parent::setUpBeforeClass();
        $app = require __DIR__ . '/../../bootstrap/app.php';
        /** @var \Pterodactyl\Console\Kernel $kernel */
        $kernel = $app->make(Kernel::class);
        $kernel->bootstrap();
        $kernel->call('migrate:fresh');

        \Artisan::call('db:seed');
    }

    /**
     * A Dusk test example.
     *
     * @test
     */
    public function un_usuario_registrado_puede_iniciar_sesion()
    {
        //\Artisan::call('db:seed', ['--class' => 'TestsDatabaseSeeder']);
        $user = \App\User::find(1);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/')
                    ->assertPathIs('/login')
                    ->type('login-username', 'admin')
                    ->type('login-password', '123')
                    ->press('#btn-login')
                    ->pause(1000)
                    ->assertAuthenticated()
                    ;
        });
    }
}
