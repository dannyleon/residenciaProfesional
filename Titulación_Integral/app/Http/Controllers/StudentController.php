<?php

namespace TitIntegral\Http\Controllers;

use TitIntegral\Student;
use TitIntegral\Telefono;
use TitIntegral\Carrera;
use TitIntegral\Metodo;
use TitIntegral\Seguimiento;
use TitIntegral\Estado;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //return view('students.index');
      $student = Student::with('carrera','telefonos','seguimiento')->get();

      return view("students.index", compact('student'));

      // return redirect()->route('students.index', compact('student'))->with('success');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $carrera = Carrera::pluck('nombre','id');
        $metodo = Metodo::pluck('nombre','id');

        return view('students.create', compact('carrera','metodo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //Validación de datos
        $validatedData = $request->validate([
        'numeroControl' => 'required|digits_between:1,10',
        'nombre' => 'required|max:191',
        'apellido' => 'required|max:191',
        'correo' => 'required|max:191',
        'carrera' => 'required',
        'añoIngreso' => 'required|numeric|digits:4',
        'periodoIngreso' => 'required|numeric|digits:1',
        'sexo' => 'required|max:191',
        'tel1' => 'required|max:191',
        'tel2' => 'max:191',
        'tel3' => 'max:191',
        'metodo' => 'required',
        'autoResgistro' => 'required',
        'recibido' => 'required',
         ]);

        //Guardar tabla students
        $student = new Student();

        $student->NoControl = $request->input('numeroControl');
        $student->Nombre = $request->input('nombre');
        $student->Apellidos = $request->input('apellido');
        $student->Correo = $request->input('correo');
        $student->Carrera_id = $request->input('carrera');
        $student->AñoIngreso = $request->input('añoIngreso');
        $student->PeriodoIngreso = $request->input('periodoIngreso');
        $student->Sexo = $request->input('sexo');

        $student->save();

        //Guardar tabla telefonos
        if($request->input('tel1')){
          $phone = new Telefono();
          $phone->student_id = $student->id;
          $phone->numeroTel = $request->input('tel1');
          $phone->save();
        }
        else {
          $phone = new Telefono();
          $phone->student_id = $student->id;
          $phone->numeroTel = "";
          $phone->save();
        }


        if($request->input('tel2')){
          $phone = new Telefono();
          $phone->student_id = $student->id;
          $phone->numeroTel = $request->input('tel2');
          $phone->save();
        }
        else {
          $phone = new Telefono();
          $phone->student_id = $student->id;
          $phone->numeroTel = "";
          $phone->save();
        }


        if($request->input('tel3')){
          $phone = new Telefono();
          $phone->student_id = $student->id;
          $phone->numeroTel = $request->input('tel3');
          $phone->save();
        }
        else {
          $phone = new Telefono();
          $phone->student_id = $student->id;
          $phone->numeroTel = "";
          $phone->save();
        }


        //Guardar tabla seguimientos
        $seguimiento = new Seguimiento();

        $seguimiento->metodo_id = $request->input('metodo');
        $seguimiento->autRegistro = $request->input('autoResgistro');
        $seguimiento->recibido = $request->input('recibido');
        $seguimiento->student_id = $student->id;
        $seguimiento->observaciones = '';

        $seguimiento->save();

        return redirect()->route('students.show', compact('student'))->with('success','Alumno Añadido');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Student $student)
    {
      //  $student = Student::where('NoControl', $NoControl )->firstOrFail();
      return view('students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        //$student = Student::where('NoControl', $NoControl )->firstOrFail();
        $carrera = Carrera::pluck('nombre','id');
        $metodo = Metodo::pluck('nombre','id');

        return view('students.edit', compact('student','carrera','metodo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
      //Validación de datos
      $validatedData = $request->validate([
      'numeroControl' => 'required|digits_between:1,10',
      'nombre' => 'required|max:191',
      'apellido' => 'required|max:191',
      'correo' => 'required|max:191',
      'carrera' => 'required',
      'añoIngreso' => 'required|numeric|digits:4',
      'periodoIngreso' => 'required|numeric|digits:1',
      'sexo' => 'required|max:191',
      'tel1' => 'required|max:191',
      'tel2' => 'max:191',
      'tel3' => 'max:191',
      'metodo' => 'required',
      'autoResgistro' => 'required',
      'recibido' => 'required',
       ]);

      //Actualización de datos del Estudiante
      $periodoActual = $student->PeriodoIngreso;

      $student->NoControl = $request->input('numeroControl');
      $student->Nombre = $request->input('nombre');
      $student->Apellidos = $request->input('apellido');
      $student->Correo = $request->input('correo');
      $student->Carrera_id = $request->input('carrera');
      $student->AñoIngreso = $request->input('añoIngreso');
      $student->PeriodoIngreso = $request->input('periodoIngreso');
      $student->Sexo = $request->input('sexo');

      $student->save();

      //Actualización de telefonos del Estudiante
      $phone_id=  $student->telefonos[0]->idTelefono;
      $phone = Telefono::where('idTelefono',$phone_id)
      ->update([
        'numeroTel'=>$request->input('tel1')
      ]);


      if($request->input('tel2')){

        $phone_id=  $student->telefonos[1]->idTelefono;
        $phone = Telefono::where('idTelefono',$phone_id)
        ->update([

          'numeroTel'=>$request->input('tel2')
        ]);
      }
      else {

        $phone_id=  $student->telefonos[1]->idTelefono;
        $phone = Telefono::where('idTelefono',$phone_id)
        ->update([

          'numeroTel'=> ''
        ]);
      }

      if($request->input('tel3')){

        $phone_id=  $student->telefonos[2]->idTelefono;
        $phone = Telefono::where('idTelefono',$phone_id)
        ->update([
          'numeroTel'=>$request->input('tel3')
        ]);
      }
      else {
        $phone_id=  $student->telefonos[2]->idTelefono;
        $phone = Telefono::where('idTelefono',$phone_id)
        ->update([
          'numeroTel'=> ''
        ]);
      }


      $seguimiento = Seguimiento::where('id',$student->id)
      ->update([
        'metodo_id'=>$request->input('metodo'),
        'autRegistro'=>$request->input('autoResgistro'),
        'recibido'=>$request->input('recibido')
      ]);

      if( $periodoActual != $request->input('periodoIngreso')){

        return $this->calculoSemestres($student->id);

        }
      return redirect()->route("students.show",$student)->with('success','Alumno Modificado');


    }

    public function calculoSemestres($id)
    {
      //Cálculo de semestres Cursados
      $student = Student::where('id',$id)->first();
      $AT = $student->AñoTitulación;
      $AI = $student->AñoIngreso;
      $PT = $student->PeriodoTitulación;
      $PI = $student->PeriodoIngreso;

      $semestresTotales = ($AT-$AI) * 2;
      $periodo = ($PI-$PT);


      if($periodo == 1) {
        $student->SemestresCursados = $semestresTotales;
      }
      elseif ($periodo == 0) {
        $student->SemestresCursados = $semestresTotales + 1;
      }else {
        $student->SemestresCursados = $semestresTotales + 2;
      }

      $student->save();
      return redirect()->route("students.show",$student)->with('success','Alumno Modificado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route("students.index")->with('eliminado','Alumno Eliminado');
    }
}
