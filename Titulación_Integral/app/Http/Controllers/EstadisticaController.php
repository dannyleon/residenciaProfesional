<?php

namespace TitIntegral\Http\Controllers;

use Illuminate\Http\Request;
use TitIntegral\Student;
use TitIntegral\Telefono;
use TitIntegral\Carrera;
use TitIntegral\Metodo;
use TitIntegral\Seguimiento;
use TitIntegral\Estado;

use Maatwebsite\Excel\Facades\Excel;
use TitIntegral\Exports\StudentExport;

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

    public function datosGrafica (Request $request)
    {
        $arreglo_Carreras = array();
        $arreglo_Cantidad_Titulados = array();
        $carreras = $this->obtenerCarreras();

        //Agrega cada nombre de carrera por separado a un arreglo y el numero de titulados por carrera a otro arreglo
        foreach($carreras as $carrera) {
          $numero_titulados_por_año = $this->contarTitulados($carrera->id,$request);
          array_push( $arreglo_Cantidad_Titulados, $numero_titulados_por_año );
          array_push( $arreglo_Carreras, $carrera->nombre );
        }

        $numero_maximo = max($arreglo_Cantidad_Titulados);
        $max = round(($numero_maximo + 10/2)/10) *10;

        $datos_para_grafica = array(
          'carreras' => $arreglo_Carreras,
          'cantidadTitulados' => $arreglo_Cantidad_Titulados,
          'max' => $max,

        );

        return $datos_para_grafica;
    }

    //Cuenta el total de titulados por carrera
    function contarTitulados($idCarrera, $request) {

      //Si la consulta es por año completo
      if($request->periodoTIT == '3'){
        $numero_titulados_por_carrera = Student::where( 'AñoTitulación', '=' ,$request->añoTIT )
        ->where( 'Carrera_id', '=', $idCarrera )->get()->count();

        return $numero_titulados_por_carrera;
      }
      //Si la consulta es por periodo
      else {
        $numero_titulados_por_carrera = Student::where( 'AñoTitulación', '=' ,$request->añoTIT )
        ->where('PeriodoTitulación','=',$request->periodoTIT)
        ->where( 'Carrera_id', '=', $idCarrera )->get()->count();
        return $numero_titulados_por_carrera;
      }

    }

    //Obtiene el nombre de todas las carreras
    function obtenerCarreras () {
      $carreras = Carrera::all();
      return $carreras;
    }

}
