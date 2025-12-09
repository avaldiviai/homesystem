<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Verano;

class EventController extends Controller
{
    // Mostrar todos los eventos
    public function index()
    {
        // Obtener los IDs de verano de Event
        $idsExcluidos = Event::pluck('id_verano')->toArray();
    
        // Filtrar las propiedades de verano que no están en los IDs excluidos
        $proverano = Verano::whereNotIn('id', 1)
            ->where('estado')
            ->get();
    
        return view('/propiedadesVeranoDetalles', compact('proverano'));
    }

public function getEvents(Request $request)
{
    // Construimos la consulta base
    $query = Event::where('estado', 1);

    // Filtrar por fecha si se envía
    if ($request->has('date') && $request->date != '') {
        $query->whereDate('inicio', '<=', $request->date)
              ->whereDate('fin', '>=', $request->date);
    }

    // Filtrar por id_verano usando la relación verano
    if ($request->has('id_verano') && $request->id_verano != '') {
        $query->whereHas('verano', function($q) use ($request) {
            $q->where('id', $request->id_verano);
        });
    }

    // Obtener eventos
    $events = $query->get()->map(function ($event) {
        return [
            'id' => $event->id,
            'direccion' => ($event->verano->direccion ?? 'Sin dirección'),
            'title' =>
                ($event->verano->torre ?? 'Sin torre') . ' - ' . ($event->verano->num_apartamento ?? 'Sin número') . "\n" .
                'Total: $' . number_format($event->total, 0, ',', '.') . "\n" .
                'Día: $' . number_format($event->precio_dia, 0, ',', '.') . "\n" .
                'Aseo: $' . number_format($event->monto, 0, ',', '.') . "\n",
            'start' => \Carbon\Carbon::parse($event->inicio)->toDateString(),
            'end' => \Carbon\Carbon::parse($event->fin)->toDateString(),
            'total' => $event->total,
            'color' => $event->color,
            'diario' => $event->precio_dia,
            'dia' => $event->dia,
            'monto' => $event->monto,
            'condominio' => $event->verano->num_apartamento ?? 'Sin número',
            'torre' => $event->verano->torre ?? 'Sin torre',
        ];
    });

    return response()->json($events);
}


    

public function validarFecha(Request $request)
{
    $existingEvent = Event::where('id_verano', $request->id_verano)
        ->where(function ($query) use ($request) {
            // Validar si hay un evento que tenga las mismas fechas
            $query->whereBetween('inicio', [$request->inicio, $request->fin])
                ->orWhereBetween('fin', [$request->inicio, $request->fin])
                ->orWhere(function ($query) use ($request) {
                    $query->where('inicio', '<=', $request->inicio)
                        ->where('fin', '>=', $request->fin);
                });
        })
        ->first(); // Obtén solo el primer evento que coincide

    // Si se encuentra un evento y ambos tienen el mismo estado 1
    if ($existingEvent && $existingEvent->estado == 1 && $request->estado == 1) {
        return response()->json(['message' => 'Las fechas seleccionadas están ocupadas.'], 400);
    }

    // Si no hay conflicto de fechas o si las fechas están ocupadas pero con estados diferentes
    return response()->json(['message' => 'Fechas disponibles.'], 200);
}

    
    
    

    // Crear un nuevo evento
    public function store(Request $request)
    {
        // Validación de los datos
        $request->validate([
            'id_verano' => 'required|string|max:255',
            'inicio' => 'required|date',
            'fin' => 'required|date',
            'total' => 'required|numeric',
            'color' => 'required|string|max:7',
            'precio_dia' => 'required|numeric',

        ]);

        // Verificar si la fecha de inicio y fin ya están ocupadas para la propiedad seleccionada
        $existingEvent = Event::where('id_verano', $request->id_verano)
            ->where(function ($query) use ($request) {
                $query->whereBetween('inicio', [$request->inicio, $request->fin])
                      ->orWhereBetween('fin', [$request->inicio, $request->fin])
                      ->orWhere(function ($query) use ($request) {
                          $query->where('inicio', '<=', $request->inicio)
                                ->where('fin', '>=', $request->fin);
                      });
            })
            ->exists();

        if ($existingEvent) {
            return response()->json(['message' => 'Las fechas seleccionadas están ocupadas.'], 400);
        }

        // Crear el nuevo evento en la base de datos
        $event = new Event;
        $event->id_verano = $request->id_verano;
        $event->inicio = $request->inicio;
        $event->fin = $request->fin;
        $event->total = $request->total;
        $event->color = $request->color;
        $event->dia = $request->dia;        
        $event->monto = $request->monto;
        $event->estado =1;

        $event->precio_dia = $request->precio_dia;
        $event->estado = 1;

        $event->save();

        // Retornar el evento recién creado
        return response()->json([
            'id' => $event->id,
            'id_verano' => $event->id_verano,
            'start' => $event->inicio,
            'end' => $event->fin,
            'total' => $event->total,
            'color' => $event->color,
            'dia' => $event->dia,
            'monto' => $event->monto,

            'precio_dia' => $event->precio_dia,
        ]);
    }

    // Eliminar un evento
    public function destroy($id)
    {
        $eliminarverano = Event::where('id',$id)->first();
        $eliminarverano->estado = 0;
        $eliminarverano->save();
    }

    // Actualizar un evento
    public function update(Request $request)
    {
        // Validar los datos recibidos
        $validated = $request->validate([
            'id' => 'required|exists:events,id', // Asegurarse de que el evento existe
            'start' => 'required|date',
            'end' => 'required|date',
        ]);

        // Buscar el evento que se va a actualizar
        $evento = Event::find($request->id);  // Asegúrate de tener un campo "id" en el evento

        if ($evento) {
            // Actualizar el evento
            $evento->id= $request->id;
            $evento->inicio = $validated['start'];
            $evento->fin = $validated['end'];
            $evento->save();

            // Retornar una respuesta con los nuevos datos
            return response()->json($evento);
        }

        return response()->json(['error' => 'Evento no encontrado'], 404);
    }

    // Eliminar fecha
    public function destroyfecha($idevento)
    {
        $eliminarverano = Event::where('id',$idevento)->first();
        $eliminarverano->estado = 0;
        $eliminarverano->save();
    }

    public function editeventos($idevento){

        $eventoupdate= Event::where('id',$idevento)->first();
        
        return response()->json($eventoupdate);
    }
    public function guardaredit(Request $request){

        $idevento = $request->id;
        $guardaredit = Event::where('id',$idevento)->first();
        $guardaredit->inicio = $request->inicio;
        $guardaredit->fin = $request->fin;
        $guardaredit->dia = $request->dia;
        $guardaredit->precio_dia = $request->precio_dia;
        $guardaredit->monto = $request->monto;
        $guardaredit->id_verano = $request->id_verano;
        $guardaredit->total = $request->total;
        $guardaredit->save();


        return response()->json(['Gurdados' => $guardaredit]);

    }

}
