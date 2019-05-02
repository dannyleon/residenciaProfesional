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

        $students = Student::where('PeriodoTitulación','=',$request->periodoTIT)
        ->where('AñoTitulación','=',$request->añoTIT)
        ->with('carrera')
        ->with('seguimiento.metodo')
        ->get();

        $sortedStudents = $students->sortBy('Carrera_id')->values();
        return Response($sortedStudents);

       }

     }
}
