<?php

namespace TitIntegral\Http\Controllers;

use Illuminate\Http\Request;
use TitIntegral\File;
use Illuminate\Support\Facades\Storage;


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
      // $this->validate($request, [
      //     'file' => 'required|file|mimes:png,jpg,webp,gif,pdf,xsp,odt,docx|max:20000'
      // ]);

      $files = $request->file('file');




      foreach ($files as $file) {

        if(preg_match('/[^\x20-\x7f]/', $file->getClientOriginalName()))
        {
          return "El titulo del documento contiene caracteres especiales";
        }
        File::create([
          'titulo' => $file->getClientOriginalName(),
          'path' => $file->store('public/storage')
        ]);
      }

      return redirect('/file')->with('success', 'Archivo Guardado');
    }

    public function delete($id)
    {
      $del = File::find($id);
      Storage::delete($del->path);
      $del->delete();
      return redirect('/file');
    }

    public function download($id)
    {

      $dl = File::find($id);
      return Storage::download($dl->path,$dl->titulo);
    }
}
