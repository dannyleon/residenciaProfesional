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
use TitIntegral\File;

class searchController extends Controller
{

    public function buscar()
    {
      $q = Input::get ( 'q' );

      $student = Student::where('NoControl','LIKE','%'.$q.'%')->orWhere('Apellidos','LIKE','%'.$q.'%')->first();

      $files = File::orderBy('titulo', 'ASC')->paginate(30);


      if(count($student) > 0)

          return view('students.show', compact('student'))->with(['files' => $files]);
          //return view('students.show')->withDetails($student)->withQuery ( $q );
          else return redirect()->back()->with('alert', 'No se encuentra');
          // return redirect()->back()->with('alert', 'Deleted!');


      //else return view ('welcome')->withMessage('No Details found. Try to search again !');
    }

}
