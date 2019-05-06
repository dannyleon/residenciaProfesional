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
      $carrera = Carrera::pluck('nombre','id');
      $metodo = Metodo::pluck('nombre','id');

      return view("estadisticas.show", compact('carrera','metodo'));
    }

    public function search(Request $request)
    {
      if($request->ajax())
      {


        //Si es año completo y todas las carreras
        if($request->periodoTIT == '3' && $request->carrera == '0' ){

          $students = Student::where('AñoTitulación','=',$request->añoTIT)
          ->with('carrera')
          ->with('seguimiento.metodo')
          ->get();

          $sortedStudents = $students->sortBy('Carrera_id')->values();
          return Response($sortedStudents);


          //Si es por periodos y todas las carreras
        }elseif ($request->periodoTIT != '3' && $request->carrera == '0'){

          $students = Student::where('PeriodoTitulación','=',$request->periodoTIT)
          ->where('AñoTitulación','=',$request->añoTIT)
          ->with('carrera')
          ->with('seguimiento.metodo')
          ->get();

          $sortedStudents = $students->sortBy('Carrera_id')->values();
          return Response($sortedStudents);



            //Si es año completo y carrera especifica
        }elseif ($request->periodoTIT == 3 && $request->carrera != 0) {

          $students = Student::where('AñoTitulación','=',$request->añoTIT)
          ->where('Carrera_id','=',$request->carrera)
          ->with('carrera')
          ->with('seguimiento.metodo')
          ->get();

          $sortedStudents = $students->sortBy('Carrera_id')->values();
          return Response($sortedStudents);

        }//Si por periodos y carrera especifica
        else {

          $students = Student::where('PeriodoTitulación','=',$request->periodoTIT)
          ->where('AñoTitulación','=',$request->añoTIT)
          ->where('Carrera_id','=',$request->carrera)
          ->with('carrera')
          ->with('seguimiento.metodo')
          ->get();

          $sortedStudents = $students->sortBy('Carrera_id')->values();
          return Response($sortedStudents);

        }


       }

     }
}
