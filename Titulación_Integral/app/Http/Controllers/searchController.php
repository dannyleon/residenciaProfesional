<?php

namespace TitIntegral\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use TitIntegral\Student;
use TitIntegral\Telefono;
use TitIntegral\Carrera;
use TitIntegral\Metodo;
use TitIntegral\Seguimiento;
use TitIntegral\Estado;

class searchController extends Controller
{

    public function buscar()
    {
      $q = Input::get ( 'q' );
      $student = Student::where('NoControl','LIKE','%'.$q.'%')->orWhere('Apellidos','LIKE','%'.$q.'%')->first();
      if(count($student) > 0)
          return view('students.show', compact('student'));
          //return view('students.show')->withDetails($student)->withQuery ( $q );
          else return "No lo encontré! :(";

      //else return view ('welcome')->withMessage('No Details found. Try to search again !');
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
