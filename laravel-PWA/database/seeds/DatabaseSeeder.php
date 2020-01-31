<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Poblando Usuario
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('rodrigo'),
        ]);

        // Poblando Departamentos
        DB::table('departamento')->insert([
            'nombre' => 'Pando',

        ]);

        DB::table('departamento')->insert([
            'nombre' => 'Beni',

        ]);

        DB::table('departamento')->insert([
            'nombre' => 'Santa Cruz',

        ]);

        DB::table('departamento')->insert([
            'nombre' => 'Cochabamba',

        ]);

        DB::table('departamento')->insert([
            'nombre' => 'Chuquisaca',

        ]);

        DB::table('departamento')->insert([
            'nombre' => 'Tarija',

        ]);

        DB::table('departamento')->insert([
            'nombre' => 'La Paz',

        ]);

        DB::table('departamento')->insert([
            'nombre' => 'Oruro',

        ]);

        DB::table('departamento')->insert([
            'nombre' => 'Potosi',

        ]);

        // Poblando Provincias
        DB::table('provincia')->insert([
            'nombre' => 'Andres Ibañez',
            'departamento_id' => 3
        ]);

        DB::table('provincia')->insert([
            'nombre' => 'Angel Sandoval',
            'departamento_id' => 3
        ]);

        DB::table('provincia')->insert([
            'nombre' => 'Chiquitos',
            'departamento_id' => 3
        ]);

        DB::table('provincia')->insert([
            'nombre' => 'Cordillera',
            'departamento_id' => 3
        ]);

        DB::table('provincia')->insert([
            'nombre' => 'Florida',
            'departamento_id' => 3
        ]);

        DB::table('provincia')->insert([
            'nombre' => 'German Busch',
            'departamento_id' => 3
        ]);

        DB::table('provincia')->insert([
            'nombre' => 'Guarayos',
            'departamento_id' => 3
        ]);

        DB::table('provincia')->insert([
            'nombre' => 'Ichilo',
            'departamento_id' => 3
        ]);

        DB::table('provincia')->insert([
            'nombre' => 'Ignacio Warnes',
            'departamento_id' => 3
        ]);

        DB::table('provincia')->insert([
            'nombre' => 'José Miguel de Velasco',
            'departamento_id' => 3
        ]);

        DB::table('provincia')->insert([
            'nombre' => 'Manuel María Caballero',
            'departamento_id' => 3
        ]);

        DB::table('provincia')->insert([
            'nombre' => 'Ñuflo de Chavez',
            'departamento_id' => 3
        ]);

        DB::table('provincia')->insert([
            'nombre' => 'Obispo Santiesteban',
            'departamento_id' => 3
        ]);

        DB::table('provincia')->insert([
            'nombre' => 'Sara',
            'departamento_id' => 3
        ]);

        DB::table('provincia')->insert([
            'nombre' => 'Vallegrande',
            'departamento_id' => 3
        ]);

        // Poblando Municipios

        DB::table('municipio')->insert([
            'nombre' => 'Santa Cruz de la Sierra',
            'provincia_id' => 1
        ]);

        DB::table('municipio')->insert([
            'nombre' => 'Cotoca',
            'provincia_id' => 1
        ]);

        DB::table('municipio')->insert([
            'nombre' => 'Porongo',
            'provincia_id' => 1
        ]);

        DB::table('municipio')->insert([
            'nombre' => 'La Guardia',
            'provincia_id' => 1
        ]);

        DB::table('municipio')->insert([
            'nombre' => 'El Torno',
            'provincia_id' => 1
        ]);

        DB::table('municipio')->insert([
            'nombre' => 'El Carmen',
            'provincia_id' => 1
        ]);

        DB::table('municipio')->insert([
            'nombre' => 'Puerto Pailas',
            'provincia_id' => 1
        ]);


        // Poblando Recintos

        DB::table('recinto')->insert([
            'nombre' => 'Col. Hnos Cavanis',
            'direccion' => 'Radial 17 1/2 entre 5to y 6to anillo.',
            'municipio_id' => 1
        ]);

        DB::table('recinto')->insert([
            'nombre' => 'Col. Henry Prince',
            'direccion' => 'Doble via la guardia 4to anillo.',
            'municipio_id' => 1
        ]);

        DB::table('recinto')->insert([
            'nombre' => 'Col. Aleman',
            'direccion' => 'Av. San Martín entre 2do y 3er anillo.',
            'municipio_id' => 1
        ]);

        DB::table('recinto')->insert([
            'nombre' => 'Col. Japones',
            'direccion' => 'Av. German Busch entre 2do y 3er anillo.',
            'municipio_id' => 1
        ]);

        DB::table('recinto')->insert([
            'nombre' => 'Col. Frances',
            'direccion' => '4to anillo y Roca y Conornado',
            'municipio_id' => 1
        ]);

        DB::table('recinto')->insert([
            'nombre' => 'Col. Caritas',
            'direccion' => 'Av. Santos Dummont 5to anillo.',
            'municipio_id' => 1
        ]);

        DB::table('recinto')->insert([
            'nombre' => 'Col. San George',
            'direccion' => 'Av. Alemana y 4to anillo.',
            'municipio_id' => 1
        ]);


        //Poblando Mesas
        for ($j = 1; $j <= 7; $j++) {
            for ($i = 1; $i <= 5; $i++) {
                DB::table('mesa')->insert([
                    'nombre' => '0' . $i,
                    'inscritos' => rand(100,200),
                    'recinto_id' => $j
                ]);
            }
        }

        //Poblando Participantes
        DB::table('partido')->insert([
            'nombre' => 'BLANCO',
            'sigla' => 'BLANCO',
            'color' => '#ffffff',
        ]);

        DB::table('partido')->insert([
            'nombre' => 'NULO',
            'sigla' => 'NULO',
            'color' => '#b0aeae',
        ]);

        DB::table('partido')->insert([
            'nombre' => 'BOLIVIA DICE NO',
            'sigla' => '21F',
            'color' => '#a40000',
        ]);

        DB::table('partido')->insert([
            'nombre' => 'COMUNIDAD CIUDADANA',
            'sigla' => 'CC',
            'color' => '#ff8000',
        ]);

        DB::table('partido')->insert([
            'nombre' => 'FRENTE PARA LA VICTORIA',
            'sigla' => 'FPV',
            'color' => '#004040',
        ]);

        DB::table('partido')->insert([
            'nombre' => 'MOVIMIENTO AL SOCIALISMO - INSTRUMENTO POLÍTICO POR LA SOBERANÍA DE LOS PUEBLOS',
            'sigla' => 'MAS-IPSP',
            'color' => '#003887',
        ]);

        DB::table('partido')->insert([
            'nombre' => 'MOVIMIENTO NACIONALISTA REVOLUCIONARIO',
            'sigla' => 'MNR',
            'color' => '#ff80c0',
        ]);

        DB::table('partido')->insert([
            'nombre' => 'MOVIMIENTO TERCER SISTEMA',
            'sigla' => 'MTS',
            'color' => '#006f37',
        ]);

        DB::table('partido')->insert([
            'nombre' => 'PARTIDO DE ACCIÓN NACIONAL BOLIVIANO',
            'sigla' => 'PAN-BOL',
            'color' => '#ff2828',
        ]);

        DB::table('partido')->insert([
            'nombre' => 'PARTIDO DEMÓCRATA CRISTIANO',
            'sigla' => 'PDC',
            'color' => '#326363',
        ]);

        DB::table('partido')->insert([
            'nombre' => 'UNIDAD CÍVICA SOLIDARIDAD',
            'sigla' => 'UCS',
            'color' => '#039efc',
        ]);



        //Poblando Elecciones

        DB::table('eleccion')->insert([
            'nombre' => 'Elecciones Presidenciales 2019',
            'fecha' => '2019-10-08',
            'estado' => 'En Proceso',
            'mesas' => '35',
            'tipo' => 'Presidencial',
        ]);

        DB::table('eleccion')->insert([
            'nombre' => 'Elecciones Municipales 2020',
            'fecha' => '2020-01-08',
            'estado' => 'En Espera',
            'mesas' => '35',
            'tipo' => 'Municipal',
        ]);

        // Poblando Participante_Eleccion
        for ($j = 1; $j <= 2; $j++) {
            for ($i = 1; $i <= 11; $i++) {
                DB::table('partido_eleccion')->insert([
                    'partido_id' => $i,
                    'eleccion_id' => $j,
                ]);
            }
        }


        // Poblando Resultados

        for ($i = 1; $i <= 35; $i++) {
            DB::table('resultado')->insert([
                'total' => rand(0,10),
                'mesa_id' => $i,
                'partido_eleccion_id' => 1,
            ]);

            DB::table('resultado')->insert([
                'total' => rand(0,10),
                'mesa_id' => $i,
                'partido_eleccion_id' => 2,
            ]);

            DB::table('resultado')->insert([
                'total' => rand(0,20),
                'mesa_id' => $i,
                'partido_eleccion_id' => 3,
            ]);

            DB::table('resultado')->insert([
                'total' => rand(0,20),
                'mesa_id' => $i,
                'partido_eleccion_id' => 4,
            ]);

            DB::table('resultado')->insert([
                'total' => rand(0,20),
                'mesa_id' => $i,
                'partido_eleccion_id' => 5,
            ]);

            DB::table('resultado')->insert([
                'total' => rand(0,10),
                'mesa_id' => $i,
                'partido_eleccion_id' => 6,
            ]);

            DB::table('resultado')->insert([
                'total' => rand(0,20),
                'mesa_id' => $i,
                'partido_eleccion_id' => 7,
            ]);

            DB::table('resultado')->insert([
                'total' => rand(0,20),
                'mesa_id' => $i,
                'partido_eleccion_id' => 8,
            ]);

            DB::table('resultado')->insert([
                'total' => rand(0,20),
                'mesa_id' => $i,
                'partido_eleccion_id' => 9,
            ]);

            DB::table('resultado')->insert([
                'total' => rand(0,20),
                'mesa_id' => $i,
                'partido_eleccion_id' => 10,
            ]);

            DB::table('resultado')->insert([
                'total' => rand(0,20),
                'mesa_id' => $i,
                'partido_eleccion_id' => 11,
            ]);
        }







    }
}
