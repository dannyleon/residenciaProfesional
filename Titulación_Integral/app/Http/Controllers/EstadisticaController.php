<?php

namespace TitIntegral\Http\Controllers;

use Illuminate\Http\Request;
use TitIntegral\Student;
use TitIntegral\Telefono;
use TitIntegral\Carrera;
use TitIntegral\Metodo;
use TitIntegral\Seguimiento;
use TitIntegral\Estado;

class EstadisticaController extends Controller
{
    public function view(Request $request)
    {
      return view("estadisticas.show");
    }

    public function search(Request $request)
    {
      if($request->ajax())
      {

        $output="";
        $students = Student::where('PeriodoTitulación','=',$request->periodoTIT)
        ->where('AñoTitulación','=',$request->añoTIT)
        ->get();

        if($students)
        {
          foreach ($students as $key => $student)
          {
            $output.='<tr>'.
            '<td>'.$student->NoControl.'</td>'.
            '<td>'.$student->Apellidos.'</td>'.
            '<td>'.$student->Nombre.'</td>'.
            '<td>'.$student->PeriodoIngreso.'</td>'.
            '<td>'.$student->AñoIngreso.'</td>'.
            '<td>'.$student->seguimiento->metodo->nombre.'</td>'.
            '<td>'.$student->PeriodoTitulación.'</td>'.
            '<td>'.$student->AñoTitulación.'</td>'.
            '<td>'.$student->seguimiento->actoProtocolario.'</td>'.
            '<td>'.$student->SemestresCursados.'</td>'.
            '</tr>';
          }
          return Response($output);
         }
       }
     }
}
