<?php

namespace TitIntegral\Http\Controllers;

use Illuminate\Http\Request;
use TitIntegral\Student;
use TitIntegral\Telefono;
use TitIntegral\Carrera;
use TitIntegral\Metodo;
use TitIntegral\Seguimiento;
use TitIntegral\Estado;

class documentosController extends Controller
{

    public function prueba(Request $request, $id)
     {
        $student = Student::where('id', '=', $id)->first();
        return view('documentos.prueba2', compact('student'));


     }

}
