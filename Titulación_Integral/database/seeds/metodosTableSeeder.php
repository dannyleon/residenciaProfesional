<?php

use Illuminate\Database\Seeder;

class metodosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('metodos')->insert([

          [
            'nombre' => 'TESINA'
          ],
          [
            'nombre' => 'TESIS'
          ],
          [
            'nombre' => 'RESIDENCIA'
          ],
          [
            'nombre' => 'CENEVAL'
          ],
          [
            'nombre' => 'INVESTIGACIÓN'
          ],
          [
            'nombre' => 'OTRO'
          ],


        ]);
    }
}
