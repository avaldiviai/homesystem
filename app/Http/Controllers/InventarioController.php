<?php
namespace App\Http\Controllers;

use App\Models\Inventario;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class InventarioController extends Controller
{
    public function index(Request $request)
    {
        $inventarios = Inventario::all();
        
        if ($request->ajax()) {
            return response()->json($inventarios);
        }

        return view('inventario', compact('inventarios'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion'=> 'required|string|max:255',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $fotoPath = $request->file('foto')->store('fotos_inventario', 'public');

        Inventario::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'foto' => $fotoPath,
        ]);

        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        $inventario = Inventario::find($id);
        if ($inventario) {
            $inventario->delete();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }


    public function update(Request $request)
    {
        // Validar los datos de la solicitud
        $request->validate([
            'id' => 'required|exists:inventarios,id',
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:1000',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' // Validar solo si se envía
        ]);
    
        // Buscar el inventario por ID
        $invent = Inventario::findOrFail($request->id);
    
        // Actualizar los datos básicos
        $invent->nombre = $request->nombre;
        $invent->descripcion = $request->descripcion;
    
        // Si se sube una nueva foto, procesarla y actualizar
        if ($request->hasFile('foto')) {
            // Eliminar la foto anterior si existe
            if ($invent->foto) {
                Storage::disk('public')->delete($invent->foto);
            }
    
            // Guardar la nueva foto
            $fotoPath = $request->file('foto')->store('fotos_inventario', 'public');
            $invent->foto = $fotoPath;
        }
    
        // Guardar los cambios en el inventario
        $invent->save();
    
        // Retornar la respuesta en formato JSON
        return response()->json([
            'success' => true,
            'message' => 'Inventario actualizado correctamente.',
            'nuevo_inventario' => $invent
        ]);
    }
    


    
    ///////////////////trabajador///////////////////////////
    public function indextrabajador(Request $request)
    {
        $inventarios = Inventario::all();
        
        if ($request->ajax()) {
            return response()->json($inventarios);
        }

        return view('trabajador.inventario', compact('inventarios'));
    }





//////////////////////////Obrero ///////////////////////////////
public function obreroIndex(Request $request)
{
    $inventarios = Inventario::all();
    
    if ($request->ajax()) {
        return response()->json($inventarios);
    }

    return view('obrero.inventario', compact('inventarios'));
}


}
