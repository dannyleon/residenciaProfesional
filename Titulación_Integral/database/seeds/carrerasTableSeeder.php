<?php

use Illuminate\Database\Seeder;

class carrerasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('carreras')->insert([

      [
        'nombre' => 'ADMINISTRACIÓN',
      ],
      [
        'nombre' => 'ARQUITECTURA',
      ],
      [
        'nombre' => 'CONTADOR PÚBLICO',
      ],
      [
        'nombre' => 'INGENIERÍA AMBIENTAL',
      ],
      [
        'nombre' => 'INGENIERÍA BIOMÉDICA',
      ],
      [
        'nombre' => 'INGENIERÍA BIOQUÍMICA',
      ],
      [
        'nombre' => 'INGENIERÍA CIVIL',
      ],
      [
        'nombre' => 'INGENIERÍA ELECTROMECÁNICA',
      ],
      [
        'nombre' => 'INGENIERÍA ELECTRÓNICA',
      ],
      [
        'nombre' => 'INGENIERÍA EN AERONÁUTICA',
      ],
      [
        'nombre' => 'INGENIERÍA EN DISEÑO INDUSTRIAL',
      ],
      [
        'nombre' => 'INGENIERÍA EN GESTIÓN EMPRESARIAL',
      ],
      [
        'nombre' => 'INGENIERÍA INFORMÁTICA',
      ],
      [
        'nombre' => 'INGENIERÍA EN LOGÍSTICA',
      ],
      [
        'nombre' => 'INGENIERÍA EN NANOTECNOLOGÍA',
      ],
      [
        'nombre' => 'INGENIERÍA EN SISTEMAS COMPUTACIONALES',
      ],
      [
        'nombre' => 'INGENIERÍA EN TECNOLOGÍAS DE LA INFORMACIÓN Y COMUNICACIONES',
      ],
      [
        'nombre' => 'INGENIERÍA INDUSTRIAL',
      ],
      [
        'nombre' => 'INGENIERÍA QUÍMICA',
      ],
      [
        'nombre' => 'INGENIERÍA MECÁNICA',
      ],

      ]);

    }
}
