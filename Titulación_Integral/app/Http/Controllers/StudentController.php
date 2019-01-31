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
        //return $request;

        $student = new Student();

        $student->NoControl = $request->input('numeroControl');
        $student->Nombre = $request->input('nombre');
        $student->Apellidos = $request->input('apellido');
        $student->Correo = $request->input('correo');
        $student->Carrera_id = $request->input('carrera');
        $student->AñoIngreso = $request->input('añoIngreso');
        $student->PeriodoIngreso = $request->input('periodoIngreso');
        $student->AñoTitulación = 0;
        $student->PeriodoTitulación = 0;
        $student->Sexo = $request->input('sexo');

        $student->save();

        $phone = new Telefono();

        $phone->student_id = $student->id;
        $phone->numeroTel = $request->input('tel1');
        $phone->save();

        $phone = new Telefono();

        $phone->student_id = $student->id;
        $phone->numeroTel = $request->input('tel2');
        $phone->save();

        $phone = new Telefono();

        $phone->student_id = $student->id;
        $phone->numeroTel = $request->input('tel3');
        $phone->save();

        $seguimiento = new Seguimiento();

        $seguimiento->metodo_id = $request->input('metodo');
        $seguimiento->autRegistro = $request->input('autoResgistro');
        $seguimiento->recibido = $request->input('recibido');
        $seguimiento->liberación = null;
        $seguimiento->solicitudActo = null;
        $seguimiento->actoProtocolario = null;
        $seguimiento->status_id = 1;
        $seguimiento->student_id = $student->id;
        $seguimiento->observaciones = '';


        $seguimiento->save();


        return redirect()->route('students.index')->with('success','Alumno Añadido');

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

      //Actualización de datos del Estudiante
      $student->NoControl = $request->input('numeroControl');
      $student->Nombre = $request->input('nombre');
      $student->Apellidos = $request->input('apellido');
      $student->Correo = $request->input('correo');
      $student->Carrera_id = $request->input('carrera');
      $student->AñoIngreso = $request->input('añoIngreso');
      $student->PeriodoIngreso = $request->input('periodoIngreso');
      $student->AñoTitulación = 0;
      $student->PeriodoTitulación = 0;
      $student->Sexo = $request->input('sexo');

      $student->save();

      //Actualización de telefonos del Estudiante
      $phone_id=  $student->telefonos[0]->idTelefono;
      $phone = Telefono::where('idTelefono',$phone_id)
      ->update([
        'numeroTel'=>$request->input('tel1')
      ]);

      $phone_id=  $student->telefonos[1]->idTelefono;
      $phone = Telefono::where('idTelefono',$phone_id)
      ->update([
        'numeroTel'=>$request->input('tel2')
      ]);

      $phone_id=  $student->telefonos[2]->idTelefono;
      $phone = Telefono::where('idTelefono',$phone_id)
      ->update([
        'numeroTel'=>$request->input('tel3')
      ]);


      $seguimiento = Seguimiento::where('id',$student->id)
      ->update([
        'metodo_id'=>$request->input('metodo'),
        'autRegistro'=>$request->input('autoResgistro'),
        'recibido'=>$request->input('recibido')
      ]);

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
