<?php

namespace TitIntegral\Http\Controllers;
use TitIntegral\Student;
use TitIntegral\Telefono;
use TitIntegral\Carrera;
use TitIntegral\Metodo;
use TitIntegral\Seguimiento;
use TitIntegral\Estado;
use Carbon\Carbon;

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
        ->seguimiento->recibido, "liberación"=>$student->seguimiento->liberación,"solicitudActo"=>$student->seguimiento->solicitudActo,"actoProtocolario"=>$student->seguimiento->actoProtocolario,
        "añoTitulación"=>$student->AñoTitulación, "PeriodoTitulación"=>$student->PeriodoTitulación,


         "status"=>$student->seguimiento->status->nombre, "observaciones"=>$student->seguimiento->observaciones];

        echo json_encode($seguimiento);
      }

    }

      public function update_data(Request $request)
      {
        if($request->ajax())
        {

          if($request->observaciones == "")
          {
            $seguimiento = Seguimiento::where('id',$request->id)
            ->update(["autRegistro" => $request->autRegistro, "recibido" => $request->recibido,
            "liberación"=>$request->liberación,
            "solicitudActo"=>$request->solicitudActo,"actoProtocolario"=>$request->actoProtocolario,
            "observaciones"=> ""]);
          }else {
              $seguimiento = Seguimiento::where('id',$request->id)
              ->update(["autRegistro" => $request->autRegistro, "recibido" => $request->recibido,
              "liberación"=>$request->liberación,
              "solicitudActo"=>$request->solicitudActo,"actoProtocolario"=>$request->actoProtocolario,
              "observaciones"=>$request->observaciones]);
          }


          $seguimiento = Seguimiento::where('id',$request->id)->first();
          $student = Student::where('id',$request->id)->first();

          if($seguimiento->actoProtocolario != null && $student->AñoIngreso != 0)
          {
            $fecha = new Carbon($seguimiento->actoProtocolario);
            $fecha->year;
            $fecha->month;

            if($fecha->month == '1'|| $fecha->month == '2' || $fecha->month == '3'|| $fecha->month == '4'|| $fecha->month == '5'|| $fecha->month == '6' )
            {
              $student = Student::where('id',$request->id)
              ->update(["AñoTitulación"=> $fecha->year, "PeriodoTitulación" => 1]);

              $seguimiento = Seguimiento::where('id',$request->id)
              ->update(["status_id" => 2]);

            }
            else
            {

              $student = Student::where('id',$request->id)
              ->update(["AñoTitulación"=> $fecha->year, "PeriodoTitulación" => 2]);

              $seguimiento = Seguimiento::where('id',$request->id)
              ->update(["status_id" => 2]);

            }

            echo 'Información Actualizada';
          }

          else
          {
            $seguimiento = Seguimiento::where('id',$request->id)
            ->update(["status_id" => 1]);

            $student = Student::where('id', $request->id)
            ->update(["AñoTitulación" => 0, "PeriodoTitulación" => 0]);

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
