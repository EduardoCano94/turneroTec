<?php

namespace App\Http\Controllers;

use App\Models\Turno;
use App\Models\Ciudadano;
use Illuminate\Http\Request;
use App\Models\Tramite;

class TurnoController extends Controller
{
    // Listar todos los turnos con filtros
    public function index(Request $request)
    {
        $query = Turno::with('ciudadano');

        // Filtro por fecha
        if ($request->filled('fecha')) {
            $query->whereDate('fecha', $request->fecha);
        }

        // Filtro por estado
        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        $turnos = $query->orderBy('numero', 'desc')->get();
        
        return view('turnos.index', compact('turnos'));
    }

    // Mostrar formulario de creación
   public function create()
{
    $ciudadanos = Ciudadano::all();
    $tramites = Tramite::where('activo', true)->orderBy('nombre')->get(); 
    
    // Generar número de turno automáticamente
    $ultimoTurno = Turno::max('numero');
    $nuevoNumero = $ultimoTurno ? $ultimoTurno + 1 : 1;
    
    return view('turnos.create', compact('ciudadanos', 'tramites', 'nuevoNumero')); 
}

    // Guardar nuevo turno
    public function store(Request $request)
{
    $request->validate([
        'numero' => 'required|integer|unique:turnos,numero',
        'fecha' => 'required|date',
        'tramite_id' => 'required|exists:tramites,id', 
        'descripcion' => 'nullable|string',
        'id_ciudadano' => 'required|exists:ciudadano,id',
    ]);

    Turno::create([
        'numero' => $request->numero,
        'fecha' => $request->fecha,
        'tramite_id' => $request->tramite_id, 
        'descripcion' => $request->descripcion,
        'estado' => 'En espera',
        'id_ciudadano' => $request->id_ciudadano,
    ]);

    return redirect()->route('turnos.index')
                     ->with('success', 'Turno creado correctamente.');
}

    // Mostrar un turno específico
    public function show($id)
    {
        $turno = Turno::with('ciudadano')->findOrFail($id);
        return view('turnos.show', compact('turno'));
    }

    // Mostrar formulario de edición
    public function edit($id)
    {
        $turno = Turno::findOrFail($id);
        $ciudadanos = Ciudadano::all();
        return view('turnos.edit', compact('turno', 'ciudadanos'));
    }

    // Actualizar turno
    public function update(Request $request, $id)
    {
        $request->validate([
            'numero' => 'required|integer|unique:turnos,numero,' . $id,
            'fecha' => 'required|date',
            'descripcion' => 'required|string',
            'estado' => 'required|in:En espera,Ya atendido',
            'id_ciudadano' => 'required|exists:ciudadano,id',
        ]);

        $turno = Turno::findOrFail($id);
        $turno->update($request->all());

        return redirect()->route('turnos.index')
                         ->with('success', 'Turno actualizado correctamente.');
    }

    // Eliminar turno
    public function destroy($id)
    {
        $turno = Turno::findOrFail($id);
        $turno->delete();

        return redirect()->route('turnos.index')
                         ->with('success', 'Turno eliminado correctamente.');
    }

    // Cambiar estado del turno
    public function cambiarEstado($id)
    {
        $turno = Turno::findOrFail($id);
        
        $turno->estado = $turno->estado === 'En espera' ? 'Ya atendido' : 'En espera';
        $turno->save();

        return redirect()->back()
                         ->with('success', 'Estado del turno actualizado.');
    }

// Mostrar solo turnos en espera
public function enEspera()
{
    $turnos = Turno::with('ciudadano')
                   ->where('estado', 'En espera')
                   ->orderBy('numero', 'desc')
                   ->get();
    
    return view('turnos.index', compact('turnos'));
}

// Mostrar solo turnos atendidos
public function atendidos()
{
    $turnos = Turno::with('ciudadano')
                   ->where('estado', 'Ya atendido')
                   ->orderBy('numero', 'desc')
                   ->get();
    
    return view('turnos.index', compact('turnos'));
}


}