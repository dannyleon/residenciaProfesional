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
        ->seguimiento->recibido,
        "liberación"=>$student->seguimiento->liberación,"solicitudActo"=>$student->seguimiento->solicitudActo,"actoProtocolario"=>$student->seguimiento->actoProtocolario];
        echo json_encode($seguimiento);

        // $html =
        //       '<tr>
        //          <td>' . $student->seguimiento->autRegistro . '</td>' .
        //          '<td>' . $student->seguimiento->recibido . '</td>' .
        //          '<td>' . $student->seguimiento->liberación . '</td>' .
        //          '<td>' . $student->seguimiento->solicitudActo . '</td>' .
        //          '<td>' . $student->seguimiento->actoProtocolario . '</td>' .
        //       '</tr>';
        //
        // return $html;

      }


      }

      public function update_data(Request $request)
      {
        if($request->ajax())
        {

          // $seguimiento = ["autRegistro" => $request->autRegistro, "recibido" => $request->recibido,
          // "liberación"=>$request->liberación,"solicitudActo"=>$request->solicitudActo,"actoProtocolario"=>$request->actoProtocolario];

          //$student = Student::where('id', '=', $request->id)->first();

        $seguimiento = Seguimiento::where('id',$request->id)
          ->update(["autRegistro" => $request->autRegistro, "recibido" => $request->recibido,
          "liberación"=>$request->liberación,"solicitudActo"=>$request->solicitudActo,"actoProtocolario"=>$request->actoProtocolario]);
          

          echo '<div class="alert alert-succes">Data Updated</div>';

          // DB::table('students')
          // ->where('id',$request->id)
          // ->update($data);
          // echo '<div class="alert alert-succes">Data Updated</div>';

        }
      }

}
