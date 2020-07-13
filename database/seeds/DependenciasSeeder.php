<?php

use Illuminate\Database\Seeder;

class DependenciasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\dependencia::create([
            'id' => '1',
            'nombre' => 'Asesor de Control Interno de Gestión',
            'fecha_creacion' => now(),
            'fecha_edicion' => now(),
            'responsable' => 'Dr. Alvaro Becerra Florez',
            'correo_responsable' => 'cinterno@herasmomeoz.gov.co'
        ]);

        App\dependencia::create([
            'id' => '2',
            'nombre' => 'Asesor de Planeación y Calidad',
            'fecha_creacion' => now(),
            'fecha_edicion' => now(),
            'responsable' => 'Dr. Soraya Tatiana Cáceres Santos',
            'correo_responsable' => 'planeacion@herasmomeoz.gov.co',

        ]);

        App\dependencia::create([
            'id' => '3',
            'nombre' => 'Asesor Jurídico Laboral',
            'fecha_creacion' => now(),
            'fecha_edicion' => now(),
            'responsable' => 'Dr. Oscar Vergel Canal',
            'correo_responsable' => 'juridicaadm@herasmomeoz.gov.co',

        ]);

        App\dependencia::create([
            'id' => '4',
            'nombre' => 'Banco de Sangre',
            'fecha_creacion' => now(),
            'fecha_edicion' => now(),
            'responsable' => 'Dra. Elsie Entrena Mutis',
            'correo_responsable' => 'bancodesangre@herasmomeoz.gov.co',

        ]);

        App\dependencia::create([
            'id' => '5',
            'nombre' => 'Cirugia de Mano',
            'fecha_creacion' => now(),
            'fecha_edicion' => now(),
            'responsable' => 'Dr. Luis Ignacio Bravo T',
            'correo_responsable' => 'No email',

        ]);

        App\dependencia::create([
            'id' => '6',
            'nombre' => 'Cirugía de Toráx',
            'fecha_creacion' => now(),
            'fecha_edicion' => now(),
            'responsable' => 'Dr. Marcel Leonardo Quintero C.',
            'correo_responsable' => 'No email'

        ]);

        App\dependencia::create([
            'id' => '7',
            'nombre' => 'Cirugía General',
            'fecha_creacion' => now(),
            'fecha_edicion' => now(),
            'responsable' => 'Dr. Guillermo Leon Labrador Rincón',
            'correo_responsable' => 'cirugiageneral@herasmomeoz.gov.co',

        ]);

        App\dependencia::create([
            'id' => '8',
            'nombre' => 'Cirugía Pediátrica',
            'fecha_creacion' => now(),
            'fecha_edicion' => now(),
            'responsable' => 'Dr. Santiago Rodriguez García',
            'correo_responsable' => 'pediatria.auxiliar@herasmomeoz.gov.co',

        ]);

        App\dependencia::create([
            'id' => '9',
            'nombre' => 'Cirugía Plástica',
            'fecha_creacion' => now(),
            'fecha_edicion' => now(),
            'responsable' => 'Dr. Claudia Cecilia Pérez Chacón',
            'correo_responsable' => 'cxplastica@herasmomeoz.gov.co',

        ]);

        App\dependencia::create([
            'id' => '10',
            'nombre' => 'Coordinación de Enfermería',
            'fecha_creacion' => now(),
            'fecha_edicion' => now(),
            'responsable' => 'Lic. Yeni Peña Guerrrero',
            'correo_responsable' => 'No email',

        ]);

        App\dependencia::create([
            'id' => '11',
            'nombre' => 'Cx. Vascular',
            'fecha_creacion' => now(),
            'fecha_edicion' => now(),
            'responsable' => 'Dr. Juan Arturo Sanjuan Sanguino',
            'correo_responsable' => 'No email',

        ]);

        App\dependencia::create([
            'id' => '12',
            'nombre' => 'Docencia',
            'fecha_creacion' => now(),
            'fecha_edicion' => now(),
            'responsable' => 'Dra. Franci Yinid Archila Florez',
            'correo_responsable' => 'docencia@herasmomeoz.gov.co',

        ]);

        App\dependencia::create([
            'id' => '13',
            'nombre' => 'Epidemiologia',
            'fecha_creacion' => now(),
            'fecha_edicion' => now(),
            'responsable' => 'Enfermera Jefe.Haydee Soto Castro',
            'correo_responsable' => 'epidemiologia@herasmomeoz.gov.co',

        ]);

        App\dependencia::create([
            'id' => '14',
            'nombre' => 'Estadística',
            'fecha_creacion' => now(),
            'fecha_edicion' => now(),
            'responsable' => 'Ing. Andrea zulay Medina Jaimes',
            'correo_responsable' => 'estadistica.ingeniero@herasmomeoz.gov.co',

        ]);

        App\dependencia::create([
            'id' => '15',
            'nombre' => 'Ginecología',
            'fecha_creacion' => now(),
            'fecha_edicion' => now(),
            'responsable' => 'Enfermero Jefe Norberto García Romero',
            'correo_responsable' => 'ginecologia@herasmomeoz.gov.co'
        ]);

        App\dependencia::create([
            'id' => '16',
            'nombre' => 'Jefe Contabilidad',
            'fecha_creacion' => now(),
            'fecha_edicion' => now(),
            'responsable' => 'Dra. Sandra Pérez Prato',
            'correo_responsable' => 'contabilidad@herasmomeoz.gov.co'

        ]);

        App\dependencia::create([
            'id' => '17',
            'nombre' => 'Jefe de Presupuesto',
            'fecha_creacion' => now(),
            'fecha_edicion' => now(),
            'responsable' => 'Dra. Martha Rodriguez Perez',
            'correo_responsable' => 'presupuesto@herasmomeoz.gov.co',

        ]);

        App\dependencia::create([
            'id' => '18',
            'nombre' => 'Jefe de Facturación',
            'fecha_creacion' => now(),
            'fecha_edicion' => now(),
            'responsable' => 'Sr. Ricardo Celis Araque',
            'correo_responsable' => 'jefatura.auditoria@herasmomeoz.gov.co',

        ]);

        App\dependencia::create([
            'id' => '19',
            'nombre' => 'Jefe Tesorería',
            'fecha_creacion' => now(),
            'fecha_edicion' => now(),
            'responsable' => 'Dra. Beatriz Parra Solano',
            'correo_responsable' => 'tesoreria@herasmomeoz.gov.co',

        ]);

        App\dependencia::create([
            'id' => '20',
            'nombre' => 'Líder de Programa Apoyo a la Atención',
            'fecha_creacion' => now(),
            'fecha_edicion' => now(),
            'responsable' => 'Enfermera Jefe. Gloria león Mejía',
            'correo_responsable' => 'apoyodx@herasmomeoz.gov.co',

        ]);

        App\dependencia::create([
            'id' => '21',
            'nombre' => 'Líder de Programa Recursos Financieros',
            'fecha_creacion' => now(),
            'fecha_edicion' => now(),
            'responsable' => 'Dr. Libardo Duarte Toscano',
            'correo_responsable' => 'financiera@herasmomeoz.gov.co',

        ]);

        App\dependencia::create([
            'id' => '22',
            'nombre' => 'Líder de Programa Servicios Ambulatorios',
            'fecha_creacion' => now(),
            'fecha_edicion' => now(),
            'responsable' => 'Dr. Andrés Eloy Galvis Jaimes',
            'correo_responsable' => 'ambulatorios@herasmomeoz.gov.co',

        ]);

        App\dependencia::create([
            'id' => '23',
            'nombre' => 'Líder de Programa Talento Humano',
            'fecha_creacion' => now(),
            'fecha_edicion' => now(),
            'responsable' => 'Dr. Marco Antonio Navarro Palacios',
            'correo_responsable' => 'talentohum@herasmomeoz.gov.co',

        ]);

        App\dependencia::create([
            'id' => '24',
            'nombre' => 'Maxilofacial',
            'fecha_creacion' => now(),
            'fecha_edicion' => now(),
            'responsable' => 'Dr. Pedro Antonio Amado Montoya',
            'correo_responsable' => 'No email'

        ]);

        App\dependencia::create([
            'id' => '25',
            'nombre' => 'Neurocirugía',
            'fecha_creacion' => now(),
            'fecha_edicion' => now(),
            'responsable' => 'Dr. Marco Oliverio Fonseca Gonzalez',
            'correo_responsable' => 'neurocirugia@herasmomeoz.gov.co',

        ]);

        App\dependencia::create([
            'id' => '26',
            'nombre' => 'Oftalmología',
            'fecha_creacion' => now(),
            'fecha_edicion' => now(),
            'responsable' => 'Dr. León Ulises Colmenares',
            'correo_responsable' => 'No email',

        ]);


        App\dependencia::create([
            'id' => '27',
            'nombre' => 'Oncología Pediátrica',
            'fecha_creacion' => now(),
            'fecha_edicion' => now(),
            'responsable' => 'Dr. Esteban Francisco Hernández Flórez',
            'correo_responsable' => 'No email',

        ]);

        App\dependencia::create([
            'id' => '28',
            'nombre' => 'Ortopedia y Traumatología',
            'fecha_creacion' => now(),
            'fecha_edicion' => now(),
            'responsable' => 'Dr. Daniel Fernando Terán Chamorro',
            'correo_responsable' => 'No email',

        ]);

        App\dependencia::create([
            'id' => '29',
            'nombre' => 'Rehabilitación',
            'fecha_creacion' => now(),
            'fecha_edicion' => now(),
            'responsable' => 'Dra. Consuelo Jabba Di Geronimo',
            'correo_responsable' => 'rehabilitacion@herasmomeoz.gov.co',

        ]);

        App\dependencia::create([
            'id' => '30',
            'nombre' => 'Servicio Consulta Externa',
            'fecha_creacion' => now(),
            'fecha_edicion' => now(),
            'responsable' => 'Jefe. Siaolis Patricia Castro',
            'correo_responsable' => 'cexterna@herasmomeoz.gov.co',

        ]);

        App\dependencia::create([
            'id' => '31',
            'nombre' => 'Servicios Urgencias',
            'fecha_creacion' => now(),
            'fecha_edicion' => now(),
            'responsable' => 'Dr. Roberto Jose Claro Jure',
            'correo_responsable' => 'financiera@herasmomeoz.gov.co',

        ]);

        App\dependencia::create([
            'id' => '32',
            'nombre' => 'SIAU',
            'fecha_creacion' => now(),
            'fecha_edicion' => now(),
            'responsable' => 'Dr. Jorge Fossi Becerra',
            'correo_responsable' => 'siau@herasmomeoz.gov.co',

        ]);

        App\dependencia::create([
            'id' => '33',
            'nombre' => 'Sistemas',
            'fecha_creacion' => now(),
            'fecha_edicion' => now(),
            'responsable' => 'Ing. Lucas Liendo Romero',
            'correo_responsable' => 'sistemas@herasmomeoz.gov.co',

        ]);

        App\dependencia::create([
            'id' => '34',
            'nombre' => 'Subgerente Administrativo',
            'fecha_creacion' => now(),
            'fecha_edicion' => now(),
            'responsable' => 'Dr. Luis Alberto Díaz Pérez',
            'correo_responsable' => 'Subgerencia@herasmomeoz.gov.co',

        ]);

        App\dependencia::create([
            'id' => '35',
            'nombre' => 'Subgerente de Servicios de Salud',
            'fecha_creacion' => now(),
            'fecha_edicion' => now(),
            'responsable' => 'Dra. Ana María Pérez Ramírez',
            'correo_responsable' => 'ssalud@herasmomeoz.gov.co',

        ]);

        App\dependencia::create([
            'id' => '36',
            'nombre' => 'Urología',
            'fecha_creacion' => now(),
            'fecha_edicion' => now(),
            'responsable' => 'Dr. Luis Alberto Lobo Jácome',
            'correo_responsable' => 'No email',

        ]);

    }
}
