<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contrato;
use App\Models\Arriendo;
use App\Models\Arrendatario;
use App\Models\Propietario;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class ContratoController extends Controller
{
    public function index()
    {
        $contratos = Contrato::all();
        $arriendos = Arriendo::all();
        // $pdfPath = asset('storage/file.pdf'); // Make it accessible via URL

    // Pass the data to the view
    return view('contratos', compact('contratos', 'arriendos'));
        
    }
    
    
    public function store(Request $request)
    {
        $request->validate([
            'contrato' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'id_arriendo' => 'required|exists:arriendos,id', // Validar que el id_arriendo exista
        ]);
        
        // Guardar el archivo en el sistema de archivos
        // $ruta = $request->file('contrato')->store('contratos');
        $nombreArchivo = $request->file('contrato')->getClientOriginalName();
        $ruta = $request->file('contrato')->storeAs('contratos', $nombreArchivo, 'public');
    
        
        // Guardar la ruta y el id_arriendo en la base de datos
        $contrato = new Contrato();
        $contrato->contrato = '/storage/public/'.$ruta;
        $contrato->id_arriendo = $request->id_arriendo; // Asignar el id_arriendo
        $contrato->save();

        session()->flash('success', 'Contrato guardado exitosamente.');
        // dd(session()->all()); //

        // return back()->with('success', 'Archivo cargado correctamente.');
        return redirect()->route('contratos.index');
        
    }
    public function destroy($idcontrato) {
        $contrato = Contrato::find($idcontrato)->delete();
        return Response()->json(['archivos'=>'Archivo ah sido eliminado correctamente ']);       
    }

    public function getArrendatario($id)
    {
        $arr = Arrendatario::findOrFail($id);
        return response()->json([
            'nombre'    => $arr->nombre,
            'rut'       => $arr->rut,
            // 'profesion' => $arr->profesion,
            'domicilio' => $arr->direccion,
            'telefono'  => $arr->telefono,
            'correo'    => $arr->correo,
        ]);
    }

    public function getPropietario($id)
    {
        $prop = Propietario::findOrFail($id);
        return response()->json([
            'nombre' => $prop->nombre,
            'rut'    => $prop->rut,
            // Agrega más si tienes otros campos necesarios
        ]);
    }



}
