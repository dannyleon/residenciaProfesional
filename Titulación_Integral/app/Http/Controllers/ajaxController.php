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
        ->seguimiento->recibido, "liberación"=>$student->seguimiento->liberación,"solicitudActo"=>$student->seguimiento->solicitudActo,"actoProtocolario"=>$student->seguimiento->actoProtocolario, "status"=>$student->seguimiento->status->nombre, "observaciones"=>$student->seguimiento->observaciones];

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
          "solicitudActo"=>$request->solicitudActo,"actoProtocolario"=>$request->actoProtocolario,
          "observaciones"=>$request->observaciones]);



          $seguimiento = Seguimiento::where('id',$request->id)->first();

          if($seguimiento->actoProtocolario != null)
          {
            $seguimiento = Seguimiento::where('id',$request->id)
            ->update(["status_id" => 2]);

            echo 'Información Actualizada';
          }
          else {
            $seguimiento = Seguimiento::where('id',$request->id)
            ->update(["status_id" => 1]);
            echo 'Información Actualizada';
          }

        }

      }

      public function delete_data(Request $request)
      {
        if($request->ajax())
        {
          $student = Student::where('id',$request->id)->delete();
        }

      }


}
