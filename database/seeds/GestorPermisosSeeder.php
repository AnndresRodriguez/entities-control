<?php

use Illuminate\Database\Seeder;

class GestorPermisosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // PERMISOS

        $permiso1 = new App\Permiso();
        $permiso1->nombre = 'super_administrador';
        $permiso1->descripcion = 'Permiso Seeder';
        $permiso1->ruta = 'all';
        $permiso1->save();

        // $permiso2 = new App\Permiso();
        // $permiso2->nombre = 'gestor_permisos_solicitar';
        // $permiso2->descripcion = 'Este permiso permite solicitar permisos.';
        // $permiso2->ruta = 'gestor_permisos.solicitar';
        // $permiso2->save();

        // $permiso3 = new App\Permiso();
        // $permiso3->nombre = 'gestor_permisos_validar';
        // $permiso3->descripcion = 'Este permiso permite validar los permisos solicitados por sus colaboradores.';
        // $permiso3->ruta = 'gestor_permisos.validar';
        // $permiso3->save();

        // $permiso4 = new App\Permiso();
        // $permiso4->nombre = 'gestor_permisos_asignar';
        // $permiso4->descripcion = 'Esta permiso le permite al usuario dar de alta los permisos solicitados y ya validados por el jefe inmediato.';
        // $permiso4->ruta = 'gestor_permisos.asignar';
        // $permiso4->save();

        // $permiso5 = new App\Permiso();
        // $permiso5->nombre = 'gestor_permisos_listado_softwares';
        // $permiso5->descripcion = 'Este permiso le permite registrar los siguientes recursos, softwares, modulos y procesos.';
        // $permiso5->ruta = 'gestor_permisos.listado_softwares';
        // $permiso5->save();


        // ROLES

        $role1 = new App\Role();
        $role1->nombre = 'Super Administrador';
        $role1->descripcion = 'Rol seeder';
        $role1->save();
        $role1->permisos()->attach([$permiso1->id]);

        // $role2 = new App\Role();
        // $role2->nombre = 'Administrador Gestor Permisos';
        // $role2->descripcion = 'Rol seeder';
        // $role2->save();
        // $role2->permisos()->attach([$permiso1->id, $permiso2->id, $permiso3->id, $permiso4->id, $permiso5->id]);

        // $role3 = new App\Role();
        // $role3->nombre = 'Jefe Inmediato';
        // $role3->descripcion = 'Rol seeder';
        // $role3->save();
        // $role3->permisos()->attach([$permiso2->id, $permiso3->id]);

        // $role4 = new App\Role();
        // $role4->nombre = 'Empleado';
        // $role4->descripcion = 'Rol seeder';
        // $role4->save();
        // $role4->permisos()->attach([$permiso2->id]);


        // Usuario 1 - Administrador

        $empleado1 = new App\Empleado();
        $empleado1->documento = '10902562714';
        $empleado1->nombres = 'Administrador';
        $empleado1->apellidos = 'Administrador';
        $empleado1->fecha_nacimiento = null;
        $empleado1->genero = 'M';
        $empleado1->cargo = 'Administrador App';
        $empleado1->save();

        $user1 = new App\User();
        $user1->empleado_id = $empleado1->id;
        $user1->role_id = $role1->id;
        $user1->username = 'admin';
        $user1->email = 'andresjoe24@gmail.com';
        $user1->password = bcrypt('secret');
        $user1->save();


        // Usuario 2 - Jefe inmediato

        // $empleado2 = new App\Empleado();
        // $empleado2->documento = '1090111224';
        // $empleado2->nombres = 'Jefe';
        // $empleado2->apellidos = 'Inmediato';
        // $empleado2->fecha_nacimiento = null;
        // $empleado2->genero = 'M';
        // $empleado2->cargo = 'Jefe App';
        // $empleado2->save();

        // $user2 = new App\User();
        // $user2->empleado_id = $empleado2->id;
        // $user2->role_id = $role3->id;
        // $user2->username = 'jefe';
        // $user2->email = 'correo.huem@gmail.com';
        // $user2->password = bcrypt('123');
        // $user2->jefe_inmediato_id = $user1->id;
        // $user2->save();


        // Usuario 3 - Empleado

        // $empleado3 = new App\Empleado();
        // $empleado3->documento = '1090111223';
        // $empleado3->nombres = 'Nombre';
        // $empleado3->apellidos = 'Empleado';
        // $empleado3->fecha_nacimiento = null;
        // $empleado3->genero = 'M';
        // $empleado3->cargo = 'Empleado App';
        // $empleado3->save();

        // $user3 = new App\User();
        // $user3->empleado_id = $empleado3->id;
        // $user3->role_id = $role4->id;
        // $user3->username = 'empleado';
        // $user3->email = 'empleado@herasmomeoz.gov.co';
        // $user3->password = bcrypt('123');
        // $user3->jefe_inmediato_id = $user2->id;
        // $user3->save();



        // SOFTWARES 1

        // $aplicativo = new App\Models\GestorPermisos\GesperSoftware();
        // $aplicativo->nombre = "DINAMICA GERENCIAL";
        // $aplicativo->slug   = "dinamica-gerencial";
        // $aplicativo->save();

        // // MODULOS
        // $modulo = new App\Models\GestorPermisos\GesperModulo();
        // $modulo->gesper_software_id = $aplicativo->id;
        // $modulo->nombre = "HISTORIA CLINICA";
        // $modulo->slug   = "historia-clinica";
        // $modulo->save();

        // $modulo2 = new App\Models\GestorPermisos\GesperModulo();
        // $modulo2->gesper_software_id = $aplicativo->id;
        // $modulo2->nombre = "FACTURACIÓN";
        // $modulo2->slug   = "facturacion";
        // $modulo2->save();

        // // PROCESOS
        // $proceso = new App\Models\GestorPermisos\GesperProceso();
        // $proceso->gesper_modulo_id = $modulo->id;
        // $proceso->nombre = "PROCESO 1";
        // $proceso->slug   = "proceso-1";
        // $proceso->save();

        // $proceso2 = new App\Models\GestorPermisos\GesperProceso();
        // $proceso2->gesper_modulo_id = $modulo2->id;
        // $proceso2->nombre = "PROCESO 2";
        // $proceso2->slug   = "proceso-2";
        // $proceso2->save();



        // // SOFTWARES 2

        // $aplicativo2 = new App\Models\GestorPermisos\GesperSoftware();
        // $aplicativo2->nombre = "APLICATIVOS HUEM";
        // $aplicativo2->slug   = "aplicativos-huem";
        // $aplicativo2->save();

        // MODULOS 2
        // $modulo3 = new App\Models\GestorPermisos\GesperModulo();
        // $modulo3->gesper_software_id = $aplicativo2->id;
        // $modulo3->nombre = "INDICADORES";
        // $modulo3->slug   = "indicadores";
        // $modulo3->save();

        // $modulo4 = new App\Models\GestorPermisos\GesperModulo();
        // $modulo4->gesper_software_id = $aplicativo2->id;
        // $modulo4->nombre = "PLANES DE MEJORAMIENTO";
        // $modulo4->slug   = "planes-de-mejoramiento";
        // $modulo4->save();

        // // PROCESOS
        // $proceso3 = new App\Models\GestorPermisos\GesperProceso();
        // $proceso3->gesper_modulo_id = $modulo3->id;
        // $proceso3->nombre = "PROCESO 3";
        // $proceso3->slug   = "proceso-3";
        // $proceso3->save();

        // $proceso4 = new App\Models\GestorPermisos\GesperProceso();
        // $proceso4->gesper_modulo_id = $modulo4->id;
        // $proceso4->nombre = "PROCESO 4";
        // $proceso4->slug   = "proceso-4";
        // $proceso4->save();
    }
}
