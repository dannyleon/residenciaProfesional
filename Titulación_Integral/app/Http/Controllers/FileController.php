<?php

namespace TitIntegral\Http\Controllers;

use Illuminate\Http\Request;
use TitIntegral\File;

class FileController extends Controller
{
    public function mostrarDocumentos()
    {
      $files = File::orderBy('created_at', 'DESC')->paginate(30);
      return view('file.mostrar', ['files' => $files]);
    }

    public function nuevoDocumento()
    {
      return view('file.subir');
    }

    public function guardarDocumento(Request $request)
    {
      $this->validate($request, [
          'file' => 'required|file|max:20000'
      ]);

      $upload = $request->file('file');
      $path = $upload->store('public/storage');
      $file = File::create([
        'titulo' => $upload->getClientOriginalName(),
        'path' => $path
      ]);

      return redirect('/file')->with('success', 'Archivo Guardado');
    }
}
