<?php

namespace Tests\Feature;

use App\Role;
use App\User;
use App\Permiso;
use App\Empleado;

use Tests\TestCase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AutenticacionTest extends TestCase
{
    use RefreshDatabase;

    public function setUp()
    {
        parent::setUp();
        Artisan::call('db:seed', ['--class' => 'TestsDatabaseSeeder']);
    }

    /**
     * A basic test example.
     * @test
     * @return void
     */
    public function iniciarSesionTest()
    {
        $this->withoutExceptionHandling();

        $response = $this->postJson('/login', [
            '_token'  => Session::token(),
            'usuario' => 'Edward',
            'password' => '123456',
            'remember' => false,
        ]);

        return $response->assertJson(["success" => 1]);
    }
}
