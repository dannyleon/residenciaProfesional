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
    public function search()
    {
      $buscar = Input::get('buscar');
      if($buscar != ""){

        $student = Student::where('NoControl', '=', $buscar)->first();
        if(count($student)>0)
            //return "Lo Encontré!!!";
            return view('students.show', compact('student'));



      }
      return "No lo encontré! :(";
    }
}
