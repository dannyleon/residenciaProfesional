<?php

namespace TitIntegral\Http\Controllers;

use Illuminate\Http\Request;
use DB;

use TitIntegral\Student;
use TitIntegral\Telefono;
use TitIntegral\Carrera;
use TitIntegral\Metodo;
use TitIntegral\Seguimiento;
use TitIntegral\Estado;

class LiveTableSeguimiento extends Controller
{
  function index()
    {
      return view('live_table');
    }

  function fetch_data()
  {
    if($request->ajax())
      {
        // $data= DB::table('seguimientos')->orderBy('id', 'asc')->get();
        // echo json_encode($data);
        $student = Student::with('carrera','telefonos','seguimiento')->get();
        echo json_encode($student);
      }
  }
}
