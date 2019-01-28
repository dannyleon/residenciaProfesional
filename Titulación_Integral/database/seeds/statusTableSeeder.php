<?php

use Illuminate\Database\Seeder;

class statusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('status')->insert([
     'nombre' => 'En espera de solicitud y liberación (Alumno)',
      ]);
      DB::table('status')->insert([
     'nombre' => 'Entregar oficio No Inconveniente para trámite',
      ]);
      DB::table('status')->insert([
     'nombre' => 'En espera de oficio No inconveniente para Acto Protocolario',
      ]);
      DB::table('status')->insert([
     'nombre' => 'Solicitar a la academia fecha para acto',
      ]);
      DB::table('status')->insert([
     'nombre' => 'En espera de fecha para acto',
      ]);
      DB::table('status')->insert([
     'nombre' => 'Notificación de fecha de Titulación Integral',
      ]);
      DB::table('status')->insert([
     'nombre' => 'En espera de firma (Alumno)',
      ]);
      DB::table('status')->insert([
     'nombre' => 'Realizar protesto',
      ]);
      DB::table('status')->insert([
     'nombre' => 'Alumno Titulado',
      ]);
    }
}
