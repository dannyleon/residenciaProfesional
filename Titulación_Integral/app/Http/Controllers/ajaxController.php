<?php

namespace TitIntegral\Http\Controllers;
use TitIntegral\Student;
use TitIntegral\Telefono;
use TitIntegral\Carrera;
use TitIntegral\Metodo;
use TitIntegral\Seguimiento;
use TitIntegral\Estado;

use Illuminate\Http\Request;

class ajaxController extends Controller
{

    public function fetch_data(Request $request)
    {
      if ($request->ajax())
      {
        $id = $_GET['id'];
        $student = Student::where('id', '=', $id)->first();

        $seguimiento = ["autRegistro" => $student->seguimiento->autRegistro, "recibido" => $student
        ->seguimiento->recibido, "liberación"=>$student->seguimiento->liberación,"solicitudActo"=>$student->seguimiento->solicitudActo,"actoProtocolario"=>$student->seguimiento->actoProtocolario];
        echo json_encode($seguimiento);
      }
    }

      public function update_data(Request $request)
      {
        if($request->ajax())
        {
          $seguimiento = Seguimiento::where('id',$request->id)
          ->update(["autRegistro" => $request->autRegistro, "recibido" => $request->recibido,
          "liberación"=>$request->liberación,
          "solicitudActo"=>$request->solicitudActo,"actoProtocolario"=>$request->actoProtocolario]);

          echo 'Información Actualizada';

        }
      }

}
